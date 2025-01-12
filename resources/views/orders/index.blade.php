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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion de Commande</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
        <a href="{{route('order.create')}}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Créer une commande</a>
    </div>
    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        This week
    </button>
    </div>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Société</th>
            <th>Status</th>
            <th>Date de commande</th>
            <th>Livré</th>
            <th>Payé</th>
            <th class="text-end">Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <th scope="row">#{{$order->id}}</th>
            <td>
                <span class="fw-bold">{{$order->client->company}}</span>
                <p class="p-0 m-0">{{$order->client->zip_code.' '.$order->client->city}}</p>
            </td>
            <td>{!! \App\Models\Order::getStatusBadge($order->status)!!}</td>
            <td>{{$order->created_at->format('d/m/Y')}}</td>
            <td>
                @if($order->delivery_date)
                    <span class="badge bg-dark">{{$order->delivery_date}}</span> 
                @else
                    <span class="badge bg-danger">Non livré</span>
                @endif
            </td>
            <td>
                @if($order->paid)
                    <span class="badge bg-success">Payé</span> 
                @else
                    <span class="badge bg-danger">Non Payé</span>
                @endif
            </td>
            <td class=text-end>{{number_format($order->total_ttc, 2, ',', ' ')}}€</td>
            <td class="text-end"><a href="{{route('order.edit', ['order' => $order])}}" class="btn btn-link"><i class="fa fa-edit"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
