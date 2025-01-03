<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        return view('orders.create', compact('clients', 'products'));
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
            'lines.*.product_id' => 'required|exists:products,id',
            'lines.*.quantity' => 'required|numeric|min:1',
            'lines.*.price' => 'required|numeric|min:0',
        ]);

        // Créer la commande
        $order = Order::create([
            'num' => 'CMD' . time(),  // Générer un numéro de commande unique
            'status' => 1,
            'payment_status' => 1,
            'client_id' => $validated['client_id'] ?? null,
            'total' => 0,    // sera recalculé plus bas
            'total_lines' => count($validated['lines']),
            'comment' => $request->input('comment', ''),
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);

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
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);
        }

        // Mettre à jour le total de la commande
        $order->update(['total' => $total]);

        return redirect()->route('order.show', $order->id)->with('success', 'Commande créée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $clients = Client::all();
        $products = Product::all();

        return view('orders.edit', compact('order', 'clients', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'client_id' => 'nullable|exists:clients,id',
            'comment' => 'nullable|string',
            'lines' => 'required|array|min:1',
            'lines.*.product_id' => 'required|exists:products,id',
            'lines.*.quantity' => 'required|numeric|min:1',
            'lines.*.price' => 'required|numeric|min:0',
        ]);

        // Mise à jour des informations de la commande
        $order->update([
            'client_id' => $validated['client_id'] ?? null,
            'comment' => $validated['comment'] ?? '',
            'updated_by' => $user->id,
            // total et total_lines seront recalculés plus bas
        ]);

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
                'created_by' => $user->id,
            ]);
        }

        $order->update([
            'total' => $total,
            'total_lines' => count($validated['lines']),
        ]);

        return redirect()->route('orders.show', $order->id)->with('success', 'Commande mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
