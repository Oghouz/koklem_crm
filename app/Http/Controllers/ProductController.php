<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\TVA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tvas = TVA::all();
        $categories = Category::all();
        $colors = Color::all();

        return view('products.create', [
            'tvas' => $tvas,
            'categories' => $categories,
            'colors' => $colors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'reference' => 'required|string|max:255|unique:products,reference',
            'category_id' => 'required|exists:categories,id',
            'color_id' => 'nullable|exists:colors,id',
            'tva_id' => 'required|exists:tvas,id',
            'name' => 'required|string|max:255',
            'size' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|numeric|min:0'
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Créer et enregistrer le produit
        $product = new Product();
        $product->fill($request->only(['reference', 'category_id', 'color_id', 'name', 'size', 'description', 'price','stock','tva_id']));
        $product->created_by = $user->id;
        $product->updated_by = $user->id;
        $product->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le produit a été enregistré avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $tvas = TVA::all();
        $categories = Category::all();
        $colors = Color::all();

        return view('products.edit', [
            'product' => $product,
            'tvas' => $tvas,
            'categories' => $categories,
            'colors' => $colors,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $user = Auth::user();
        // Valider les données entrantes.
        // Note : pour la règle unique, on exclut l'ID actuel du produit.
        $validatedData = $request->validate([
            'reference' => 'required|unique:products,reference,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'size' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|numeric|min:0',
            'tva_id' => 'required|exists:tvas,id',
            'color_id' => 'nullable|exists:colors,id'
        ]);

        // Mettre à jour les champs remplissables du modèle
        $product->fill($request->only(['reference', 'category_id', 'name', 'size', 'description', 'price', 'stock', 'tva_id', 'color_id']));
        $product->updated_by = $user->id;
        $product->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le produit a été mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
