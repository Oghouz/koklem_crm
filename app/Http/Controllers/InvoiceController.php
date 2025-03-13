<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\Order;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();

        return view('invoices.index', [
            'invoices' => $invoices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::find($validated['order_id']);
        $invoice = $this->createInvoiceWithOrder($order);
        $order->update(['invoice_id' => $invoice->id]);

        return response()->json([
            'status' => 'success',
            'data' => $request->all()
        ], 201);
    }

    public function multipleInvoiceStore(Request $request)
    {
        // Récupérer les IDs des commandes depuis la requête
        $order_ids = $request->get('orderIds');

        // Récupérer les commandes correspondantes
        $orders = Order::whereIn('id', $order_ids)->get();

        // Vérifier si des commandes ont été trouvées
        if ($orders->isEmpty()) {
            return response()->json(['error' => 'Aucune commande trouvée.'], 404);
        }

        // Vérifier si toutes les commandes appartiennent au même client
        $client_id = $orders->first()->client_id;
        $all_same_client = $orders->every(function ($order) use ($client_id) {
            return $order->client_id === $client_id;
        });

        if (!$all_same_client) {
            return response()->json(['error' => 'Toutes les commandes doivent appartenir au même client.'], 400);
        }

        // Créer la facture
        // $invoice = new Invoice();
        // $invoice->client_id = $client_id;
        // $invoice->total_amount = $orders->sum('total'); // Exemple : somme des totaux des commandes
        // $invoice->status = 'pending'; // Statut initial de la facture
        // $invoice->save();

        // // Associer les commandes à la facture
        // foreach ($orders as $order) {
        //     $order->invoice_id = $invoice->id;
        //     $order->save();
        // }

        // Retourner la facture créée
        return response()->json([
            'message' => 'Facture créée avec succès.',
            'invoice' => 'invoice',
            'orders' => 'orders',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice = Invoice::find($id);

        return view('invoices.show', ['invoice' => $invoice]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function createInvoiceWithOrder(Order $order)
    {

        $user = Auth::user();
        $now = Carbon::now();
        $client = $order->client;
        $invoice = Invoice::create([
            'invoice_num' => $order->created_at->format('y') . str_pad($order->id, 4, '0', STR_PAD_LEFT),
            'order_id' => $order->id,
            'client_id' => $client->id,
            'client_company' => $client->company,
            'client_first_name' => $client->first_name,
            'client_last_name' => $client->last_name,
            'client_address1' => $client->address1,
            'client_address2' => $client->address2,
            'client_zip_code' => $client->zip_code,
            'client_city' => $client->city,
            'client_siret' => $client->siret,
            'client_tva_number' => $client->tva_number,
            'client_email' => $client->email,
            'client_phone' => $client->phone1,
            'issue_date' => $now->format('Y-m-d'),
            'due_date' => $now->addDay(Invoice::DUE_DATE)->format('Y-m-d'),
            'status' => 'pending',
            'payment_method' => $order->payment_method,
            'total_ht' => $order->total_ht,
            'total_tva' => $order->total_tva,
            'total_ttc' => $order->total_ttc,
            'created_by' => $user->id,
        ]);

        foreach($order->orderLines as $orderLine) {
            $product = $orderLine->product;
            $design = $orderLine->design;
            InvoiceLine::create([
                'invoice_id' => $invoice->id,
                'product_id' => $orderLine->product_id,
                'design_id' => $orderLine->design_id,
                'product_reference' => $design->reference,
                'product_name' => $design->name,
                'product_category' => $product->category->name,
                'product_description' => $design->description,
                'product_color' => $orderLine->color,
                'product_size' => $orderLine->size,
                'product_price' => $orderLine->price,
                'product_tva' => $product->tva->value,
                'quantity' => $orderLine->quantity
            ]);
        }

        return $invoice;
    }

    public function generateInvoicePdf($invoice_id, $type = false)
    {
        // Récupérer la commande avec les relations nécessaires
        $invoice = Invoice::findOrFail($invoice_id);

        
        if($type && $type == 'grouped') {
            $finalLines = [];
            foreach($invoice->lines as $line) {
                $category = $line->product->category;
                if(isset($finalLines[$category->id])) {
                    $finalLines[$category->id]['quantity']+= $line->quantity;
                } else {
                    $finalLines[$category->id] = [
                        'design_id' => $line->design_id,
                        'reference' => $line->design->reference,
                        'name' => $category->description,
                        'size' => '', // Taille combinée
                        'quantity' => $line->quantity,
                        'price' => $line->product_price,
                    ];
                }
                
            }
        }  else {
            // Initialiser les collections pour les lignes regroupées et non regroupées
            $groupedLines = collect();
            $nonGroupedLines = collect();

            // Grouper les lignes par `design_id` et `quantity`
            $invoice->lines->groupBy(function ($line) {
                return $line->design_id . '-' . $line->quantity;
            })->each(function ($lines) use ($groupedLines, $nonGroupedLines) {
                // Vérifier si toutes les tailles XS à XXL sont présentes
                $requiredSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];

                $lineSizes = $lines->pluck('size')
                    ->map(fn($size) => strtoupper(trim($size))) // Normaliser les tailles
                    ->unique()
                    ->sort()
                    ->values()
                    ->all();

                // Comparer les tailles sans tenir compte de l'ordre
                if (count($lineSizes) === count($requiredSizes) && !array_diff($requiredSizes, $lineSizes)) {
                    // Ajouter une ligne regroupée
                    $firstLine = $lines->first();
                    $groupedLines->push([
                        'design_id' => $firstLine->design_id,
                        'reference' => $firstLine->design->reference,
                        'name' => $firstLine->design->name,
                        'size' => 'XS à XXL', // Taille combinée
                        'quantity' => $lines->first()->quantity * 6,
                        'price' => $firstLine->product_price,
                    ]);
                } else {
                    // Ajouter chaque ligne individuellement si elle ne remplit pas les conditions
                    foreach ($lines as $line) {
                        $nonGroupedLines->push([
                            'design_id' => $line->design_id,
                            'reference' => $line->design->reference,
                            'name' => $line->design->name,
                            'size' => $line->product_size,
                            'quantity' => $line->quantity,
                            'price' => $line->product_price,
                        ]);
                    }
                }
            });

            $finalLines = $groupedLines->merge($nonGroupedLines);

        }

        // Charger la vue correspondante pour le PDF
        $html = view('invoices.pdf', compact('invoice', 'finalLines', 'type'))->render();

        $options = new Options();
        $options->set('isRemoteEnabled', true); // Autoriser les fichiers distants
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->add_info("Title", "Facture N° ".$invoice->invoice_num);

        // Nom du fichier
        $fileName = 'Facture_'.$invoice->invoice_num . '.pdf';

        // Téléchargement du fichier PDF
        return $dompdf->stream($fileName, ['Attachment' => false]);
    }
}
