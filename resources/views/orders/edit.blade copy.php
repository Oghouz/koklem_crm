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
<div class="container">
    <form action="{{ route('order.update', $order->id) }}" method="POST">
        <div class="row mb-3">
            <div class="col-sm-6">
                <a href="{{ route('order.index') }}" class="btn btn-secondary">Retour à la liste des commandes</a>
            </div>
            <div class="col-sm-6">
                <button type="submit" class="btn btn-primary float-end">Mettre à jour la commande</button>
            </div>
        </div>
        <h1>Modifier la commande #{{ $order->id }}</h1>
        
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">
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
                    <div class="row gx-3">
                        <div class="col-sm-6">
                            <label for="status">Statut Commande</label>
                            <select name="status" id="status" class="form-control">
                                @foreach(\App\Models\Order::getStatusLabel() as $order_status_i => $order_status)
                                    <option value="{{$order_status_i}}" {{$order->status == $order_status_i ? 'selected' : ''}}>{{$order_status}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="delivery_date">Livré le</label>
                            <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="{{ old('delivery_date', $order->delivery_date) }}">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="row gx-3">
                        <div class="col-sm-6">
                            <label for="payment_date">Payé le</label>
                            <input type="date" name="payment_date" id="payment_date" class="form-control" value="{{ old('payment_date', $order->payment_date) }}">
                        </div>
                        <div class="col-sm-6">
                            <label for="payment_method">Mode de paiement</label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option value="">- Séléctionner le mode de paiement</option>
                                <option value="Virement">Virement</option>
                                <option value="Carte Bancaire">Carte Bancaire</option>
                                <option value="Espèces">Espèces</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Commentaire global --}}
                <div class="mb-3">
                    <label for="comment" class="form-label">Commentaire</label>
                    <textarea name="comment" id="comment" class="form-control">{{ old('comment', $order->comment) }}</textarea>
                </div>
            </div>
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
                {{-- On affiche les lignes existantes de la commande --}}
                @php $oldLines = old('lines', []); @endphp
                @if(!empty($oldLines))
                    {{-- Si la validation a échoué, on reprend les valeurs du old --}}
                    @foreach($oldLines as $i => $line)
                        <tr>
                            <td>
                                <select name="lines[{{ $i }}][design_id]" class="form-select">
                                    <option value="">-- Sélectionnez un produit --</option>
                                    @foreach($designs as $design)
                                        <option value="{{ $design->id }}" {{ $line['design_id'] == $design->id ? 'selected' : '' }}>
                                            {{ $design->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="lines[{{ $index }}][size]" id="size" class="form-control">
                                    <option value="ALT" {{$line->size == 'ALT' ? 'selected' : ''}}>à la taille</option>
                                    <option value="XS" {{$line->size == 'XS' ? 'selected' : ''}}>XS</option>
                                    <option value="S"  {{$line->size == 'S' ? 'selected' : ''}}>S</option>
                                    <option value="L"  {{$line->size == 'M' ? 'selected' : ''}}>M</option>
                                    <option value="L"  {{$line->size == 'L' ? 'selected' : ''}}>L</option>
                                    <option value="XL" {{$line->size == 'XL' ? 'selected' : ''}}>XL</option>
                                    <option value="XXL" {{$line->size == 'XXL' ? 'selected' : ''}}>XXL</option>
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
                                    @foreach($designs as $design)
                                        <option value="{{ $design->id }}" {{ $line->design_id == $design->id ? 'selected' : '' }}  data-thumbnail="{{ asset('images/designs/' . $design->image) }}">
                                            {{ $design->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="lines[{{ $index }}][size]" id="size" class="form-control">
                                    <option value="">- Séléctionner la taille</option>
                                    <option value="ALT" {{$line->size == 'ALT' ? 'selected' : ''}}>à la taille</option>
                                    <option value="XS" {{$line->size == 'XS' ? 'selected' : ''}}>XS</option>
                                    <option value="S"  {{$line->size == 'S' ? 'selected' : ''}}>S</option>
                                    <option value="L"  {{$line->size == 'M' ? 'selected' : ''}}>M</option>
                                    <option value="L"  {{$line->size == 'L' ? 'selected' : ''}}>L</option>
                                    <option value="XL" {{$line->size == 'XL' ? 'selected' : ''}}>XL</option>
                                    <option value="XXL" {{$line->size == 'XXL' ? 'selected' : ''}}>XXL</option>
                                    <option value="2Y" {{$line->size == '2Y' ? 'selected' : ''}}>KID 2Y</option>
                                    <option value="4Y" {{$line->size == '4Y' ? 'selected' : ''}}>KID 4Y</option>
                                    <option value="6Y" {{$line->size == '6Y' ? 'selected' : ''}}>KID 6Y</option>
                                    <option value="8Y" {{$line->size == '8Y' ? 'selected' : ''}}>KID 8Y</option>
                                    <option value="10Y" {{$line->size == '10Y' ? 'selected' : ''}}>KID 10Y</option>
                                    <option value="12Y" {{$line->size == '12Y' ? 'selected' : ''}}>KID 12Y</option>
                                </select>
                            </td>
                            <td><input type="number" step="1" min="1" name="lines[{{ $index }}][quantity]" class="form-control" value="{{ $line->quantity }}" /></td>
                            <td><input type="number" step="0.01" min="0" name="lines[{{ $index }}][price]" class="form-control" value="{{ $line->price }}" /></td>
                            <td><button type="button" class="btn btn-danger btn-sm remove-line">X</button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end">TOTAL HT: <span class="fw-bold">{{number_format($order->total_ht, 2, ',', ' ')}}€</span></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">TOTAL TVA : <span class="fw-bold">{{number_format($order->total_tva, 2, ',', ' ')}}€</span></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end">TOTAL TTC : <span class="fw-bold">{{number_format($order->total_ttc, 2, ',', ' ')}}€</span></td>
                </tr>
            </tfoot>
        </table>
        <button type="button" id="add-line" class="btn btn-secondary">Ajouter une ligne</button>
        <button type="submit" class="btn btn-primary">Mettre à jour la commande</button>
    </form>
</div>

<template id="order-line-template">
    <tr>
        <td>
            <select name="##design_id##" class="form-select select-product">
                <option value="">-- Sélectionnez un produit --</option>
                @foreach($designs as $design)
                    <option value="{{ $design->id }}" data-thumbnail="{{ asset('images/designs/' . $design->image) }}">
                        {{ $design->name }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="##size##" class="form-control select-size">
                <option value="">- Séléctionner la taille</option>
                <option value="ALT">À la taille</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
                <option value="2Y">KID 2Y</option>
                <option value="4Y">KID 4Y</option>
                <option value="6Y">KID 6Y</option>
                <option value="8Y">KID 8Y</option>
                <option value="10Y">KID 10Y</option>
                <option value="12Y">KID 12Y</option>
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
    $(document).ready(function () {
        $('.select-product').select2({
            templateResult: formatState,
            templateSelection: formatState
        });

        let lineIndex = 1;

        // Ajouter une nouvelle ligne
        $('#add-line').on('click', function () {
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
        $(document).on('click', '.remove-line', function () {
            $(this).closest('tr').remove();
            updateTotals();
        });

        // Calcul des totaux
        $(document).on('input change', '.quantity, .price, .select-size', function () {
            updateTotals();
        });

        function updateTotals() {
            let totalQuantity = 0;
            let totalPrice = 0;

            $('#order-lines tr').each(function () {
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