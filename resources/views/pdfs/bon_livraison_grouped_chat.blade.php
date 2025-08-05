<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Bon de Livraison</title>
    <style>
        @page {
            margin: 20mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header,
        .footer {
            text-align: center;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .footer {
            border-top: 2px solid #444;
            border-bottom: none;
            padding-top: 10px;
            margin-top: 20px;
            font-size: 10px;
        }

        .company-details {
            text-align: right;
        }

        .client-details {
            margin-top: 20px;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .details-box {
            border: 1px solid #999;
            padding: 10px;
            width: 48%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th,
        table td {
            border: 1px solid #aaa;
            padding: 6px;
            text-align: center;
        }

        table th {
            background-color: #eee;
        }

        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            width: 40%;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>BON DE LIVRAISON</h2>
        <p><strong>Numéro :</strong>  $bon['numero']  | <strong>Date :</strong>  $bon['date'] </p>
    </div>

    <div class="info-section">
        <div class="details-box">
            <strong>Client :</strong><br>
             $client['nom'] <br>
             $client['adresse'] <br>
             $client['ville']   $client['code_postal'] <br>
            Tél :  $client['telephone'] 
        </div>
        <div class="details-box company-details">
            <strong>Vendeur :</strong><br>
             $entreprise['nom'] <br>
             $entreprise['adresse'] <br>
             $entreprise['ville']   $entreprise['code_postal'] <br>
            Tél :  $entreprise['telephone'] 
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Unité</th>
                <th>Remarques</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finalLines as $index => $article)
                <tr>
                    <td> $index + 1 </td>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                    <td>  </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="signature-section">
        <div class="signature-box">
            <p>Signature Client</p>
            <br><br><br>
            __________________________
        </div>
        <div class="signature-box">
            <p>Signature Livraison</p>
            <br><br><br>
            __________________________
        </div>
    </div>

    <div class="footer">
        Merci pour votre confiance –  $entreprise['nom'] <br>
        SIRET :  $entreprise['siret']  – Email :  $entreprise['email'] 
    </div>

</body>

</html>