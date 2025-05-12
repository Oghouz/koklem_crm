<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;

class ClientController extends Controller
{
    use Sortable;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $clients = Client::query();

        if($search) {
            $clients->when($search, function ($query, $search) {
                return $query->where('company', 'like', '%'.$search.'%')
                    ->orWhere('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('address1', 'like', '%'.$search.'%')
                    ->orWhere('address2', 'like', '%'.$search.'%')
                    ->orWhere('zip_code', 'like', '%'.$search.'%')
                    ->orWhere('city', 'like', '%'.$search.'%')
                    ->orWhere('phone1', 'like', '%'.$search.'%')
                    ->orWhere('phone2', 'like', '%'.$search.'%')
                    ->orWhere('phone3', 'like', '%'.$search.'%')
                    ->orWhere('siret', 'like', '%'.$search.'%')
                    ->orWhere('tva_number', 'like', '%'.$search.'%')
                    ->orWhere('comment', 'like', '%'.$search.'%');
            });
        }

        $clients = $clients->orderBy($sort, $direction)->get();


        return view('clients.index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        // Valider les données entrantes
        $validatedData = $request->validate([
            'company' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone1' => 'nullable|string|max:255',
            'phone2' => 'nullable|string|max:255',
            'phone3' => 'nullable|string|max:255',
            'siret' => 'nullable|string|max:255',
            'tva_number' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Créer et enregistrer le produit
        $client = new Client();
        $client->fill($request->only([
            'company','first_name','last_name','address1','address2','zip_code','city','phone1','phone2','phone3','siret','tva_number','comment'
        ]));
        $client->created_by = $user->id;
        $client->updated_by = $user->id;
        $client->save();

        // Rediriger avec un message de succès
        return redirect()->route('client.index')->with('success', 'Le client a été enregistré avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', ['client' => $client]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', ['client' => $client]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $user = Auth::user();
        // Valider les données entrantes
        $validatedData = $request->validate([
            'company' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone1' => 'nullable|string|max:255',
            'phone2' => 'nullable|string|max:255',
            'phone3' => 'nullable|string|max:255',
            'email' => 'nullable|string|max:255',
            'price_tshirt' => 'nullable|numeric',
            'siret' => 'nullable|string|max:255',
            'tva_number' => 'nullable|string|max:255',
            'comment' => 'nullable|string|max:255',
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Créer et enregistrer le produit
        $client->fill($request->only([
            'company',
            'first_name',
            'last_name',
            'address1',
            'address2',
            'zip_code',
            'city',
            'phone1',
            'phone2',
            'phone3',
            'email',
            'price_tshirt',
            'siret',
            'tva_number',
            'comment',
        ]));
        $client->updated_by = $user->id;
        $client->save();

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Le client a été enregistré avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }

    public function getPriceTshirt(Request $request)
    {
        $client = Client::find($request->client_id);

        return response()->json([
            'price_tshirt' => $client->price_tshirt,
        ]);
    }
}
