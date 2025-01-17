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
                                <option value="Virement" @if($order->payment_method == "Virement") selected @endif>Virement</option>
                                <option value="Carte Bancaire" @if($order->payment_method == "Carte Bancaire") selected @endif>Carte Bancaire</option>
                                <option value="Espèces" @if($order->payment_method == "Espèces") selected @endif>Espèces</option>
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
                
        <div class="card mt-3">
            <div class="card-header p-4 border-bottom bg-body">
                <h6>Lignes de commande</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Réference</th>
                            <th>Produit</th>
                            <th class="text-center">Taille</th>
                            <th class="text-center">Quantité</th>
                            <th class="text-end">Prix</th>
                            <th class="text-end">Total</th>
                            <th class="text-end">Action</th>
                        </tr>
                        </thead>
                        <tbody id="order-lines">
                            @foreach($order->orderLines as $index => $line)
                                <tr class="fs-9" id="line-{{$line->id}}" data-id="{{$line->id}}">
                                    <td><img class="img-fluid order-image" src="{{asset('images/designs') . '/' . $line->design->image}}" width="32"  data-image="{{ asset('images/designs/' . $line->design->image) }}" style="cursor: pointer;"></td>
                                    <td class="fw-bold">{{$line->reference}}</td>
                                    <td data-field="product">{{$line->design->name}}</td>
                                    <td class="text-center" data-field="size">
                                        <span class="badge text-bg-secondary">{{$line->size}}</span>
                                    </td>
                                    <td class="text-center" data-field="quantity">
                                        <span class="fw-bold">{{$line->quantity}}</span>
                                    </td>
                                    <td class="text-end" data-field="price">
                                        <span>{{ number_format($line->price, 2, ",", ' ') }}€</span>
                                    </td>
                                    <td class="text-end">
                                        <span>{{ number_format(($line->price * $line->quantity), 2, ',', ' ') }}€</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="dropdown d-inline-block">
                                            <button class="btn btn-phoenix-secondary btn-sm dropdown-toggle" id="dropdownMenuButton" type="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button><span
                                                class="caret"> </span>
                                            <div class="dropdown-menu dropdown-menu-end py-0" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="{{route('design.show', $line->product)}}" target="_blank">
                                                    <i class="fa fa-eye"></i> Détail
                                                </a>
                                                <button type="button" class="dropdown-item btn-sm" onclick="editOrderLine({{$line->id}}, {{$line->design->id}}, '{{$line->size}}', {{$line->quantity}}, {{$line->price}})"><i class="fa fa-edit"></i> Modifier</button>
                                                <div class="dropdown-divider"></div>
                                                <button type="button" class="btn-sm text-danger dropdown-item" onclick="deleteOrderLine({{$line->id}})">
                                                    <i class="fa fa-trash"></i> Supprimer
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <table class="table table-borderless">
                            <tr>
                                <td class="text-end">TOTAL HT: <span
                                        class="fw-bold">{{number_format($order->total_ht, 2, ',', ' ')}}€</span></td>
                            </tr>
                            <tr>
                                <td class="text-end">TOTAL TVA : <span
                                        class="fw-bold">{{number_format($order->total_tva, 2, ',', ' ')}}€</span></td>
                            </tr>
                            <tr>
                                <td class="text-end">TOTAL TTC : <span
                                        class="fw-bold">{{number_format($order->total_ttc, 2, ',', ' ')}}€</span></td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3 mb-3">
            <button type="button" id="add-line" class="btn btn-secondary"><i class="fa fa-plus"></i> Ajouter une ligne</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Mettre à jour la commande</button>
        </div>
    </form>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Image" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<!-- Template order line -->
<template id="order-line-template">
    <tr class="bg-secondary-subtle">
        <td colspan="3">
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
                <option value="ALT">À la taille (XS à XXL)</option>
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
            <input type="number" step="1" min="1" name="##quantity##" class="form-control quantity text-center" value="1" placeholder="Quantité" />
        </td>
        <td>
            <input type="number" step="0.01" min="0" name="##price##" class="form-control price text-end" placeholder="Prix" />
        </td>
        <td></td>
        <td class="text-end">
            <input type="hidden" name="order_id" value="{{$order->id}}" />
            <button type="button" id="valide-order-line-btn" class="btn btn-sm btn-success" onclick="addOrderLine(##order_line_index##)"><i class="fa fa-check"></i></button>
            <button type="button" class="btn btn-sm btn-danger remove-line">X</button>
        </td>
    </tr>
</template>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.8/axios.min.js" integrity="sha512-v8+bPcpk4Sj7CKB11+gK/FnsbgQ15jTwZamnBf/xDmiQDcgOIYufBo6Acu1y30vrk8gg5su4x0CG3zfPaq5Fcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle image click to open modal
        document.querySelectorAll('.order-image').forEach(image => {
            image.addEventListener('click', function () {
                const modalImage = document.getElementById('modalImage');
                modalImage.src = this.getAttribute('data-image');
                const modal = new bootstrap.Modal(document.getElementById('imageModal'));
                modal.show();
            });
        });
    });
    $(document).ready(function () {
        $('.select-product').select2({
            templateResult: formatState,
            templateSelection: formatState
        });
    });

    let lineIndex = 1;

    // Ajouter une nouvelle ligne
    $('#add-line').on('click', function () {
        let template = $('#order-line-template').html()
            .replace('##design_id##', `lines[${lineIndex}][design_id]`)
            .replace('##size##', `lines[${lineIndex}][size]`)
            .replace('##quantity##', `lines[${lineIndex}][quantity]`)
            .replace('##price##', `lines[${lineIndex}][price]`)
            .replace('##order_line_index##', `${lineIndex}`);
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

    function addOrderLine(lineIndex) {
        let design_id = $('select[name="lines['+lineIndex+'][design_id]"]').val();
        let size = $('select[name="lines['+lineIndex+'][size]"]').val();
        let quantity = $('input[name="lines['+lineIndex+'][quantity]"]').val();
        let price = $('input[name="lines['+lineIndex+'][price]"]').val();

        if(isNaN(design_id) || !design_id) {
            Swal.fire({
                text: "Séléctionner un produit.",
                icon: "error",
                draggable: true
            });
            return;
        }

        if (isNaN(quantity) || quantity <= 0) {
            Swal.fire({
                text: "Quantité invalide.",
                icon: "error",
                draggable: true
            });
            return;
        }

        if (isNaN(price) || price <= 0) {
            Swal.fire({
                text: "Prix invalide.",
                icon: "error",
                draggable: true
            });
            return;
        }

        const data = {
            order_id: '{{$order->id}}',
            design_id: design_id,
            size: size,
            quantity: quantity,
            price: price
        };

        axios.post('/orderLine/add', data).
        then((response) => {
            console.log(response);
            location.reload();
        }).catch((error) => {
            console.error(error)
        });
    }

    function editOrderLine(order_line_id, design_id, size, quantity, price) {
        let template = $('#order-line-template').html()
            .replace('##design_id##', `lines[${order_line_id}][design_id]`)
            .replace('##size##', `lines[${order_line_id}][size]`)
            .replace('##quantity##', `lines[${order_line_id}][quantity]`)
            .replace('##price##', `lines[${order_line_id}][price]`)
            .replace('##order_line_index##', `${order_line_id}`)
            .replace('addOrderLine', 'updateOderLine');
        $('#line-'+order_line_id).replaceWith(template)
         $('select[name="lines[' + order_line_id + '][design_id]"]').val(design_id);
         $('select[name="lines[' + order_line_id + '][size]"]').val(size);
         $('input[name="lines[' + order_line_id + '][quantity]"]').val(quantity);
         $('input[name="lines[' + order_line_id + '][price]"]').val(price);
    }

    function updateOderLine(order_line_id) {

        $('#valide-order-line-btn').html('<i class="fa-solid fa-spinner fa-spin"></i>');
        let design_id = $('select[name="lines[' + order_line_id + '][design_id]"]').val();
        let size = $('select[name="lines[' + order_line_id + '][size]"]').val();
        let quantity = $('input[name="lines[' + order_line_id + '][quantity]"]').val();
        let price = $('input[name="lines[' + order_line_id + '][price]"]').val();

        if (isNaN(design_id) || !design_id) {
            Swal.fire({
                text: "Séléctionner un produit.",
                icon: "error",
                draggable: true
            });
            return;
        }

        if (isNaN(quantity) || quantity <= 0) {
            Swal.fire({
                text: "Quantité invalide.",
                icon: "error",
                draggable: true
            });
            return;
        }

        if (isNaN(price) || price <= 0) {
            Swal.fire({
                text: "Prix invalide.",
                icon: "error",
                draggable: true
            });
            return;
        }

        const data = {
            order_id: '{{$order->id}}',
            order_line_id: order_line_id,
            design_id: design_id,
            size: size,
            quantity: quantity,
            price: price
        };

        axios.put('/orderLine/update/'+order_line_id, data)
            .then((response) => {
                Swal.fire({
                    position: "top-end",
                    text: "Mise à jour réussie !",
                    icon: "success",
                    draggable: true,
                    showConfirmButton: false,
                    timer: 1000
                }).then(() => {
                    // Reload the page after the user clicks "OK"
                    location.reload();
                });
            }).catch((error) => {
                console.error(error)
            });

        console.log(data);
    }

    function deleteOrderLine(order_line_id) {
        Swal.fire({
        title: "Confirmation",
        text: "Voulez-vous vraiment supprimer cette ligne?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#696969",
        confirmButtonText: "Oui, supprimer!",
        cancelButtonText: "Annuler",
        }).then((result) => {
            if (result.isConfirmed) {
                axios.delete('/orderLine/delete/'+order_line_id)
                .then((response) => {
                    //console.log(response);
                    //$('#line-'+order_line_id).remove();
                    location.reload();
                })
            }
        });
    }
</script>
@endsection