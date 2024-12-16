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
<form action="{{route('client.store')}}" method="POST">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nouveau Client</h1>
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
                        <label for="company" class="form-label">Nom de Société</label>
                        <input type="text" class="form-control" id="company" name="company">
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="first_name" name="first_name">
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="last_name" name="last_name">
                    </div>
                    <div class="mb-3">
                        <label for="address1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="address1" name="address1">
                    </div>
                    <div class="mb-3">
                        <label for="address2" class="form-label">Adresse complément</label>
                        <input type="text" class="form-control" id="address2" name="address2">
                    </div>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">Code postal</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code">
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control" id="city" name="city">
                    </div>
                    <div class="mb-3">
                        <label for="phone1" class="form-label">Téléhpone 1</label>
                        <input type="text" class="form-control" id="phone1" name="phone1">
                    </div>
                    <div class="mb-3">
                        <label for="phone2" class="form-label">Téléhpone 2</label>
                        <input type="text" class="form-control" id="phone2" name="phone2">
                    </div>
                    <div class="mb-3">
                        <label for="phone3" class="form-label">Téléhpone 1</label>
                        <input type="text" class="form-control" id="phone3" name="phone3">
                    </div>
                    <div class="mb-3">
                        <label for="siret" class="form-label">Numéro de SIRET</label>
                        <input type="text" class="form-control" id="siret" name="siret">
                    </div>
                    <div class="mb-3">
                        <label for="tva_number" class="form-label">Numéro de TVA</label>
                        <input type="text" class="form-control" id="tva_number" name="tva_number">
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Commentaire</label>
                        <textarea class="form-control" name="comment" id="comment" cols="30" rows="10"></textarea>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</form>




@endsection
