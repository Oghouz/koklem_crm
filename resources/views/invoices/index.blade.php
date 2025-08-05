@extends('layouts.app')

@section('content')


    <div class="mb-9">
        <div class="d-flex mb-5" id="scrollspyStats">
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold">
                    <span class="bg-body pe-2">Factures</span>
                    <span class="border border-primary position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="px-3 mb-5">
                <div class="row justify-content-between">
                    <div class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end border-bottom pb-4 pb-xxl-0 ">
                        <span class="uil fs-5 lh-1 uil-file text-primary"></span>
                        <h1 class="fs-5 pt-3">{{$invoices->count()}}</h1>
                        <p class="fs-9 mb-0">Total Facture</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end-md border-bottom pb-4 pb-xxl-0">
                        <span class="uil fs-5 lh-1 uil-euro text-success"></span>
                        <h1 class="fs-5 pt-3">{{number_format($invoices->sum('total_ht'), 2, ',', ' ')}}</h1>
                        <p class="fs-9 mb-0">Montant Total H.T</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                        <span class="uil fs-5 lh-1 uil-euro text-warning"></span>
                        <h1 class="fs-5 pt-3">{{number_format($invoices->sum('total_ttc'), 2, ',', ' ')}}</h1>
                        <p class="fs-9 mb-0">Montant Total TTC</p>
                    </div>
                    {{-- <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-md border-end-xxl-0 border-bottom border-bottom-md-0 pb-4 pb-xxl-0 pt-4 pt-xxl-0">
                        <span class="uil fs-5 lh-1 uil-euro text-danger"></span>
                        <h1 class="fs-5 pt-3">1,200</h1>
                        <p class="fs-9 mb-0">En retard</p>
                    </div> --}}
                </div>
            </div>
        </div>
        <div id="orderTable" data-list='{"valueNames":["order","total","customer","payment_status","fulfilment_status","delivery_type","date"],"page":10,"pagination":true}'>
        <div class="mb-2">
            <div class="row g-3">
                <form action="" class="d-flex" method="GET">
                <div class="col-auto">
                    <div class="search-box">
                        <input class="form-control search-input search" name="search" type="search" placeholder="Recherche..." aria-label="Search" value="{{Request::get('search')}}" />
                        <span class="fas fa-search search-box-icon"></span>
                    </div>
                </div>
                <div class="col-auto scrollbar overflow-hidden-y flex-grow-1">
                    <div class="btn-group position-static text-nowrap" role="group">
                            <input type="date" class="form-control" name="date_debut" placeholder="Date de début"
                                value="{{Request::get('date_debut')}}" />
                            <span class="m-2"> à </span>
                            <input type="date" class="form-control" name="date_fin" placeholder="Date de fin"
                                value="{{Request::get('date_fin')}}" />

                    </div>
                    <div class="btn-group position-static" role="group">
                        <div class="btn-group position-static text-nowrap" role="group">
                            <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                Statut Paiement<span class="fas fa-angle-down ms-2"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['paid' => 1])}}">Payée</a></li>
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['paid' => 2])}}">Non Payée</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['paid' => ''])}}">Tous</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-group position-static" role="group">
                        <div class="btn-group position-static text-nowrap" role="group">
                            <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown"
                                data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                Mode de Paiement<span class="fas fa-angle-down ms-2"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['payment_method' => 'Virement'])}}">Virement</a></li>
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['payment_method' => 'Chèque'])}}">Chèque</a></li>
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['payment_method' => 'Carte Bancaire'])}}">Carte Bancaire</a></li>
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['payment_method' => 'Espèces'])}}">Espèces</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['payment_method' => ''])}}">Tous</a></li>
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary "><i class="fa fa-search"></i></button>
                    <a href="{{route('invoice.index')}}" class="btn btn-sm btn-secondary "><i class="fa fa-times"></i></a>
                </div>

                </form>
                {{-- <div class="col-auto">
                    <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button>
                    <a href="{{route('order.create')}}" class="btn btn-primary"><span class="fas fa-plus me-2"></span>Nouvelle Facture</a>
                </div> --}}
            </div>
        </div>
        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
            <div class="table-responsive scrollbar mx-n1 px-1">
            <table class="table table-sm fs-9 mb-0">
                <thead>
                <tr>
                    <th class="white-space-nowrap fs-9 align-middle ps-0">
                        <div class="form-check mb-0 fs-8">
                            <input class="form-check-input" id="checkbox-bulk-order-select" type="checkbox" data-bulk-select='{"body":"order-table-body"}' />
                        </div>
                    </th>
                    <th class="sort white-space-nowrap align-middle pe-3" scope="col">
                        @sortablelink('id', 'N° FACTURE')
                    </th>
                    <th class="sort align-middle pe-0" scope="col">
                        @sortablelink('issue_date', 'DATE')
                    </th>
                    <th class="sort align-middle ps-8" scope="col">
                        @sortablelink('client_id', 'CLIENT')
                    </th>
                    <th class="sort align-middle pe-3" scope="col">
                        @sortablelink('paid', 'PAIEMENT')
                    </th>
                    <th class="sort align-middle pe-3" scope="col">
                        @sortablelink('paid', 'MODE DE PAIEMENT')
                    </th>
                    <th class="sort align-middle text-end" scope="col">
                        @sortablelink('total_ttc', 'TOTAL H.T')
                    </th>
                    <th class="sort align-middle text-end" scope="col">
                        @sortablelink('total_ttc', 'TOTAL TTC')
                    </th>
                    <th></th>

                </tr>
                </thead>
                <tbody class="list" id="order-table-body">
                    @foreach($invoices as $invoice)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="fs-9 align-middle px-0 py-3">
                                <div class="form-check mb-0 fs-8">
                                    <input class="form-check-input" type="checkbox" />
                                </div>
                            </td>
                            <td class="order align-middle py-0 fs-8">
                                <a class="fw-bold" href="{{route('invoice.show', $invoice->id)}}">F{{$invoice->invoice_num}}</a>
                            </td>
                            <td class="customer align-middle white-space-nowrap">
                                <span class="fw-bold">{{$invoice->issue_date}}</span>
                            </td>
                            <td class="fulfilment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                                <a class="d-flex align-items-center text-body" href="{{route('client.show', $invoice->client)}}">
                                    <div class="avatar avatar-m">
                                        <div class="avatar-name rounded-circle">
                                            <span>{{substr($invoice->client->company, 0, 1)}}</span>
                                        </div>
                                    </div>
                                    <h6 class="mb-0 ms-3 text-body">{{$invoice->client->company}}</h6>
                                </a>
                            </td>
                            <td class="payment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                                @if($invoice->paid)
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                        <span class="badge-label">Payée</span>
                                        <span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span>
                                    </span>
                                @else
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-danger">
                                        <span class="badge-label">Non payé</span>
                                        <span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span>
                                    </span>
                                @endif
                            </td>
                            <td class="payment_mode align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                                @if($invoice->payment_method)
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-secondary">
                                        <span class="badge-label">{{ $invoice->payment_method }}</span>
                                    </span>
                                @endif
                            </td>
                            <td class="total align-middle text-end fw-semibold text-body-highlight">
                                {{number_format($invoice->total_ht, 2, ',', ' ')}}€
                            </td>
                            <td class="total align-middle text-end fw-semibold text-body-highlight">
                                {{number_format($invoice->total_ttc, 2, ',', ' ')}}€
                            </td>
                            <td class="align-middle text-end fw-bold">
                                <a href="#" class="btn btn-link"><i class="fa fa fa-file-pdf"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
                {{-- <div class="col-auto d-flex">
                    <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
                    <a class="fw-semibold" href="{{ request()->fullUrlWithQuery(['show_all' => 1]) }}" data-list-view="*">Voir tous<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                    <a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                </div>
                <div class="col-auto d-flex">
                    @if(!request()->has('show_all') && $invoices->hasPages())
                        @if ($invoices->onFirstPage())
                            <a href="{{ $invoices->nextPageUrl() }}" class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></a>
                        @else
                            <a href="{{ $invoices->previousPageUrl() }}" class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></a>
                            <ul class="mb-0 pagination"></ul>
                            @if(!$invoices->onLastPage())
                                <a href="{{ $invoices->nextPageUrl() }}" class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></a>
                            @endif
                        @endif
                    @endif
                </div> --}}
            </div>
        </div>
        </div>
    </div>

@endsection
