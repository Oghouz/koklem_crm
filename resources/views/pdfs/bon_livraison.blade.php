<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bon de Livraison</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        p {
            padding: 0;
            margin: 0;
        }
        .small {
            font-size: 0.8em;
        }
        thead {
            background-color: #dde0e2;
            font-size: 0.8em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <div class="row">
        <div class="col">
            <h2>BON DE LIVRAISON</h2>    
            <p>Commande #{{ $order->num }}</p>
            <p>Date : {{ $order->created_at->format('d/m/Y') }}</p>
            <p>Client : {{ $order->client->company }}</p>
        </div>
        <div class="col">
            <b>Client: </b>
            <p>{{ $order->client->company }}</p>
        </div>
    </div>

    <hr>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Réf</th>
                <th>Désignation</th>
                <th>Taille</th>
                <th>Qté commandée</th>
                <th>Qté livrée</th>
            </tr>
        </thead>
        <tbody class="small">
            @foreach($order->orderLines as $line)
            <tr>
                <td>{{ $line->design->reference }}</td>
                <td class="small">{{ $line->design->name }}</td>
                <td class="text-center">{{ $line->size }}</td>
                <td class="text-center">{{ $line->quantity }}</td>
                <td class="text-center">{{ $line->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="mt-5">
                <td colspan="3" class="text-end">TOTAL</td>
                <td class="text-center">45</td>
                <td class="text-center">45</td>
            </tr>
        </tfoot>
    </table>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
