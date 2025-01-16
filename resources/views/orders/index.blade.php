@extends('layouts.app')

@section('content')


<div class="mb-9">
    <div class="row g-3 mb-4">
    <div class="col-auto">
        <h2 class="mb-0">Commandes</h2>
    </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Tous </span><span class="text-body-tertiary fw-semibold">({{$orders->count()}})</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#"><span>Pending payment </span><span class="text-body-tertiary fw-semibold">(0)</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#"><span>Unfulfilled </span><span class="text-body-tertiary fw-semibold">(0)</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#"><span>Completed</span><span class="text-body-tertiary fw-semibold">(0)</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#"><span>Refunded</span><span class="text-body-tertiary fw-semibold">(0)</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#"><span>Failed</span><span class="text-body-tertiary fw-semibold">(0)</span></a></li>
    </ul>
    <div id="orderTable" data-list='{"valueNames":["order","total","customer","payment_status","fulfilment_status","delivery_type","date"],"page":10,"pagination":true}'>
    <div class="mb-4">
        <div class="row g-3">
        <div class="col-auto">
            <div class="search-box">
            <form class="position-relative">
                <input class="form-control search-input search" type="search" placeholder="Recherche..." aria-label="Search" />
                <span class="fas fa-search search-box-icon"></span>

            </form>
            </div>
        </div>
        <div class="col-auto scrollbar overflow-hidden-y flex-grow-1">
            <div class="btn-group position-static" role="group">
            <div class="btn-group position-static text-nowrap" role="group">
                <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                Payment status<span class="fas fa-angle-down ms-2"></span></button>
                <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <div class="btn-group position-static text-nowrap" role="group">
                <button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                Fulfilment status<span class="fas fa-angle-down ms-2"></span></button>
                <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0">More filters </button>
            </div>
        </div>
        <div class="col-auto">
            <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button>
            <a href="{{route('order.create')}}" class="btn btn-primary"><span class="fas fa-plus me-2"></span>Nouvelle commande</a>
        </div>
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
                <th class="sort white-space-nowrap align-middle pe-3" scope="col" data-sort="order">COMMANDE</th>
                <th class="sort align-middle ps-8" scope="col" data-sort="customer">CLIENT</th>
                <th class="sort align-middle text-start pe-3" scope="col" data-sort="fulfilment_status">STATUT</th>
                <th class="sort align-middle pe-3" scope="col" data-sort="payment_status">PAIEMENT</th>
                <th class="sort align-middle text-start" scope="col" data-sort="delivery_type">LIVREE LE</th>
                <th class="sort align-middle text-end" scope="col" data-sort="total">TOTAL</th>
                <th class="sort align-middle text-end pe-0" scope="col" data-sort="date">DATE</th>
            </tr>
            </thead>
            <tbody class="list" id="order-table-body">
                @foreach($orders as $order)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                        <td class="fs-9 align-middle px-0 py-3">
                        <div class="form-check mb-0 fs-8">
                            <input class="form-check-input" type="checkbox" />
                        </div>
                        </td>
                        <td class="order align-middle white-space-nowrap py-0">
                            <a class="fw-semibold" href="{{route('order.show', $order)}}">#{{$order->id}}</a></td>
                        <td class="customer align-middle white-space-nowrap ps-8">
                            <a class="d-flex align-items-center text-body" href="{{route('client.show', $order->client)}}">
                                <div class="avatar avatar-m">
                                    <div class="avatar-name rounded-circle">
                                        <span>{{substr($order->client->company, 0, 1)}}</span>
                                    </div>
                                </div>
                                <h6 class="mb-0 ms-3 text-body">{{$order->client->company}}</h6>
                            </a>
                        </td>
                        <td class="fulfilment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                            <span class="badge badge-phoenix fs-10 badge-phoenix-primary">
                                <span class="badge-label">
                                    {!! App\Models\Order::getStatusLabel($order->status) !!}
                                </span>
                            </span>
                        </td>
                        <td class="payment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                            @if($order->paid)
                                <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                    <span class="badge-label">Payée</span>
                                    <span class="ms-1" data-feather="check" style="height:12.8px;width:12.8px;"></span>
                                </span>
                            @else
                                <span class="badge badge-phoenix fs-10 badge-phoenix-warning">
                                    <span class="badge-label">En attente</span>
                                    <span class="ms-1" data-feather="clock" style="height:12.8px;width:12.8px;"></span>
                                </span>
                            @endif
                        </td>
                        <td class="delivery_type align-middle white-space-nowrap text-body fs-9 text-start"></td>
                        <td class="total align-middle text-end fw-semibold text-body-highlight">{{number_format($order->total_ttc, 2, ',', ' ')}}€</td>
                        <td class="date align-middle white-space-nowrap text-body-tertiary fs-9 ps-4 text-end">{{$order->created_at->format('d/m/Y')}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
        <div class="col-auto d-flex">
            <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
            <a class="fw-semibold" href="#!" data-list-view="*">Voir tous<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
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
