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
<form action="{{route('product.update', ['product' => $product])}}" method="POST">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Mettre à jours Produit</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Enregistrer</button>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="reference" class="form-label">Référence</label>
                        <input type="text" class="form-control" id="reference" name="reference" value="{{$product->reference}}" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie</label>
                        <select class="form-control" name="category_id" id="category_id" required>
                            <option value="" disabled selected>- Sélectionner une catégorie -</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de produit</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description de produit</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="3">{{$product->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Prix de produit</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}">
                    </div>
                    <div class="mb-3">
                        <label for="tva_id" class="form-label">TVA</label>
                        <select class="form-control" name="tva_id" id="tva_id" required>
                            @foreach($tvas as $tva)
                                <option value="{{$tva->id}}" @if($tva->id == $product->id) selected @endif>{{$tva->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Photo</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection