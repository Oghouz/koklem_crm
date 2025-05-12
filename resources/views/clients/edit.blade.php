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
    <form action="{{route('client.update', ['client' => $client])}}" method="POST">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <a href="{{route('client.index')}}" class="btn btn-subtle-secondary me-1 mb-1" type="button">
                    <i class="fa-solid fa-arrow-left"></i> Retour
                </a>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Enregistrer</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="row g-3">
                    <div class="col-12 col-md-7 col-xxl-12">
                        <div class="card h-xxl-auto">
                            <div class="card-body d-flex flex-column justify-content-between pb-3">
                                <div class="row align-items-center g-5 mb-3 text-center text-sm-start">
                                    <div class="col-12 col-sm-auto mb-sm-2">
                                        <div class="avatar avatar-5xl">
                                            <div class="avatar-name rounded-circle">
                                                <span>{{substr($client->company, 0, 1)}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-auto flex-1">
                                        <h3>{{$client->company}}</h3>
                                        <p class="text-body-secondary">Dernière commande: </p>
                                    </div>
                                </div>
                                <div class="d-flex flex-between-center border-top border-dashed pt-4">
                                    <div>
                                        <h6>Commande</h6>
                                        <p class="fs-7 text-body-secondary mb-0">{{$client->orders->count()}}</p>
                                    </div>
                                    <div>
                                        <h6>Total</h6>
                                        <p class="fs-7 text-body-secondary mb-0">{{$client->orders->sum('total_ttc')}} €</p>
                                    </div>
                                    <div>
                                        <h6>Completion</h6>
                                        <p class="fs-7 text-body-secondary mb-0">100</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-5 col-xxl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <h3 class="me-1">Addresse</h3>
                                </div>
                                <h5 class="text-body-secondary">{{$client->company}}</h5>
                                <p class="text-body-secondary">
                                    <a href="https://maps.google.fr/maps?q={{$client->address1 . ' ' . $client->zip_code . ' ' . $client->city}}"
                                        target="_blank">
                                        {{$client->address1}}<br />{{$client->zip_code}}, {{$client->city}}<br />
                                    </a>
                                </p>
                                <h5 class="text-body-secondary">Email: </h5><a
                                    href="mailto:{{$client->email}}">{{$client->email}}</a>
                                <h5 class="text-body-secondary">Téléphone: </h5><a class="text-body-secondary"
                                    href="#">{{$client->phone1}}</a>
                                <h5 class="text-body-secondary mt-3">SIRET:</h5><a class="text-body-secondary"
                                    href="#">{{$client->siret}}</a>
                                <h5 class="text-body-secondary">N° TVA:</h5><a class="text-body-secondary"
                                    href="#">{{$client->tva_number}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-4">Commentaire</h3>
                                <p>{!! $client->comment !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="company" class="form-label">Nom de Société</label>
                            <input type="text" class="form-control" id="company" name="company" value="{{$client->company}}">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{$client->first_name}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{$client->last_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address1" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="address1" name="address1" value="{{$client->address1}}">
                        </div>
                        <div class="mb-3">
                            <label for="address2" class="form-label">Adresse complément</label>
                            <input type="text" class="form-control" id="address2" name="address2" value="{{$client->address2}}">
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="zip_code" class="form-label">Code postal</label>
                                    <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{$client->zip_code}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="city" class="form-label">Ville</label>
                                    <input type="text" class="form-control" id="city" name="city" value="{{$client->city}}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="phone1" class="form-label">Téléhpone 1</label>
                                    <input type="text" class="form-control" id="phone1" name="phone1" value="{{$client->phone1}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="phone2" class="form-label">Téléhpone 2</label>
                                    <input type="text" class="form-control" id="phone2" name="phone2" value="{{$client->phone2}}">
                                </div>
                                <div class="col-md-4">
                                    <label for="phone3" class="form-label">Téléhpone 3</label>
                                    <input type="text" class="form-control" id="phone3" name="phone3" value="{{$client->phone3}}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="siret" class="form-label">Numéro de SIRET</label>
                                    <input type="text" class="form-control" id="siret" name="siret" value="{{$client->siret}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="tva_number" class="form-label">Numéro de TVA</label>
                                    <input type="text" class="form-control" id="tva_number" name="tva_number" value="{{$client->tva_number}}">
                                </div>
                            </div>  
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$client->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="price_tshirt" class="form-label">Prix proposé pour le t-shirt</label>
                            <input type="number" class="form-control" step=".01" id="price_tshirt" name="price_tshirt" value="{{$client->price_tshirt}}">
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Commentaire</label>
                            <textarea class="form-control" name="comment" id="comment" cols="30" rows="10">{{$client->comment}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
