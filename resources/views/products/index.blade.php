@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Gestion de Produit</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
        <a href="{{route('product.create')}}" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Nouveau</a>
        <button type="button" class="btn btn-sm btn-info">Export</button>
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
            <th></th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <th scope="row">#{{$product->id}}</th>
            <td>
                <a href="{{route('product.show', ['product'=>$product])}}">
                    @if($product->image)
                    <img src="{{asset('images/products/').'/'.$product->image}}" alt="" width="64">
                    @else
                    <i class="fa fa-shirt fa-2x"></i>
                    @endif
                </a>
            </td>
            <td>
                <span class="fw-bold">{{$product->reference}}</span>
                <p class="">{{$product->name}}</p>
            </td>
            <td>
                <span class="badge bg-secondary">{{$product->category->name}}</span>
            </td>
            <td class="text-end"><a href="{{route('product.edit', ['product' => $product])}}" class="btn btn-link"><i class="fa fa-edit"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
