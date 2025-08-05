<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bon de Livraison #{{$order->id}}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        * {
            margin: 5px;
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
        <h2>BON DE LIVRAISON</h2>
        <div class="row">
            <div class="col-xs-6">
                <p class="fw-bold">SAS KOKLEM</p>
                3 RUE DE PROVENCE<br>
                94510, LA QUEUE-EN-BRIE<br>
                SIRET: 93020115700011<br>
                contact@koklem.fr<br>

            </div>
            <div class="col-xs-6">
                Commande : #{{ $order->id }}<br>
                Date : {{ $order->created_at->format('d/m/Y') }} <br><br><br>
                <p class="fw-bold">{{ $order->client->company }}</p>
                {{ $order->client->address1 }}<br>
                {{ $order->client->zip_code . ', ' . $order->client->city }}
            </div>
        </div>

        <!-- Clearfix to ensure table is below -->
        <div style="clear: both;"></div>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Réf</th>
                    <th>Désignation</th>
                    <th>Taille</th>
                    <th>Qté cmdée</th>
                    <th>Qté livrée</th>
                </tr>
            </thead>
            <tbody class="small">
                {{$total = 0}}
                @foreach($finalLines as $line)
                    <tr>
                        <td class="small">{{ $line['reference'] }}</td>
                        <td class="small">{{ $line['name'] }}</td>
                        <td class="text-center">{{ $line['size'] }}</td>
                        <td class="text-center">{{ $line['quantity'] }}</td>
                        <td class="text-center">{{ $line['quantity'] }}</td>
                    </tr>
                    {{$total += $line['quantity']}}
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"></td>
                    <td class="text-center fw-bold">{{$total}}</td>
                    <td class="text-center fw-bold">{{$total}}</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">TOTAL H.T</td>
                    <td class="text-right">{{number_format($order->total_ht, 2, ',', ' ')}}€</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">TVA 20%</td>
                    <td class="text-right">{{number_format($order->total_tva, 2, ',', ' ')}}€</td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">TOTAL T.T.C</td>
                    <td class="text-right">{{number_format($order->total_ttc, 2, ',', ' ')}}€</td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>