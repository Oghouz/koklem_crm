<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bon de Livraison #{{$order->id}}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        * {
            font-size: 12px;
        }
        p {
            padding: 0;
            margin: 0;
        }
        td {
            padding: 2px !important;
            margin: 0 !important;
        }
        .fw-bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h2>BON DE LIVRAISON</h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-6">
                <p class="fw-bold" style="font-size:">SAS KOKLEM</p>
                3 RUE DE PROVENCE<br>
                94510, LA QUEUE-EN-BRIE<br>
                SIRET: 93020115700011<br>
                contact@koklem.fr<br>

            </div>
            <div class="col-xs-6" style="font-size: 16px;">
                <p style="font-size: 18px;">N° de commande : {{ $order->id }}<br>
                Date : {{ $order->created_at->format('d/m/Y') }} </p><br><br>
                <b>{{ $order->client->company }}</b><br>
                @if($order->client->address2)
                    {{ $order->client->address2 }}<br>
                @endif
                {{ $order->client->address1 }}<br>
                {{ $order->client->zip_code . ', ' . $order->client->city }}
            </div>
        </div>

        <!-- Clearfix to ensure table is below -->
        <div style="clear: both;"></div>


        <table class="table table-bordered" style="margin-top: 50px;">
            <thead>
                <tr>
                    <th>Réf</th>
                    <th>Désignation</th>
                    <th class="text-center">Prix</th>
                    <th class="text-center">Quantité livrée</th>
                </tr>
            </thead>
            <tbody class="small">
                @php $count = 0; @endphp
                @foreach($finalLines as $category_id => $line)
                    @php
    $count += $line['quantity'];
                    @endphp
                    <tr>
                        @if($category_id == 1)
                        <td>TSH</td>
                        <td>T-shirt adulte unisex</td>
                        @elseif($category_id == 2)
                            <td>TSH-KID</td>
                            <td>T-shirt enfant unisex</td>
                        @endif
                        <td class="text-center">{{ $line['price']}}</td>
                        <td class="text-center">{{ $line['quantity']}}</td>
                    </tr>
                        {{-- <tr>
                            <td class="small">{{ $line['reference'] }}</td>
                            <td class="small">{{ $line['name'] }}</td>
                            <td class="text-center">{{ $line['size'] }}</td>
                            <td class="text-center">{{ $line['quantity'] }}</td>
                            <td class="text-center">{{ $line['quantity'] }}</td>
                        </tr>
                        {{$total += $line['quantity']}} --}}
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td class="text-center"><b>TOTAL: {{$count}}</b></td>
                </tr>
            </tfoot>
        </table>
        <table style="text-align: right; width: 100%;font-size: 22px; margin-top: 20px;font-weight: bold;">
            <tr>
                <td class="text-right">
                     <b>TOTAL H.T : </b>
                     {{number_format($order->total_ht, 2, ',', ' ')}}€
                </td>
            </tr>
            <tr>
                <td>
                    <b>TVA 20% : </b>
                    {{number_format($order->total_tva, 2, ',', ' ')}}€
                </td>
            </tr>
            <tr>
                <td class="text-right">
                    <b>TOTAL T.T.C : </b>
                    {{number_format($order->total_ttc, 2, ',', ' ')}}€
                </td>
            </tr>
        </table>
        <div class="row" style="margin-top: 250px;">
            <div class="col-xs-4"></div>
            <div class="col-xs-8">
                Signature / Cachet du client : _______________________<br>
            </div>
        </div>
        <div class="row">
            <div class="col text-center" style="position: absolute; bottom: 0; width: 100%;font-size: 10px;">
                <hr>
                KOKLEM SAS au capital de 12 000€ Siège social : 3 Rue de Provence, 94510 La Queue-en-Brie, France <br>
                N° SIRET: 93020115700011 /RSC Creteil B 930 201 157 / APE: 2198 / N° TVA Intracommunautaire : FR07930201157 / Email:
                contact@koklem.fr
            </div>
        </div>
    </div>
</body>

</html>