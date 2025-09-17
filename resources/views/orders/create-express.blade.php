@extends('layouts.app')
@section('style')
    <style>
    .form-control {
        padding: 0.5rem 0.5rem;
    }
    .input-group-text {
        padding: 0.5rem 0.5rem;
        background-color: rgb(48, 49, 49) !important;
    }
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

        <form action="{{ route('order.store') }}" method="POST" id="order-form">
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
                    <th colspan="7">Taille</th>
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
                            <select class="form-select" class="product-type" data-line-id="0" onchange="changeTypeProduct(event)">
                                <option value="TA">T-shirt adulte</option>
                                <option value="SA">Sweat adulte</option>
                                <option value="SCA">Sweat cap adulte</option>
                                <option value="TE">T-shirt enfant</option>
                                <option value="SE">Sweat enfant</option>
                                <option value="SCE">Sweat cap enfant</option>
                            </select>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text" id="size-0-1">XS</span>
                                <select class="form-control" name="lines[0][XS][quantity]">
                                    @for($i = 0; $i <= 99; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text" id="size-0-2">S</span>
                                <select class="form-control"  name="lines[0][S][quantity]">
                                    @for($i = 0; $i <= 99; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text" id="size-0-3">M</span>
                                <select class="form-control"  name="lines[0][M][quantity]">
                                    @for($i = 0; $i <= 99; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text" id="size-0-4">L</span>
                                <select class="form-control"  name="lines[0][L][quantity]">
                                    @for($i = 0; $i <= 99; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text" id="size-0-5">XL</span>
                                <select class="form-control" name="lines[0][XL][quantity]">
                                    @for($i = 0; $i <= 99; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-text" id="size-0-6">XXL</span>
                                <select class="form-control" name="lines[0][XXL][quantity]">
                                    @for($i = 0; $i <= 99; $i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-line">X</button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>

                </tfoot>
            </table>

            <button type="button" id="add-line" class="btn btn-secondary"><i class="fa fa-plus"></i> Ajouter une ligne</button>
            <button type="submit" class="btn btn-primary position-absolute end-0"><i class="fa fa-save pull-end"></i> Enregistrer la commande</button>
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
                <select class="form-select" class="product-type" data-line-id="##index_line##" onchange="changeTypeProduct(event)">
                    <option value="TA">T-shirt adulte</option>
                    <option value="SA">Sweat adulte</option>
                    <option value="SCA">Sweat cap adulte</option>
                    <option value="TE">T-shirt enfant</option>
                    <option value="SE">Sweat enfant</option>
                    <option value="SCE">Sweat cap enfant</option>
                </select>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text" id="size-##index_line##-1">XS</span>
                    <select class="form-control" name="lines[##index_line##][XS][quantity]">
                        @for($i = 0; $i <= 99; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text" id="size-##index_line##-2">S</span>
                    <select class="form-control" name="lines[##index_line##][S][quantity]">
                        @for($i = 0; $i <= 99; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text" id="size-##index_line##-3">M</span>
                    <select class="form-control" name="lines[##index_line##][M][quantity]">
                        @for($i = 0; $i <= 99; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text" id="size-##index_line##-4">L</span>
                    <select class="form-control" name="lines[##index_line##][L][quantity]">
                        @for($i = 0; $i <= 99; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text"  id="size-##index_line##-5">XL</span>
                    <select class="form-control" name="lines[##index_line##][XL][quantity]">
                        @for($i = 0; $i <= 99; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <span class="input-group-text" id="size-##index_line##-6">XXL</span>
                    <select class="form-control" name="lines[##index_line##][XXL][quantity]">
                        @for($i = 0; $i <= 99; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
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
    const orderData = {
        client_id: null,
        comment: '',
        lines: []
    };

    $(document).ready(function() {

        if(sessionStorage.getItem('orderData')) {
            const orderData = JSON.parse(sessionStorage.getItem('orderData'));
            $('#client_id').val(orderData.client_id);
            $('#comment').val(orderData.comment);
        } 

        $('#order-form').on("change", function() {
            const formData = $(this).serializeArray();

            formData.forEach(item => {
                console.log(orderData);
                if(item.name.startsWith('lines')) {
                    // Gestion des lignes de commande
                    const lineMatch = item.name.match(/lines\[(\d+)\]\[(.*?)\](?:\[(.*?)\])?/);
                    if (lineMatch) {
                        const lineIndex = lineMatch[1];
                        const key = lineMatch[2];
                        const subKey = lineMatch[3] || null;

                        if (!orderData.lines[lineIndex]) {
                            orderData.lines[lineIndex] = {};
                        }
                        if (subKey) {
                            if (!orderData.lines[lineIndex][key]) {
                                orderData.lines[lineIndex][key] = {};
                            }
                            orderData.lines[lineIndex][key][subKey] = item.value;
                        } else {
                            orderData.lines[lineIndex][key] = item.value;
                        }
                    }
                } else {
                    orderData[item.name] = item.value;
                }
            });
            sessionStorage.setItem('orderData', JSON.stringify(orderData));
        });

        $('.select-product').select2({
            templateResult: formatState,
            templateSelection: formatState
        });

        let lineIndex = 1;

        // Ajouter une nouvelle ligne
        $('#add-line').on('click', function() {
            let template = $('#order-line-template').html()
                .replace('##design_id##', `lines[${lineIndex}][design_id]`)
                .replace('lines[##index_line##][XS][quantity]', `lines[${lineIndex}][XS][quantity]`)
                .replace('lines[##index_line##][S][quantity]', `lines[${lineIndex}][S][quantity]`)
                .replace('lines[##index_line##][M][quantity]', `lines[${lineIndex}][M][quantity]`)
                .replace('lines[##index_line##][L][quantity]', `lines[${lineIndex}][L][quantity]`)
                .replace('lines[##index_line##][XL][quantity]', `lines[${lineIndex}][XL][quantity]`)
                .replace('lines[##index_line##][XXL][quantity]', `lines[${lineIndex}][XXL][quantity]`)

                .replace('size-##index_line##-1', `size-${lineIndex}-1`)
                .replace('size-##index_line##-2', `size-${lineIndex}-2`)
                .replace('size-##index_line##-3', `size-${lineIndex}-3`)
                .replace('size-##index_line##-4', `size-${lineIndex}-4`)
                .replace('size-##index_line##-5', `size-${lineIndex}-5`)
                .replace('size-##index_line##-6', `size-${lineIndex}-6`)

                .replace('##quantity##', `lines[${lineIndex}][quantity]`)
                .replace('##index_line##', `${lineIndex}`);
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

    // Changer type de produit
    function changeTypeProduct(event) {
        const type = $(event.target).val();
        console.log(type);
        lineIndex = $(event.target).data('line-id');
        if (type === 'TA' || type === 'SA' || type === 'SCA') {
            $('#size-' + lineIndex + '-1').text('XS');
            $('#size-' + lineIndex + '-2').text('S');
            $('#size-' + lineIndex + '-3').text('M');
            $('#size-' + lineIndex + '-4').text('L');
            $('#size-' + lineIndex + '-5').text('XL');
            $('#size-' + lineIndex + '-6').text('XXL');
        } else if (type === 'TE' || type === 'SE' || type === 'SCE') {
            $('#size-' + lineIndex + '-1').text('2Y');
            $("[name='lines[" + lineIndex + "][XS][quantity]']").attr('name', `lines[${lineIndex}][2Y][quantity]`);

            $('#size-' + lineIndex + '-2').text('4Y');
            $("[name='lines[" + lineIndex + "][S][quantity]']").attr('name', `lines[${lineIndex}][4Y][quantity]`);

            $('#size-' + lineIndex + '-3').text('6Y');
            $("[name='lines[" + lineIndex + "][M][quantity]']").attr('name', `lines[${lineIndex}][6Y][quantity]`);

            $('#size-' + lineIndex + '-4').text('8Y');
            $("[name='lines[" + lineIndex + "][L][quantity]']").attr('name', `lines[${lineIndex}][8Y][quantity]`);

            $('#size-' + lineIndex + '-5').text('10Y');
            $("[name='lines[" + lineIndex + "][XL][quantity]']").attr('name', `lines[${lineIndex}][10Y][quantity]`);

            $('#size-' + lineIndex + '-6').text('12Y');
            $("[name='lines[" + lineIndex + "][XXL][quantity]']").attr('name', `lines[${lineIndex}][12Y][quantity]`);
        }
    }


    // $('.product-type').on('change', function () {
    //     const type = $(this).val();
    //     if (type === 'TA' || type === 'SA' || type === 'SCA') {
    //         $('#size-' + lineIndex + '-1').text('XS');
    //         $('#size-' + lineIndex + '-2').text('S');
    //         $('#size-' + lineIndex + '-3').text('M');
    //         $('#size-' + lineIndex + '-4').text('L');
    //         $('#size-' + lineIndex + '-5').text('XL');
    //         $('#size-' + lineIndex + '-6').text('XXL');
    //     } else if (type === 'TE' || type === 'SE' || type === 'SCE') {
    //         $('#size-' + lineIndex + '-1').text('2Y');
    //         $('#size-' + lineIndex + '-2').text('4Y');
    //         $('#size-' + lineIndex + '-3').text('6Y');
    //         $('#size-' + lineIndex + '-4').text('8Y');
    //         $('#size-' + lineIndex + '-5').text('10Y');
    //         $('#size-' + lineIndex + '-6').text('12Y');
    //     }
    // });
    </script>
@endsection
