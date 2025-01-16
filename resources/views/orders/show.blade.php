@extends('layouts.app')

@section('content')
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
<div class="container-fluid">
    <a href="{{route('order.index')}}" class="btn btn-sm btn-secondary mt-3"><i class="fa fa-arrow-left"></i> Retour</a>
    <a href="{{route('order.edit', $order)}}" class="btn btn-sm btn-primary mt-3 float-end">Modifier</a>
    <div class="row mt-3">
        <div class="col">
            <h1>Commande #{{ $order->id }} ({{ $order->num }})</h1>
        </div>
        <div class="col text-end">
            <a href="{{ route('order.generatePDF', ['id' => $order->id, 'type' => 'bl']) }}" class="btn btn-sm btn-secondary" target="_blank">
                <i class="fa fa-file-pdf"></i> Générer le Bon de Livraison
            </a>
            <a href="{{ route('order.generatePDF', ['id' => $order->id, 'type' => 'facture']) }}" class="btn btn-sm btn-warning" target="_blank">
                <i class="fa fa-file-pdf"></i> Générer la Facture
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <!-- Client Information -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">CLEINT</h3>
                    <b>{{$order->client->company}}</b><br>
                    {{$order->client->address1}}<br>
                    {{$order->client->zip_code}} {{$order->client->city}}<br>
                    {{$order->client->phone}}<br>
                    {{$order->client->email}}
                </div>
            </div>
        </div>
        <!-- Order Status -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">STATUT</h3>
                    Date de commande:  <span class="float-end">{{$order->created_at->format('d/m/Y')}}</span><br>
                    Status: <span class="float-end">{!! App\Models\Order::getStatusBadge($order->status) !!}</span><br>
                    Livré le: <span class="float-end">{{Carbon\Carbon::parse($order->delivery_date)->format('d/m/Y')}}</span><br>
                    Payé le:
                    @if($order->payment_date)
                        <span class="float-end">{{Carbon\Carbon::parse($order->payment_date)->format('d/m/Y')}}</span>
                    @else
                        <span class="float-end"><span class="badge bg-danger">Non payé</span></span>
                    @endif
                </div>
            </div>
        </div>
        <!-- Order Total -->
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h3 class="card-title">TOTAL</h3>
                    Total H.T: <span class="float-end">{{ number_format($order->total_ht, 2, ',', ' ') }} €</span><br>
                    Total TVA: <span class="float-end">{{ number_format($order->total_tva, 2, ',', ' ') }} €</span><br>
                    <div class="d-flex justify-content-between border-top border-translucent border-dashed pt-4">
                        <h4 class="mb-0">Total TTC:</h4>
                        <h4 class="mb-0">{{ number_format($order->total_ttc, 2, ',', ' ') }} €</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Lines -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title"><i class="fa fa-list"></i> Lignes de commande</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Produit</th>
                                <th class="text-center">Taille</th>
                                <th class="text-center">Quantité</th>
                                <th class="text-end">Prix unitaire</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderLines as $line)
                            <tr class="fs-9">
                                <td>
                                    <img class="img-fluid order-image" src="{{ asset('images/designs/' . $line->design->image) }}" width="32" data-image="{{ asset('images/designs/' . $line->design->image) }}" style="cursor: pointer;">
                                </td>
                                <td>
                                    {{$line->design->name}}<br>
                                    <b>{{$line->design->reference}}</b>
                                </td>
                                <td class="text-center"><span class="badge bg-dark">{{$line->size}}</span></td>
                                <td class="text-center fw-bold">{{$line->quantity}}</td>
                                <td class="text-end">{{number_format($line->price, 2, ',', ' ')}} €</td>
                                <td class="text-end">{{number_format($line->quantity * $line->price, 2, ',', ' ')}} €</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
</div>
@endsection

@section('script')
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
</script>
@endsection
