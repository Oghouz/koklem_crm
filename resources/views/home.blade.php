@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<h6>Bonjour {{ auth()->user()->name }}</h6>
<p>Nous sommes le {{\Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
@endsection
