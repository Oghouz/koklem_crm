@extends('layouts.app')

@section('content')
<div class="mb-9">
    <div class="row g-2 mb-4">
    <div class="col-auto">
        <h2 class="mb-0">Clients</h2>
    </div>
    </div>
    <div id="products" data-list='{"valueNames":["customer","email","total-orders","total-spent","city","last-seen","last-order"],"page":10,"pagination":true}'>
    <div class="mb-4">
        <div class="row g-3">
        <div class="col-auto">
            <div class="search-box">
            <form class="position-relative">
                <input class="form-control search-input search" name="search" type="search" placeholder="Recherche..." aria-label="Search" value="{{Request::get('search')}}" />
                <span class="fas fa-search search-box-icon"></span>
            </form>
            </div>
        </div>
        <div class="col-auto scrollbar overflow-hidden-y flex-grow-1">

        </div>
        <div class="col-auto">
            <button class="btn btn-phoenix-secondary me-1 mb-1"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button>
            <a href="{{route('client.create')}}" class="btn btn-phoenix-primary me-1 mb-1"><span class="fas fa-plus me-2"></span>Nouveau Client</a>
        </div>
        </div>
    </div>
    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
        <div class="table-responsive scrollbar-overlay mx-n1 px-1">
        <table class="table table-sm fs-9 mb-0">
            <thead>
            <tr>
                <th class="white-space-nowrap fs-9 align-middle ps-0">
                <div class="form-check mb-0 fs-8">
                    <input class="form-check-input" id="checkbox-bulk-customers-select" type="checkbox" data-bulk-select='{"body":"customers-table-body"}' />
                </div>
                </th>
                <th class="sort align-middle pe-5" scope="col" data-sort="customer">
                    @sortablelink('company', 'Société')
                </th>
                <th class="sort align-middle pe-5" scope="col" data-sort="email">
                    @sortablelink('city', 'Ville')
                </th>
                <th class="sort align-middle text-center" scope="col" data-sort="total-orders" >COMMANDE</th>
                <th class="sort align-middle text-end ps-3" scope="col" data-sort="total-spent">TOTAL</th>
                <th class="sort align-middle text-end pe-0" scope="col" data-sort="last-order">DERNIERE COMMANDE</th>
            </tr>
            </thead>
            <tbody class="list" id="customers-table-body">
                @foreach ($clients as $client)
                <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                    <td class="fs-9 align-middle ps-0 py-3">
                    <div class="form-check mb-0 fs-8">
                        <input class="form-check-input" type="checkbox" data-bulk-select-row="" />
                    </div>
                    </td>
                    <td class="customer align-middle white-space-nowrap pe-5">
                        <a class="d-flex align-items-center text-body-emphasis" href="{{route('client.show', $client->id)}}">
                            <div class="avatar avatar-m">
                                <div class="avatar-name rounded-circle"><span>{{substr($client->company, 0, 1)}}</span></div>
                            </div>
                            <p class="mb-0 ms-3 text-body-emphasis fw-bold">{{$client->company}}</p>
                        </a></td>
                    <td class="email align-middle white-space-nowrap pe-5">
                        {{$client->city . " (" . $client->zip_code . ")"}}
                    </td>
                    <td class="total-orders align-middle white-space-nowrap fw-semibold text-center text-body-highlight">
                        {{$client->orders->count()}}
                    </td>
                    <td class="total-spent align-middle white-space-nowrap fw-bold text-end ps-3 text-body-emphasis">
                        {{$client->orders->sum('total_ttc')}} €
                    </td>
                    <td class="last-order align-middle white-space-nowrap text-body-tertiary text-end">
                        @if($client->orders->count() > 0)
                            {{$client->orders->last()->created_at->format('d/m/Y')}}    
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
        <div class="col-auto d-flex">
            <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
            <a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            <a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
        </div>
        <div class="col-auto d-flex">
            <button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
            <ul class="mb-0 pagination"></ul>
            <button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection
