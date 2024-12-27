@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <a class="btn btn-secondary" href="{{route('product.index')}}"><i class="fa fa-arrow-left"></i> Retour</a>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <a href="{{route('product.edit', ['product'=>$product])}}" type="button" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Modifier</a>
        </div>
    </div>
</div>
<div class="container mt-5">
    <h1></h1>
    <div class="row">
        <div class="col-md-4">
            @if($product->image)
                <img src="{{asset('images/products/').'/'.$product->image}}">
            @endif
        </div>
        <div class="col-md-8">
            <h4>{{$product->reference}}</h4>
            <p class="fs-5">{{$product->name}}</p>
            <p>{{$product->description}}</p>
            <hr>
            <p class="mb-0">Prix de vente : {{number_format($product->price, 2, ',', ' ')}}€</p>
            <p class="mb-0">TVA: {{$product->tva->value}}%</p>
            <p>STOCK : <span class="badge bg-dark">{{$product->stock}}0</span></p>
            <p class="mb-0">Créer par {{$product->creator->name}}, le {{$product->created_at}}</p>
            <p>Dernière modification par {{$product->updater->name}}, le {{$product->updated_at}}</p>
        </div>
    </div>
</div>
@endsection