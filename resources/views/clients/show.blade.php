@extends('layouts.app')
@section('content')
    <div class="mb-9">
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col-auto">
                <a href="{{route('client.index')}}" class="btn btn-subtle-secondary me-1 mb-1" type="button">
                    <i class="fa-solid fa-arrow-left"></i> Retour
                </a>
            </div>
            <div class="col-auto">
                <div class="row g-3">
                    <div class="col-auto">
                        <a href="{{route('client.edit', $client)}}" class="btn btn-phoenix-primary"><span class="fas fa-edit me-2"></span>Modifier</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-5">
        <div class="col-12 col-xxl-4">
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
                            <a href="https://maps.google.fr/maps?q={{$client->address1 . ' ' . $client->zip_code . ' ' . $client->city}}" target="_blank">
                                {{$client->address1}}<br />{{$client->zip_code}}, {{$client->city}}<br />
                            </a>
                        </p>
                        <h5 class="text-body-secondary">Email: </h5><a href="mailto:{{$client->email}}">{{$client->email}}</a>
                        <h5 class="text-body-secondary">Téléphone: </h5><a class="text-body-secondary" href="#">{{$client->phone1}}</a>
                        <h5 class="text-body-secondary mt-3">SIRET:</h5><a class="text-body-secondary" href="#">{{$client->siret}}</a>
                        <h5 class="text-body-secondary">N° TVA:</h5><a class="text-body-secondary" href="#">{{$client->tva_number}}</a>
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
        <div class="col-12 col-xxl-8">
            <div class="mb-6">
            <h3 class="mb-4">Commandes <span class="text-body-tertiary fw-normal">({{$client->orders->count()}})</span></h3>
            <div class="border-top border-bottom border-translucent" id="customerOrdersTable" data-list='{"valueNames":["order","total","payment_status","fulfilment_status","delivery_type","date"],"page":6,"pagination":true}'>
                <div class="table-responsive scrollbar">
                <table class="table table-sm fs-9 mb-0">
                    <thead>
                    <tr>
                        <th class="sort white-space-nowrap align-middle ps-0 pe-3" scope="col" data-sort="order">ORDER</th>
                        <th class="sort align-middle white-space-nowrap pe-3" scope="col" data-sort="payment_status">STATUT PAYMENT</th>
                        <th class="sort align-middle white-space-nowrap text-start pe-3" scope="col" data-sort="fulfilment_status">STATUS COMMANDE</th>
                        <th class="sort align-middle text-end pe-3" scope="col" data-sort="total">TOTAL</th>
                        <th class="sort align-middle text-end pe-0" scope="col" data-sort="date">DATE</th>
                    </tr>
                    </thead>
                    <tbody class="list" id="customer-order-table-body">
                    @foreach ($client->orders()->orderBy('id', 'DESC')->get() as $order)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="order align-middle white-space-nowrap ps-0"><a class="fw-semibold" href="{{route('order.show', $order)}}">#{{$order->id}}</a></td>
                            <td class="payment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                                @if($order->paid)
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                        <span class="badge-label">Payée</span>
                                        <span class="ms-1" data-feather="check" style="height:12.8px;"></span>
                                    </span>
                                @else
                                    <span class="badge badge-phoenix fs-10 badge-phoenix-warning">
                                        <span class="badge-label">En attente</span>
                                        <span class="ms-1" data-feather="clock" style="height:12.8px;"></span>
                                    </span>
                                @endif
                            </td>
                            <td class="fulfilment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                                <span class="badge badge-phoenix fs-10 badge-phoenix-info">
                                    <span class="badge-label">{!! App\Models\Order::getStatusLabel($order->status) !!}</span>
                                </span>
                            </td>
                            <td class="total align-middle text-end fw-semibold pe-3 text-body-highlight">
                                {{number_format($order->total_ttc, 2, ',', ' ')}} €
                            </td>
                            <td class="date align-middle white-space-nowrap text-body-tertiary fs-9 ps-4 text-end">
                                {{$order->created_at->format('d/m/Y')}}
                            </td>
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
        </div>
    </div>
@endsection