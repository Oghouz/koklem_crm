<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Design;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();

        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        $products = Product::all();
        $designs = Design::all();

        $lines = [];

        foreach ($designs as $design) {
            
            foreach($products as $product) {
                $lines[] = [
                    'design_id' => $design->id,
                    'ref' => $design->reference,
                    'name' => $design->name,
                    'product_id' => $product->id,
                    'size' => $product->size,
                    'color' => $product->color,
                ];
            }
        }     

        return view('orders.create', compact('clients', 'products', 'designs', 'lines'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'lines' => 'required|array|min:1',
            // 'lines.*.product_id' => 'required|exists:products,id',
            // 'lines.*.quantity' => 'required|numeric|min:1',
            // 'lines.*.price' => 'required|numeric|min:0',
        ]);

        // Créer la commande
        $order = Order::create([
            'num' => 'CMD' . time(),  // Générer un numéro de commande unique
            'status' => 1,
            'client_id' => $validated['client_id'] ?? null,
            'total_lines' => count($validated['lines']),
            'comment' => $request->input('comment', ''),
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

        $total = 0;
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        foreach ($validated['lines'] as $lineData) {
            $lineTotal = $lineData['quantity'] * $lineData['price'];

            $design = Design::find($lineData['design_id']);

            if($lineData['size'] == 'ALT') {
                $lineTotal = $lineTotal * 6;
                foreach($sizes as $size) {
                    $product = Product::where('size', $size)->where('color_id', $design->color_id)->first();
                    OrderLine::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'design_id' => $design->id,
                        'reference' => $design->reference,
                        'name' => $design->name,
                        'size' => $size,
                        'color' => $product->color ? $product->color->name : '',
                        'quantity' => $lineData['quantity'],
                        'price' => $lineData['price'],
                        'comment' => null,
                        'created_by' => $user->id,
                        'updated_by' => $user->id
                    ]);
                }
                
            } else {
                $product = Product::where('size', $lineData['size'])->where('color_id', $design->color_id)->first();
                OrderLine::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'design_id' => $design->id,
                    'reference' => $design->reference,
                    'name' => $design->name,
                    'size' => $lineData['size'],
                    'color' => $product->color ? $product->color->name : '',
                    'quantity' => $lineData['quantity'],
                    'price' => $lineData['price'],
                    'comment' => null,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
            }
            
            $total += $lineTotal;
        }

        // Mettre à jour le total de la commande
        $order->update([
            'total_ht' => $total,
            'total_tva' => $total * 0.2,
            'total_ttc' => $total * 1.2,
        ]);

        return redirect()->route('order.show', $order->id)->with('success', 'Commande créée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $clients = Client::all();
        $products = Product::all();
        $designs = Design::all();

        return view('orders.edit', compact('order', 'clients', 'products', 'designs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'status' => 'required|numeric|in:1,2,3,8,9',
            'client_id' => 'nullable|exists:clients,id',
            'comment' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'payment_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'lines' => 'required|array|min:1',
            'lines.*.product_id' => 'required|exists:products,id',
            'lines.*.quantity' => 'required|numeric|min:1',
            'lines.*.price' => 'required|numeric|min:0',
        ]);

        // Mise à jour des informations de la commande
        $orderData = [
            'status' => $validated['client_id'] ?? null,
            'client_id' => $validated['client_id'] ?? null,
            'comment' => $validated['comment'] ?? null,
            'payment_method' => $validated['payment_method'] ?? null,
            'payment_date' => $validated['payment_date'] ?? null,
            'delivery_date' => $validated['delivery_date'] ?? null,
            'updated_by' => $user->id,
        ];
        if($validated['payment_date']) {
            $orderData['paid'] = true;
        }

        $order->update($orderData);

        // On supprime les lignes existantes avant de les recréer
        $order->orderLines()->delete();

        $total = 0;
        foreach ($validated['lines'] as $lineData) {
            $lineTotal = $lineData['quantity'] * $lineData['price'];
            $total += $lineTotal;

            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $lineData['product_id'],
                'quantity' => $lineData['quantity'],
                'price' => $lineData['price'],
                'line_total' => $lineTotal,
                'comment' => null,
                'updated_by' => $user->id,
            ]);
        }

        $order->update([
            'total' => $total,
            'total_lines' => count($validated['lines']),
        ]);

        return redirect()->route('order.edit', $order->id)->with('success', 'Commande mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function generatePDF($id, $type)
    {
        // Récupérer la commande
        $order = Order::with('orderLines.design', 'client')->findOrFail($id);

        // Déterminer le type de document
        $view = $type === 'bl' ? 'pdfs.bon_livraison' : 'pdfs.facture';

        // Charger la vue correspondante pour le PDF
        $html = view($view, compact('order'))->render();

        // Options pour Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nom du fichier
        $fileName = $type === 'bl' ? 'Bon_de_Livraison_' : 'Facture_';
        $fileName .= $order->num . '.pdf';

        // Téléchargement du fichier PDF
        return $dompdf->stream($fileName, ['Attachment' => false]);
    }

}
