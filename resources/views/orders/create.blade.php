@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col">
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>

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
                        <select name="lines[0][design_id]" class="form-select select-product">
                            <option value="">- Sélectionner un produit -</option>
                            @foreach($designs as $design)
                                <option value="{{ $design->id }}" data-thumbnail="{{ asset('images/designs/'.$design->image) }}">
                                    {{ $design->name }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select name="lines[0][size]" class="form-control select-size">
                            <option value="ALT">À la taille</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" step="1" min="1" name="lines[0][quantity]" class="form-control quantity" value="1" />
                    </td>
                    <td>
                        <input type="number" step="0.01" min="0" name="lines[0][price]" class="form-control price" />
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-line">X</button>
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2">TOTAL: </th>
                    <th class="text-center" id="total-quantity">0</th>
                    <th class="text-end" id="total-price">0.00€</th>
                </tr>
            </tfoot>
        </table>
        <button type="button" id="add-line" class="btn btn-secondary"><i class="fa fa-plus"></i> Ajouter une ligne</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer la commande</button>
    </form>
</div>

{{-- Template de ligne de commande en JS --}}
<template id="order-line-template">
    <tr>
        <td>
            <select name="##design_id##" class="form-select select-product">
                <option value="">-- Sélectionnez un produit --</option>
                @foreach($designs as $design)
                    <option value="{{ $design->id }}" data-thumbnail="{{ asset('images/designs/'.$design->image) }}">
                        {{ $design->name }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="##size##" class="form-control select-size">
                <option value="ALT">À la taille</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
            </select>
        </td>
        <td>
            <input type="number" step="1" min="1" name="##quantity##" class="form-control quantity" value="1" />
        </td>
        <td>
            <input type="number" step="0.01" min="0" name="##price##" class="form-control price" />
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm remove-line">X</button>
        </td>
    </tr>
</template>

@endsection

@section('script')
<script>
$(document).ready(function() {
    $('.select-product').select2({
        templateResult: formatState,
        templateSelection: formatState
    });

    let lineIndex = 1;

    // Ajouter une nouvelle ligne
    $('#add-line').on('click', function() {
        let template = $('#order-line-template').html()
            .replace('##design_id##', `lines[${lineIndex}][design_id]`)
            .replace('##size##', `lines[${lineIndex}][size]`)
            .replace('##quantity##', `lines[${lineIndex}][quantity]`)
            .replace('##price##', `lines[${lineIndex}][price]`);
        $('#order-lines').append(template);

        $('.select-product').select2({
            templateResult: formatState,
            templateSelection: formatState
        });

        lineIndex++;
        updateTotals();
    });

    // Supprimer une ligne
    $(document).on('click', '.remove-line', function() {
        $(this).closest('tr').remove();
        updateTotals();
    });

    // Calcul des totaux
    $(document).on('input change', '.quantity, .price, .select-size', function() {
        updateTotals();
    });

    function updateTotals() {
        let totalQuantity = 0;
        let totalPrice = 0;

        $('#order-lines tr').each(function() {
            const size = $(this).find('.select-size').val();
            const quantity = parseInt($(this).find('.quantity').val()) || 0;
            const price = parseFloat($(this).find('.price').val()) || 0;

            const multiplier = (size === 'ALT') ? 6 : 1;

            totalQuantity += quantity * multiplier;
            totalPrice += (quantity * price) * multiplier;
        });

        $('#total-quantity').text(totalQuantity);
        $('#total-price').text(totalPrice.toFixed(2) + '€');
    }

    function formatState(state) {
        if (!state.id) return state.text;

        var thumbnail = $(state.element).data('thumbnail');
        if (!thumbnail) return state.text;

        return $(`<span><img src="${thumbnail}" style="width: 30px; height: 30px; margin-right: 8px; object-fit: cover;" /> ${state.text}</span>`);
    }
});
</script>
@endsection
