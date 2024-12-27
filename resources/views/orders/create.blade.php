@extends('layouts.app')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
        /* Pour s’assurer que la liste suggestions se superpose bien */
        .suggestions-list {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000; /* Pour que la liste passe au-dessus d'autres éléments */
        }

        .suggestions-list li {
            padding: .5rem .75rem;
            cursor: pointer;
        }

        .suggestions-list li:hover {
            background-color: #f8f9fa;
        }
    </style>
@endsection

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

<div class="container-fluid">

    <h1 class="mt-5">Créer une nouvelle commande</h1>

    <form action="{{ route('order.store') }}" method="POST">
        @csrf

        {{-- Sélection du client (optionnel) --}}
        <div class="mb-3">
            <label for="client_id" class="form-label">Client (optionnel)</label>
            <select name="client_id" id="client_id" class="form-select">
                <option value="">Aucun client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->company }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Commentaire global --}}
        <div class="mb-3">
            <label for="comment" class="form-label">Commentaire</label>
            <textarea name="comment" id="comment" class="form-control">{{ old('comment') }}</textarea>
        </div>

        <hr>

        <h2>Lignes de commande</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Produit</th>
                <th>Taille</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th></th>
            </tr>
            </thead>
            <tbody id="order-lines">
                {{-- Première ligne par défaut --}}
                <tr>
                    <td>
                        <select name="lines[0][product_id]" class="form-select select-product">
                            <option value="">-- Sélectionnez un produit --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-thumbnail="{{ asset('images/products/'.$product->image) }}">
                                    {{$product->name}}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="size" id="size" class="form-control">
                            <option value="ALT">à la taille</option>
                            <option value="xs">XS</option>
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="xl">XL</option>
                            <option value="xxl">XXL</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" step="1" min="1" name="lines[0][quantity]" class="form-control" value="1" />
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0" name="lines[0][price]" class="form-control" />
                    </td>
                    <td>
                        {{-- Bouton pour supprimer la ligne si besoin --}}
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" id="add-line" class="btn btn-secondary"><i class="fa fa-plus"></i> Ajouter une ligne</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer la commande</button>
    </form>
</div>

{{-- Template de ligne de commande en JS --}}
<template id="order-line-template">
    <tr>
        <td>
            <select name="##product_id##" class="form-select select-product">
                <option value="">-- Sélectionnez un produit --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-thumbnail="{{ asset('images/products/'.$product->image) }}">
                        [{{$product->reference}}] - {{$product->name}}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="size" id="size" class="form-control">
                <option value="ALT">à la taille</option>
                <option value="xs">XS</option>
                <option value="s">S</option>
                <option value="m">M</option>
                <option value="l">L</option>
                <option value="xl">XL</option>
                <option value="xxl">XXL</option>
            </select>
        </td>
        <td>
            <input type="number" step="1" min="1" name="##quantity##" class="form-control" value="1" />
        </td>
        <td>
            <input type="number" step="0.01" min="0" name="##price##" class="form-control" />
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-line">X</button>
        </td>
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
document.addEventListener('DOMContentLoaded', () => {
    let lineIndex = 1;
    const addLineBtn = document.getElementById('add-line');
    const orderLinesTbody = document.getElementById('order-lines');
    const lineTemplate = document.getElementById('order-line-template').innerHTML;

    addLineBtn.addEventListener('click', () => {
        let newLine = lineTemplate
            .replace('##product_id##', `lines[${lineIndex}][product_id]`)
            .replace('##size##', `lines[${lineIndex}][size]`)
            .replace('##quantity##', `lines[${lineIndex}][quantity]`)
            .replace('##price##', `lines[${lineIndex}][price]`);

        orderLinesTbody.insertAdjacentHTML('beforeend', newLine);
        lineIndex++;
    });

    orderLinesTbody.addEventListener('click', (e) => {
        if(e.target.classList.contains('remove-line')){
            e.target.closest('tr').remove();
        }
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
