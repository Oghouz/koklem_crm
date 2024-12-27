@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <h1>Modifier la commande #{{ $order->id }} ({{ $order->num }})</h1>

    <form action="{{ route('order.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Sélection du client (optionnel) --}}
        <div class="mb-3">
            <label for="client_id" class="form-label">Client (optionnel)</label>
            <select name="client_id" id="client_id" class="form-select">
                <option value="">Aucun client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" 
                        {{ old('client_id', $order->client_id) == $client->id ? 'selected' : '' }}>
                        {{ $client->company }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="status">Statut</label>
            <select name="status" id="status">

            </select>
        </div>

        {{-- Commentaire global --}}
        <div class="mb-3">
            <label for="comment" class="form-label">Commentaire</label>
            <textarea name="comment" id="comment" class="form-control">{{ old('comment', $order->comment) }}</textarea>
        </div>

        <hr>

        <h2>Lignes de commande</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="order-lines">
                {{-- On affiche les lignes existantes de la commande --}}
                @php $oldLines = old('lines', []); @endphp
                @if(!empty($oldLines))
                    {{-- Si la validation a échoué, on reprend les valeurs du old --}}
                    @foreach($oldLines as $i => $line)
                        <tr>
                            <td>
                                <select name="lines[{{ $i }}][product_id]" class="form-select">
                                    <option value="">-- Sélectionnez un produit --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $line['product_id'] == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" step="1" min="1" name="lines[{{ $i }}][quantity]" class="form-control" value="{{ $line['quantity'] }}" /></td>
                            <td><input type="number" step="0.01" min="0" name="lines[{{ $i }}][price]" class="form-control" value="{{ $line['price'] }}" /></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-line">X</button></td>
                        </tr>
                    @endforeach
                @else
                    {{-- Sinon, on prend les lignes de la base de données --}}
                    @foreach($order->orderLines as $index => $line)
                        <tr>
                            <td>
                                <select name="lines[{{ $index }}][product_id]" class="form-select select-product">
                                    <option value="">-- Sélectionnez un produit --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $line->product_id == $product->id ? 'selected' : '' }}  data-thumbnail="{{ asset('images/products/'.$product->image) }}">
                                            {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="number" step="1" min="1" name="lines[{{ $index }}][quantity]" class="form-control" value="{{ $line->quantity }}" /></td>
                            <td><input type="number" step="0.01" min="0" name="lines[{{ $index }}][price]" class="form-control" value="{{ $line->price }}" /></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-line">X</button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <button type="button" id="add-line" class="btn btn-secondary">Ajouter une ligne</button>
        <button type="submit" class="btn btn-primary">Mettre à jour la commande</button>
    </form>
</div>

<template id="order-line-template">
    <tr>
        <td>
            <select name="##product_id##" class="form-select">
                <option value="">-- Sélectionnez un produit --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} ({{ $product->sku }})</option>
                @endforeach
            </select>
        </td>
        <td><input type="number" step="1" min="1" name="##quantity##" class="form-control" value="1" /></td>
        <td><input type="number" step="0.01" min="0" name="##price##" class="form-control" /></td>
        <td><button type="button" class="btn btn-danger btn-sm remove-line">X</button></td>
    </tr>
</template>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
  $('.select-product').select2({
    templateResult: formatState,
    templateSelection: formatState
  });
});

function formatState (state) {
  if (!state.id) {
    return state.text;
  }

  // Récupération de la miniature depuis l'attribut data
  var thumbnail = $(state.element).data('thumbnail');
  if (!thumbnail) {
    return state.text; // Si pas d'image, on affiche juste le texte
  }

  var $state = $(
    '<span><img src="' + thumbnail + '" style="width: 30px; height: 30px; margin-right: 8px; object-fit: cover;" /> ' + state.text + '</span>'
  );
  return $state;
};
</script>
@endsection