<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FACTURE N° {{$invoice->invoice_num}}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        * {
            margin: 5px;
            font-size: 12px;
        }

        body {
            margin-bottom: 35px;
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
            font-size: 30px;
        }

        .header-info {
            border-radius: 3px;
            background-color: rgb(230, 230, 230);
            padding: 10px;
            font-weight: bold;
            width: 300px;
            border-bottom: 3px solid rgb(9, 163, 78);
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 35px;
            padding: 8px;
            font-size: 9px !important;
            line-height: 12px;
            border-top: 1px solid #ccc;
            text-align: center;
        }

        table {
            width: 100%;
            border: 1px solid rgb(49, 49, 49);
        }

        thead {
            background-color: rgb(49, 49, 49);
            border: 1px solid rgb(49, 49, 49);
            color: white;
        }

        th,
        td {
            padding: 3px 5px !important;
        }

        .page-number:after {
            content: counter(page) "/" counter(pages);
            position: absolute;
            right: 10px;
            bottom: 0px;
            font-size: 9px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="title">FACTURE N° {{$invoice->invoice_num}}</h3>
        <div class="row">
            <div class="col-xs-6">
                <p class="fw-bold">SAS KOKLEM</p>
                3 RUE DE PROVENCE<br>
                94510, LA QUEUE-EN-BRIE<br>
                SIRET: 93020115700011<br>
                contact@koklem.fr<br>
            </div>
            <div class="col-xs-6 header-info">
                <table style="border:none;">
                    <tr>
                        <td style="border: none;padding:1px;margin:0;">N° DE FACTURE</td>
                        <td style="border: none;padding:1px;margin:0;">{{$invoice->invoice_num}}</td>
                    </tr>
                    <tr>
                        <td style="border: none;padding:1px;margin:0;">DATE</td>
                        <td style="border: none;padding:1px;margin:0;">{{$invoice->issue_date}}</td>
                    </tr>
                    <tr>
                        <td style="border: none;padding:1px;margin:0;">DATE D'ÉCHÉANCE</td>
                        <td style="border: none;padding:1px;margin:0;">{{$invoice->due_date}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row" style="margin: 0!important;padding:0!important;">
            <div class="col-xs-6" style="margin-top: 0!important;padding-top:0!important;"></div>
            <div class="col-xs-6" style="margin-top: 0!important;padding-top:0!important;">
                <p style="margin: 0!important;padding:0 0 5px 0 !important;">Facturer à :</p>
                <p class="fw-bold">{{ $invoice->client_company }}</p>
                {{ $invoice->client_address1 }}<br>
                {{ $invoice->client_zip_code . ', ' . $invoice->client_city }}
            </div>
        </div>
        <div class="row" style="margin: 0!important;padding:0!important;">
            <div class="col-xs-12" style="margin: 0!important;padding:0!important;">
                <table style="margin: 0!important;padding:0!important;">
                    <thead>
                        <tr>
                            @if(!$type)
                            <th>Réf</th>@endif
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
                                @if(!$type)
                                <td class="small">{{ $line['reference'] }}</td>@endif
                                <td class="small">{{ $line['name'] }}</td>
                                <td class="text-center small">{{ $line['size'] }}</td>
                                <td class="text-center fw-bold">{{ $line['quantity'] }}</td>
                                <td class="text-right small">{{ number_format($line['price'], 2, ',', ' ') }}€</td>
                                <td class="text-right small">
                                    {{ number_format(($line['quantity'] * $line['price']), 2, ',', ' ') }}€</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" style="margin: 0!important;padding:0!important;">
            <div class="col-xs-4" style="margin: 0!important;padding:0!important;">
                <table style="margin: 0!important;padding:0!important;">
                    <thead>
                        <tr>
                            <th class="small text-right">BASE HT</th>
                            <th class="small text-right">TAUX</th>
                            <th class="small text-right">TVA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="small text-right">{{number_format($invoice->total_ht, 2, ',', ' ')}}€</td>
                            <td class="small text-right">20,00%</td>
                            <td class="small text-right">{{number_format($invoice->total_tva, 2, ',', ' ')}}€</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-2"></div>
            <div class="col-xs-5">
                <table class="total" style="margin: 0!important;padding:0!important;">
                    <tr>
                        <td colspan="5" class="text-right" style="border: none;padding:0;margin:0;">TOTAL H.T</td>
                        <td class="text-right" style="border: none;padding:0;margin:0;">
                            {{number_format($invoice->total_ht, 2, ',', ' ')}} €
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right" style="border: none;padding:0;margin:0;">TVA 20%</td>
                        <td class="text-right" style="border: none;padding:0;margin:0;">
                            {{number_format($invoice->total_tva, 2, ',', ' ')}} €
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right" style="border: none;padding:0;margin:0;">TOTAL T.T.C</td>
                        <td class="text-right" style="border: none;padding:0;margin:0;">
                            {{number_format($invoice->total_ttc, 2, ',', ' ')}} €
                        </td>
                    </tr>
                    <tr style="background-color: rgb(9, 163, 78);color:white;font-weight:bold;">
                        <td colspan="5" class="text-right" style="font-size:14px;">NET À PAYER</td>
                        <td class="text-right" style="font-size:14px;">
                            {{number_format($invoice->total_ttc, 2, ',', ' ')}} €
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <span>Commandes facturées : </span><br>
                @foreach($invoice->orders as $order)
                    <span> </span> commande n°{{$order->id}} du {{\Carbon\Carbon::parse($order->delivery_date)->format('d/m/Y')}}<br>
                @endforeach
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
            N° SIRET: 93020115700011 / RSC Creteil B 930 201 157 / APE: 2198 / N° TVA Intracommunautaire : FR07930201157
            / Email:
            contact@koklem.fr
        </div>
    </div>
    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
                $size = 8;
                $pageText = "Page " . $PAGE_NUM . " / " . $PAGE_COUNT;
                $y = 15;
                $x = 520;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>


</html>