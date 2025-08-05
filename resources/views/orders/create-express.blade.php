@extends('layouts.app')
@section('style')
    <style>
        .quantity {
            width: 74px;
        }
    </style>
@endsection

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
                    <th>Type</th>
                    <th class="text-center">XS</th>
                    <th class="text-center">S</th>
                    <th class="text-center">M</th>
                    <th class="text-center">L</th>
                    <th class="text-center">XL</th>
                    <th class="text-center">XXL</th>
                    <th>Prix</th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="order-lines">
                    <tr>
                        <td>
                            <select name="lines[0][design_id]" class="form-select select-product">
                                <option value="">- Sélectionner un produit -</option>
                                @foreach($designs as $design)
                                    <option value="{{ $design->id }}" data-thumbnail="{{ asset('images/designs/' . $design->image) }}">
                                        {{ $design->name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="form-select" name="" id="">
                                <option value="A">Adulte</option>
                                <option value="E">Enfant</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <div class="col-auto">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">XS</div>
                                    </div>
                                    <input type="number" class="form-control quantity">
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <span>S</span>
                            <input type="number" step="1" min="1" name="lines[0][S][quantity]" class="form-control quantity"/>
                        </td>
                        <td class="text-center">
                            <input type="number" step="1" min="1" name="lines[0][M][quantity]" class="form-control quantity"/>
                        </td>
                        <td class="text-center">
                            <input type="number" step="1" min="1" name="lines[0][L][quantity]" class="form-control quantity"/>
                        </td>
                        <td class="text-center">
                            <input type="number" step="1" min="1" name="lines[0][XL][quantity]" class="form-control quantity"/>
                        </td>
                        <td class="text-center">
                            <input type="number" step="1" min="1" name="lines[0][XXL][quantity]" class="form-control quantity"/>
                        </td>
                        <td>
                            <input type="number" step="0.01" min="0" name="##price##" class="form-control price"/>
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
            <button type="button" id="add-discount" class="btn btn-warning"><i class="fa fa-percent"></i> Remise</button>
            <button type="button" id="add-line" class="btn btn-secondary"><i class="fa fa-plus"></i> Ajouter une ligne</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save pull-end"></i> Enregistrer la commande</button>
        </form>
    </div>

    {{-- Template de ligne de commande en JS --}}
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
                    <option value="ALT">À la taille (Adulte)</option>
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="ALT-KID">À la taille (KID)</option>
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
        let priceTshirt = 0;
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

            $(`input[name="lines[${lineIndex}][price]"]`).val(priceTshirt);

            lineIndex++;
            updateTotals();
        });

        // Ajouter une remise
        $('#add-discount').on('click', function() {
            let discount = prompt("Entrez le montant de la remise :");
            if (discount !== null) {
                discount = parseFloat(discount);
                if (!isNaN(discount)) {
                    $('#total-price').text((parseFloat($('#total-price').text()) - discount).toFixed(2) + '€');
                } else {
                    alert("Veuillez entrer un montant valide.");
                }
            }
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

        $('#client_id').on('change', function() {
            const clientId = $(this).val();
            if (clientId) {
                $.ajax({
                    url: `/client/getPriceTshirt`,
                    method: 'post',
                    data: {
                        client_id: clientId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        // Traitez les données reçues ici
                        console.log(data);
                        priceTshirt = data.price_tshirt;
                        $('input[name="lines[0][price]"]').val(priceTshirt);
                    },
                    error: function(xhr) {
                        console.error(xhr);
                    }
                });
            }

        });

        function updateTotals() {
            let totalQuantity = 0;
            let totalPrice = 0;

            $('#order-lines tr').each(function() {
                const size = $(this).find('.select-size').val();
                const quantity = parseInt($(this).find('.quantity').val()) || 0;
                const price = parseFloat($(this).find('.price').val()) || 0;

                const multiplier = (size === 'ALT' || size == 'ALT-KID') ? 6 : 1;

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
