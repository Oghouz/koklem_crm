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
use Kyslik\ColumnSortable\Sortable;

class OrderController extends Controller
{
    use Sortable;

    public $sortable = ['id', 'num', 'status', 'client_id', 'total_lines', 'total_ht', 'total_tva', 'total_ttc', 'created_at'];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');
        $orders = Order::with(['orderLines']);
        $date_debut = $request->get('date_debut');
        $date_fin = $request->get('date_fin');

        if($date_debut && !$date_fin) {
            $orders = $orders->where('created_at', '>=', $date_debut);
        } else if($date_fin && !$date_debut) {
            $orders = $orders->where('created_at', '<=', $date_fin);
        } else if($date_debut && $date_fin) {
            $orders = $orders->whereBetween('created_at', [$date_debut, $date_fin]);
        }

        $order_status_filter = $request->get('order_status');
        $order_paid_filter = $request->get('order_paid');

        if($search) {
            $orders = $orders->where('id', 'like', "%{$search}%");
        }

        if($order_status_filter) {
            $orders = $orders->where('status', $order_status_filter);
        }

        if($order_paid_filter || $order_paid_filter === '0') {
            $orders = $orders->where('paid', $order_paid_filter);
        }

        $orders->orderBy($sort, $direction);

        if($request->get('show_all')) {
            $orders = $orders->get();
        } else {
            $orders = $orders->paginate(100)
            ->appends(request()->query());
        }

        $total = [
            'product' => 0,
        ];
        foreach($orders as $order) {
            $total['product']+= $order->orderLines->sum('quantity');
        }
        

        return view('orders.index', ['orders' => $orders, 'total' => $total]);
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

    public function createExpress()
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

        return view('orders.create-express', compact('clients', 'products', 'designs', 'lines'));
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
        $productStocks = [];

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
        $sizes_kid = ['2Y', '4Y', '6Y', '8Y', '10Y', '12Y'];
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
                    $productStocks[$product->id] = isset($productStocks[$product->id]) ? $productStocks[$product->id]+ $lineData['quantity'] : $lineData['quantity'];
                }
            } else if($lineData['size'] == 'ALT-KID') {
                $lineTotal = $lineTotal * 6;
                foreach($sizes_kid as $size_kid) {
                    $product = Product::where('size', $size_kid)->where('color_id', $design->color_id)->first();
                    OrderLine::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'design_id' => $design->id,
                        'reference' => $design->reference,
                        'name' => $design->name,
                        'size' => $size_kid,
                        'color' => $product->color ? $product->color->name : '',
                        'quantity' => $lineData['quantity'],
                        'price' => $lineData['price'],
                        'comment' => null,
                        'created_by' => $user->id,
                        'updated_by' => $user->id
                    ]);
                    $productStocks[$product->id] = isset($productStocks[$product->id]) ? $productStocks[$product->id]+ $lineData['quantity'] : $lineData['quantity'];
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
                $productStocks[$product->id] = isset($productStocks[$product->id]) ? $productStocks[$product->id]+ $lineData['quantity'] : $lineData['quantity'];
            }
            
            $total += $lineTotal;
        }

        // Mettre à jour le total de la commande
        $order->update([
            'total_ht' => $total,
            'total_tva' => $total * 0.2,
            'total_ttc' => $total * 1.2,
        ]);

        // Mettre à jour stock
        $productStockIds = array_keys($productStocks);
        $products = Product::whereIn('id', $productStockIds)->get()->keyBy('id');

        // Mettre à jour les stocks
        foreach ($productStocks as $product_id => $quantity) {
            $product = $products->get($product_id);
            if ($product) {
                $product->update([
                    'stock' => $product->stock - $quantity
                ]);
            }
        }

        return redirect()->route('order.show', $order->id)->with('success', 'Commande créée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $productsPrepare = [];
        foreach ($order->orderLines as $line) {
            if (!$line->size) {
                continue;
            }
            if (isset($productsPrepare[$line->product_id])) {
                $productsPrepare[$line->product_id]['quantity'] += $line->quantity;
            } else {
                $productsPrepare[$line->product_id] = [
                    'ref' => $line->product->reference,
                    'color' => $line->product->color->name,
                    'size' => $line->product->size,
                    'quantity' => $line->quantity
                ];
            }
        }

        // Définir l'ordre des tailles
        $sizeOrder = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];

        // Fonction de tri
        usort($productsPrepare, function ($a, $b) use ($sizeOrder) {
            // Comparer par couleur
            $colorComparison = strcmp($a['color'], $b['color']);
            if ($colorComparison !== 0) {
                return $colorComparison;
            }

            // Comparer par taille
            $aSizeIndex = array_search($a['size'], $sizeOrder);
            $bSizeIndex = array_search($b['size'], $sizeOrder);

            return $aSizeIndex <=> $bSizeIndex;
        });

        return view('orders.show', compact('order', 'productsPrepare'));
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
            // 'client_id' => 'nullable|exists:clients,id',
            'comment' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'payment_date' => 'nullable|date',
            'delivery_date' => 'nullable|date'
        ]);

        // Mise à jour des informations de la commande
        $orderData = [
            'status' => $validated['status'] ?? null,
            // 'client_id' => $validated['client_id'] ?? null,
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

        return redirect()->route('order.edit', $order->id)->with('success', 'Commande mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function setDiscount(Request $request)
    {
        return $request->all();
    }

    public function generatePDF($id, $type)
    {
        // Récupérer la commande avec les relations nécessaires
        $order = Order::with('orderLines.design', 'client')->findOrFail($id);

        $lines = $order->orderLines;
        $finalLines = [];
        foreach ($lines as $line) {
            $category_id = $line->product->category ? $line->product->category->id : 0;
            if(isset($finalLines[$category_id])) {
                $finalLines[$category_id]['quantity'] += $line->quantity;
            } else {
                $finalLines[$category_id]['quantity'] = $line->quantity;
                $finalLines[$category_id]['price'] = $line->price;
            }
        }

        $view = 'pdfs.bon_livraison_grouped';

        // Charger la vue correspondante pour le PDF
        $html = view($view, compact('order', 'finalLines'))->render();

        $options = new Options();
        $options->set('isRemoteEnabled', true); // Autoriser les fichiers distants
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Nom du fichier
        $fileName = $type === 'bl' ? 'Bon_de_Livraison_' : 'Facture_';
        $fileName .= $order->id . '.pdf';

        // Téléchargement du fichier PDF
        return $dompdf->stream($fileName);


        // Initialiser les collections pour les lignes regroupées et non regroupées
        $groupedLines = collect();
        $nonGroupedLines = collect();

        // Grouper les lignes par `design_id` et `quantity`
        $order->orderLines->groupBy(function ($line) {
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
                    'quantity' => $lines->first()->quantity*6,
                    'price' => $firstLine->price,
                ]);
            } else {
                // Ajouter chaque ligne individuellement si elle ne remplit pas les conditions
                foreach ($lines as $line) {
                    $nonGroupedLines->push([
                        'design_id' => $line->design_id,
                        'reference' => $line->design->reference,
                        'name' => $line->design->name,
                        'size' => $line->size,
                        'quantity' => $line->quantity,
                        'price' => $line->price,
                        'category' => $line->design->category ? $line->design->category->name : '',
                    ]);
                }
            }
        });

        // Fusionner les lignes regroupées et non regroupées
        $finalLines = $groupedLines->merge($nonGroupedLines);

        // Déterminer le type de document
        $view = $type === 'bl' ? 'pdfs.bon_livraison_grouped' : 'pdfs.facture';

        // Charger la vue correspondante pour le PDF
        $html = view($view, compact('order', 'finalLines'))->render();

        $options = new Options();
        $options->set('isRemoteEnabled', true); // Autoriser les fichiers distants
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

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


    public function addOrderLine(Request $request)
    {
        $user = Auth::user();

        $order = Order::findOrFail($request->get('order_id'));
        $design = Design::findOrFail($request->get('design_id'));
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $sizes_kid = ['2Y', '4Y', '6Y', '8Y', '10Y', '12Y'];
        $this->validate($request, [
            'design_id' => 'required|exists:designs,id',
            'size' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        if($request->get('size') == 'ALT') {
            foreach($sizes as $size) {
                $product = Product::where('size', $size)->where('color_id', $design->color_id)->first();
                OrderLine::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'design_id' => $design->id,
                    'reference' => $design->reference,
                    'name' => $design->name,
                    'size' => $product->size,
                    'color' => $product->color ? $product->color->name : '',
                    'quantity' => $request->get('quantity'),
                    'price' => $request->get('price'),
                    'comment' => null,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
                $product->update([
                    'stock' => $product->stock - $request->get('quantity')
                ]);
            }
        } else if($request->get('size') == 'ALT-KID') {
            foreach($sizes_kid as $size_kid) {
                $product = Product::where('size', $size_kid)->where('color_id', $design->color_id)->first();
                OrderLine::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'design_id' => $design->id,
                    'reference' => $design->reference,
                    'name' => $design->name,
                    'size' => $product->size,
                    'color' => $product->color ? $product->color->name : '',
                    'quantity' => $request->get('quantity'),
                    'price' => $request->get('price'),
                    'comment' => null,
                    'created_by' => $user->id,
                    'updated_by' => $user->id
                ]);
                $product->update([
                    'stock' => $product->stock - $request->get('quantity')
                ]);
            }
        } else {
            $product = Product::where('size', $request->get('size'))->where('color_id', $design->color_id)->first();
            OrderLine::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'design_id' => $design->id,
                'reference' => $design->reference,
                'name' => $design->name,
                'size' => $product->size,
                'color' => $product->color ? $product->color->name : '',
                'quantity' => $request->get('quantity'),
                'price' => $request->get('price'),
                'comment' => null,
                'created_by' => $user->id,
                'updated_by' => $user->id
            ]);
            $product->update([
                'stock' => $product->stock - $request->get('quantity')
            ]);
        }

        $this->recalculOrder($order);

        return response([
            'status' => 'success'
        ], 201);
    }

    public function updateOrderLine(Request $request, $order_line_id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($request->get('order_id'));
        $orderLine = OrderLine::findOrFail($order_line_id);
        $design = Design::findOrFail($request->get('design_id'));
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $sizes_kid = ['2Y', '4Y', '6Y', '8Y', '10Y', '12Y'];

        $oldQuantity = $orderLine->quantity;
    
        $this->validate($request, [
            'design_id' => 'required|exists:designs,id',
            'size' => 'required|string',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        $product = Product::where('size', $request->get('size'))->where('color_id', $design->color_id)->first();

        $orderLine->update([
            'product_id' => $product->id,
            'design_id' => $design->id,
            'reference' => $design->reference,
            'name' => $design->name,
            'size' => $product->size,
            'color' => $product->color ? $product->color->name : '',
            'quantity' => $request->get('quantity'),
            'price' => $request->get('price'),
            'updated_by' => $user->id
        ]);


        // Mettre à jour le stock
        $currentStock = $product->stock + $oldQuantity - $request->get('quantity');
        $product->update([
            'stock' => $currentStock
        ]);


        // Recalculer le total de la commande
        $this->recalculOrder($order);

        return response([
            'status' => 'success',
        ], 201);
    }

    public function deleteOrderLine($order_line_id)
    {
        $orderLine = OrderLine::findOrFail($order_line_id);
        $orderLine->delete();

        //Recalcul la total
        $order = $orderLine->order;

        $this->recalculOrder($order);

        // Mettre à jour le stock
        $productStock = Product::find($orderLine->product_id);
        if ($productStock) {
            $productStock->update([
                'stock' => $productStock->stock + $orderLine->quantity
            ]);
        }

        return response([
            'status' => 'success',
            'order' => $order
        ], 201);
    }

    public function recalculOrder(Order $order)
    {
        $total_ht = 0;
        $total_lines = 0;
        foreach($order->orderLines as $line) {
            $total_lines+= 1;
            $total_ht+= $line->price * $line->quantity;
        }
        $order->update([
            'total_lines' => $total_lines,
            'total_ht' => $total_ht,
            'total_tva' => $total_ht * 0.2,
            'total_ttc' => $total_ht * 1.2
        ]);
    }

}
