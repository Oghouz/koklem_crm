<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        return view('products.create', [
            'tvas' => $tvas,
            'categories' => $categories,
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
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'tva_id' => 'required|exists:tvas,id'
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Créer et enregistrer le produit
        $product = new Product();
        $product->fill($request->only(['reference', 'category_id', 'name', 'description', 'price', 'tva_id']));
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $tvas = TVA::all();
        $categories = Category::all();

        return view('products.edit', [
            'product' => $product,
            'tvas' => $tvas,
            'categories' => $categories,
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
            'reference' => 'required|string|max:255|unique:products,reference,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'tva_id' => 'required|exists:tvas,id'
        ]);

        // Mettre à jour les champs remplissables du modèle
        $product->fill($request->only(['reference', 'category_id', 'name', 'description', 'price', 'tva_id']));
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
