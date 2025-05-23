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
<form action="{{route('product.store')}}" method="POST">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nouveau Produit</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                @csrf
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
                        <input type="text" class="form-control" id="reference" name="reference" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom de produit</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Catégorie</label>
                        <select class="form-control" name="category_id" id="category_id" required>
                            <option value="" disabled selected>- Sélectionner une catégorie</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="size" id="size" class="form-control">
                            <option value="" selected disabled> - Séléctionner la taille</option>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                            <option value="XXL">XXL</option>
                            <option value="2Y">KID 2Y</option>
                            <option value="4Y">KID 4Y</option>
                            <option value="6Y">KID 6Y</option>
                            <option value="8Y">KID 8Y</option>
                            <option value="10Y">KID 10Y</option>
                            <option value="12Y">KID 12Y</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <select name="color_id" id="color_id" class="form-control">
                            <option value="" selected disabled> - Séléctionner un couleur</option>
                            @foreach($colors as $color)
                                <option value="{{$color->id}}" style="background-color: {{$color->code}}">{{$color->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Prix de produit</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="tva_id" class="form-label">TVA</label>
                        <select class="form-control" name="tva_id" id="tva_id" required>
                            @foreach($tvas as $tva)
                                <option value="{{$tva->id}}">{{$tva->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Photo</label>
                        <input class="form-control" type="file" id="image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description de produit</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</form>




@endsection
