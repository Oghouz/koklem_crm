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
    <h1 class="h2">Gestion de Client</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group me-2">
        <a href="{{route('client.create')}}" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Nouveau</a>
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
            <th>Société</th>
            <th>Nom et Prénom</th>
            <th>Ville</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <th scope="row">#{{$client->id}}</th>
            <td class="fw-bold">{{$client->company}}</td>
            <td>{{$client->first_name.' '.$client->last_name}}</td>
            <td>
                <span class="badge bg-secondary">{{$client->city}}</span>
            </td>
            <td class="text-end"><a href="{{route('client.edit', ['client' => $client])}}" class="btn btn-link"><i class="fa fa-edit"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
