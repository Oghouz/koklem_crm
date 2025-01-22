<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FACTURE N° {{date('y') . '-' . str_pad($order->id, 5, '0', STR_PAD_LEFT)}}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        * {
            margin: 5px;
            font-size: 12px;
        }
        body {
            margin-bottom: 30px;
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
        .title {
            color: rgb(9, 163, 78);
            margin: 0;
            padding: 0;
            font-weight: bold;
        }
        .header-info {
            border-radius: 8px;
            background-color: rgb(229, 229, 229);
            padding: 10px;
            font-weight: bold;
            width: 300px;
        }
        .footer {
            position: absolute; /* Remplacez fixed par absolute si nécessaire */
            bottom: 0; 
            left: 0; 
            right: 0;
            height: 30px; 
            padding: 8px;
            font-size: 9px !important;
            line-height: 12px;
            border-top: 1px solid #ccc; /* Ajoutez une bordure pour différencier */
        }
        table {
            width: 95%;
            border: 1px solid #ccc;
        }
        thead {
            background-color: rgb(49, 49, 49);
            color: white;
        }
        th, td {
            border-bottom: 1px solid #808080;
            padding: 3px 5px !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="title">FACTURE N° {{date('y') . '-' . str_pad($order->id, 5, '0', STR_PAD_LEFT)}}</h3>
        <div class="row">
            <div class="col-xs-6">
                <p class="fw-bold">KOKLEM</p>
                3 RUE DE PROVENCE<br>
                94510, La Queue-en-Brie<br>
                contact@koklem.fr<br>
            </div>
            <div class="col-xs-6 header-info">
                <table style="border:none;">
                    <tr>
                        <td style="border: none;padding:1px;">N° DE FACTURE</td>
                        <td style="border: none;padding:1px;">{{date('y') . '-' . str_pad($order->id, 5, '0', STR_PAD_LEFT)}}</td>
                    </tr>
                    <tr>
                        <td style="border: none;padding:1px;">DATE</td>
                        <td style="border: none;padding:1px;">{{$order->created_at->format('d/m/Y')}}</td>
                    </tr>
                    <tr>
                        <td style="border: none;padding:1px;">DATE D'ÉCHÉANCE</td>
                        <td style="border: none;padding:1px;">{{$order->created_at->addDay(30)->format('d/m/Y')}}</td>
                    </tr>
                </table>
                {{-- N° DE FACTURE : {{date('y') . '-' . $order->id}}<br>
                DATE : {{$order->created_at->format('d/m/Y')}}<br>
                DATE D'ÉCHÉANCE : {{$order->created_at->addDay(30)->format('d/m/Y')}}<br> --}}
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6"></div>
            <div class="col-xs-6">
                <h6>Facturer à</h6>
                <p class="fw-bold">{{ $order->client->company }}</p>
                {{ $order->client->address1 }}<br>
                {{ $order->client->zip_code . ', ' . $order->client->city }}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="">
                    <thead>
                        <tr>
                            <th>Réf</th>
                            <th>Désignation</th>
                            <th class="text-center">Taille</th>
                            <th class="text-center">Quantité</th>
                            <th class="text-right">P.U (H.T)</th>
                            <th class="text-right">TOTAL (H.T)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finalLines as $line)
                            <tr>
                                <td class="small">{{ $line['reference'] }}</td>
                                <td class="small">{{ $line['name'] }}</td>
                                <td class="text-center small">{{ $line['size'] }}</td>
                                <td class="text-center fw-bold">{{ $line['quantity'] }}</td>
                                <td class="text-right small">{{ number_format($line['price'], 2, ',', ' ') }}€</td>
                                <td class="text-right small">{{ number_format(($line['quantity'] * $line['price']), 2, ',', ' ') }}€</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="fw-bold">
                        <tr>
                            <td colspan="5" class="text-right" style="border: none;padding:0;margin:0;">TOTAL H.T</td>
                            <td class="text-right" style="border: none;padding:0;margin:0;">{{number_format($order->total_ht, 2, ',', ' ')}}€</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right" style="border: none;padding:0;margin:0;">TVA 20%</td>
                            <td class="text-right" style="border: none;padding:0;margin:0;">{{number_format($order->total_tva, 2, ',', ' ')}}€</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right" style="border: none;padding:0;margin:0;">TOTAL T.T.C</td>
                            <td class="text-right" style="border: none;padding:0;margin:0;">{{number_format($order->total_ttc, 2, ',', ' ')}}€</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        

        <div class="row">
            <div class="col-xs-12">
                <p class="text-center small"><i>NOUS VOUS REMERCIONS DE VOTRE CONFIANCE.</i></p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                Transférez le montant vers le compte ci-dessous:<br>
                IBAN: FR76 1695 8000 0165 9315 5973 914<br>
                BIC: QNTOFRP1XXX
            </div>
        </div>

        <div class="footer">
            KOKLEM SAS au capital de 12 000€ Siège social : 3 Rue de Provence, 94510 La Queue-en-Brie, France <br>
            N° SIRET: 93020115700011 /RSC Creteil B 930 201 157 / APE: 2198 / N° TVA Intracommunautaire : FR07930201157 / Email:
            contact@koklem.fr
        </div>
    </div>
</body>

</html>