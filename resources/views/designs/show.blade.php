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
<a class="btn btn-outline-secondary me-1 mb-1" href="{{route('design.index')}}">Retour</a>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$design->reference}}</h1>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <img class="img-fluid" src="{{asset('images/designs/').'/'.$design->image}}">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            Référence: <br>
            <span class="fw-bold">{{$design->reference}}</span>
        </div>
        <div class="mb-3">
            Libellé: <br>
            <span class="fw-bold">{{$design->name}}</span>
        </div>
        <div class="mb-3">
            Description: <br>
            <span class="fw-bold">{{$design->description}}</span>
        </div>
    </div>
</div>
@endsection
