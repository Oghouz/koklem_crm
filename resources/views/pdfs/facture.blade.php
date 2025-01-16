<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>²
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header, .footer {
            font-size: 12px;
            color: #555;
        }
        .header {
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 40px;
        }
        .content {
            margin: 0 40px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f4f4f4;
        }
        .right {
            text-align: right;
        }
        .company-info {
            margin-bottom: 20px;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>FACTURE</h1>
    </div>

    <div class="content">
        <!-- Informations de la société -->
        <div class="company-info">
            <strong>SAS KOKLEM</strong><br>
            3 RUE DE PROVENCE<br>
            94510 La Queue-en-Brie<br>
            Email : contact@koklem.fr<br>
            Téléphone : 06 78 72 53 58
        </div>

        <!-- Informations du client -->
        <div class="invoice-details">
            <strong>Facturé à :</strong><br>
            {{ $order->client->name }}<br>
            {{ $order->client->address1 }}<br>
            {{ $order->client->zip }} {{ $order->client->city }}
        </div>

        <!-- Tableau des produits -->
        <table class="table">
            <thead>
                <tr>
                    <th>Réf</th>
                    <th>Description</th>
                    <th class="right">Quantité</th>
                    <th class="right">P.U (H.T)</th>
                    <th class="right">Total (H.T)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderLines as $item)
                <tr>
                    <td>{{ $item->reference }}</td>
                    <td>{{ $item->description }}</td>
                    <td class="right">{{ $item->quantity }}</td>
                    <td class="right">{{ number_format($item->price, 2, ',', ' ') }} €</td>
                    <td class="right">{{ number_format($item->price*$item->quantity, 2, ',', ' ') }} €</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totaux -->
        <div class="right" style="margin-top: 20px;">
            <p><strong>Total H.T :</strong> {{ number_format($order->total_ht, 2, ',', ' ') }} €</p>
            <p><strong>TVA ({{ $order->vat_rate }}%) :</strong> {{ number_format($order->vat_amount, 2, ',', ' ') }} €</p>
            <p><strong>Total TTC :</strong> {{ number_format($order->total_ttc, 2, ',', ' ') }} €</p>
        </div>

        <!-- Informations bancaires -->
        <div style="margin-top: 20px;">
            <strong>Transférez le montant vers le compte suivant :</strong><br>
            IBAN : FR12345678921041<br>
            BIC : QONTOBIC
        </div>
    </div>

    <div class="footer">
        <p>SAS KOKLEM - 3 Rue de Provence, 94510 La Queue-en-Brie</p>
        <p>SIRET : 132456789456 / N° TVA : FR123456789</p>
        <p>Merci pour votre confiance.</p>
    </div>
</body>
</html>
