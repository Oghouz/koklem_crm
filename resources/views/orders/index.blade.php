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
    </ul>
    <div id="orderTable" data-list='{"valueNames":["order","total","customer","payment_status","fulfilment_status","delivery_type","date"],"page":10,"pagination":true}'>
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
                <div class="btn-group position-static" role="group">
                    <div class="btn-group position-static text-nowrap" role="group">
                        <button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown"
                            data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                            Statut Commande<span class="fas fa-angle-down ms-2"></span></button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @foreach (App\Models\Order::getStatusLabel() as $i => $orderStatus)
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['order_status' => $i])}}">{{$orderStatus}}</a></li>
                            @endforeach
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['order_status' => ''])}}">Tous</a></li>
                        </ul>
                    </div>
                    <div class="btn-group position-static text-nowrap" role="group">
                        <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                            Statut Paiement<span class="fas fa-angle-down ms-2"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['order_paid' => 1])}}">Payée</a></li>
                            <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['order_paid' => 0])}}">Non Payée</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['order_paid' => ''])}}">Tous</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-auto">
                {{-- <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button> --}}
                <a href="{{route('order.create')}}" class="btn btn-outline-primary"><span class="fas fa-plus me-2"></span>Nouvelle commande</a>
                <button class="btn btn-outline-success" onclick="generateInvoice()">
                    <span class="fas fa-file-invoice"></span> Générer le(s) facture(s)
                </button>
            </div>
        </div>
    </div>
    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
        <div class="table-responsive scrollbar mx-n1 px-1">
        <table class="table table-sm fs-9 mb-0">
            <thead>
            <tr>
                <th class="white-space-nowrap fs-9 align-middle ps-0 ps-2">
                    <div class="form-check mb-0 fs-8">
                        <input class="form-check-input" id="checkbox-all-order-select" type="checkbox"  />
                    </div>
                </th>
                <th class="sort white-space-nowrap align-middle pe-3" scope="col" data-sort="order">
                    @sortablelink('id', 'N°')
                </th>
                <th class="sort align-middle ps-8" scope="col" data-sort="customer">
                    @sortablelink('client_id', 'CLIENT')
                </th>
                <th class="sort align-middle pe-0" scope="col" data-sort="date">
                    @sortablelink('created_at', 'DATE')
                </th>
                <th class="sort align-middle text-start pe-3" scope="col" data-sort="fulfilment_status">
                    @sortablelink('status', 'STATUT')
                </th>
                <th class="sort align-middle pe-3" scope="col" data-sort="payment_status">
                    @sortablelink('paid', 'PAIEMENT')
                </th>
                <th class="sort align-middle text-center" scope="col" data-sort="delivery_type">
                    @sortablelink('invoice_id', 'FACTURÉE')
                </th>
                <th class="sort align-middle text-end" scope="col" data-sort="total">
                    @sortablelink('total_ttc', 'TOTAL')
                </th>
            </tr>
            </thead>
            <tbody class="list" id="order-table-body">
                @foreach($orders as $order)
                    <tr class="hover-actions-trigger btn-reveal-trigger position-static" id="line-{{$order->id}}">
                        <td class="fs-9 align-middle px-0 py-3 ps-2">
                            <div class="form-check mb-0 fs-8">
                                @if($order->invoice_id)
                                    <i class="form-check-input fa fa-check text-success"></i>
                                @else
                                    <input class="form-check-input line-checkbox" 
                                    type="checkbox" 
                                    value="{{$order->id}}"  
                                    onchange="selectLine(this, '{{$order->id}}')" />
                                @endif
                            </div>
                        </td>
                        <td class="order align-middle white-space-nowrap py-0">
                            <a class="fw-semibold" href="{{route('order.show', $order)}}">#{{$order->id}}</a>
                        </td>
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
                        <td class="date align-middle white-space-nowrap text-body-tertiary fs-9 fw-bold">
                            {{$order->created_at->format('d/m/Y')}}
                        </td>
                        <td class="fulfilment_status align-middle white-space-nowrap text-start fw-bold text-body-tertiary">
                            {!! App\Models\Order::getStatusBadge($order->status) !!}
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
                        <td class="delivery_type align-middle white-space-nowrap text-body fs-9 text-center">
                            @if($order->invoice_id)
                                <i class="fa fa-check-circle text-success"></i>
                            @endif
                        </td>
                        <td class="total align-middle text-end fw-semibold text-body-highlight">{{number_format($order->total_ttc, 2, ',', ' ')}}€</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
        <div class="col-auto d-flex">
            <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p>
            <a class="fw-semibold" href="{{ request()->fullUrlWithQuery(['show_all' => 1]) }}" data-list-view="*">Voir tous<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
            <a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
        </div>
        <div class="col-auto d-flex">
            @if(!request()->has('show_all') && $orders->hasPages())
                @if ($orders->onFirstPage())
                    <a href="{{ $orders->nextPageUrl() }}" class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></a>
                @else
                    <a href="{{ $orders->previousPageUrl() }}" class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></a>
                    <ul class="mb-0 pagination"></ul>
                    @if(!$orders->onLastPage())
                        <a href="{{ $orders->nextPageUrl() }}" class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></a>
                    @endif
                @endif
            @endif
        </div>
        </div>
    </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.8/axios.min.js"
    integrity="sha512-v8+bPcpk4Sj7CKB11+gK/FnsbgQ15jTwZamnBf/xDmiQDcgOIYufBo6Acu1y30vrk8gg5su4x0CG3zfPaq5Fcg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

    $('#checkbox-all-order-select').on('click', ()=> {
        console.log('TEST')
    });

function selectLine(elem, line_id)
{
    let isChecked = $(elem).is(':checked');
    if(isChecked) {
        $('#line-'+line_id).addClass("bg-primary-subtle")
    } else {
        $('#line-' + line_id).removeClass("bg-primary-subtle")
    }
}

function generateInvoice()
{
    let url = 'invoice/multipleInvoiceStore';
    let checkboxs = $('.line-checkbox');
    let selectedOders = [];

    checkboxs.each((i,item) => {
        let isChecked = $(item).is(':checked');
        if(isChecked) {
            selectedOders.push($(item).val())
        }
    })

    if(!selectedOders.length) {
        Swal.fire({
            title: "Aucune commande n'a été sélectionnée!",
            icon: "warning",
            draggable: true
        });
        return;
    }

    let orders = selectedOders.join(', ')
    Swal.fire({
        icon: "info",
        title: "Confirmation",
        html: `
            <p>Commandes sélectionnée: <b>`+selectedOders.length+`</b></p>
            `+orders+`
        `,
        showCancelButton: true,
        confirmButtonText: "Confirmer",
        cancelButtonText: "Annuler",
    }).then((result) => {
        if (result.isConfirmed) {
            
            Swal.fire({
                title: 'Création de la facture en cours...',
                text: 'Veuillez patienter, la facture est en train de se générer.',
                icon: 'info',
                allowOutsideClick: false,  // Empêche de fermer la fenêtre pendant le chargement
                showConfirmButton: false,  // Cache le bouton de confirmation
                didOpen: () => {
                    Swal.showLoading();  // Affiche le spinner de chargement
                }
            });
            
            // Requête AJAX avec axios
            let url = "{{route('invoice.sotre.multiple')}}"
            axios.post(url, {
                orderIds: selectedOders,  // L'ID de la commande provenant de Blade
                _token: '{{ csrf_token() }}'  // Ajout du token CSRF pour sécuriser la requête
            }).then((response) => {
                // Vérification du retour serveur
                console.log(response)
                if (response.data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Facture générée avec succès',
                        text: 'La facture a été créée avec succès.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Optionnel : Redirection vers la page des factures après la création
                        window.location.reload(); // Modifiez cette URL selon votre besoin
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors de la création de la facture.',
                        confirmButtonText: 'Essayer à nouveau'
                    });
                }
            }).catch((error) => {
                // Gestion des erreurs réseau ou autres
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur de communication',
                    text: error.response.data.error,
                    confirmButtonText: 'Réessayer'
                });
                console.error('Erreur :', error.response.data.error);  // Log de l'erreur pour débogage
            });
        }
    });
    console.log(selectedOders);
}

</script>
@endsection
