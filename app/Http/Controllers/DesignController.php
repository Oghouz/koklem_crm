<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $designs = Design::all();

        return view('designs.index', [
            'designs' => $designs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('designs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données entrantes
        $validatedData = $request->validate([
            'reference' => 'required|string|max:255|unique:products,reference',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Créer et enregistrer le produit
        $design = new Design();
        $design->fill($request->only(['reference', 'name', 'description']));

        // Vérifier si une nouvelle image est envoyée
        if ($request->hasFile('image')) {
            $design_path = public_path('/images/designs');
            // Sauvegarder la nouvelle image
            $imagePath = $request->file('image')->store($design_path, 'public');
            $design->image = $imagePath;
        }

        $design->created_by = $user->id;
        $design->updated_by = $user->id;
        $design->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le produit a été enregistré avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $design = Design::findOrFail($id);

        return view('designs.edit', [
            'design' => $design,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $design = Design::findOrFail($id);

        // Valider les données entrantes
        $validatedData = $request->validate([
            'reference' => 'required|string|max:255|unique:products,reference,' . $design->id,
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Mettre à jour le produit
        $design->fill($request->only(['reference', 'name', 'description']));

        // Vérifier si une nouvelle image est envoyée
        if ($request->hasFile('image')) {
            $design_path = public_path('/images/designs');
            // Supprimer l'ancienne image si nécessaire (optionnel)
            if ($design->image && file_exists($design_path . '/' . $design->image)) {
                unlink($design_path . '/' . $design->image);
            }

            // Sauvegarder la nouvelle image
            $imagePath = $request->file('image')->store($design_path, 'public');
            $design->image = $imagePath;
        }

        $design->updated_by = $user->id;
        $design->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le produit a été mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
