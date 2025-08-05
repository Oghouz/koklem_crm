@extends('layouts.app')

@section('content')
    <div class="mb-9">
        <div class="d-flex mb-5" id="scrollspyStats">
            <div class="col">
                <h3 class="mb-0 text-primary position-relative fw-bold">
                    <span class="bg-body pe-2">Commandes</span>
                    <span class="border border-primary position-absolute top-50 translate-middle-y w-100 start-0 z-n1"></span>
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="px-3 mb-5">
                <div class="row justify-content-between">
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end border-bottom pb-4 pb-xxl-0 ">
                        <span class="uil fs-5 lh-1 uil-file text-primary"></span>
                        <h1 class="fs-5 pt-3">{{$orders->count()}}</h1>
                        <p class="fs-9 mb-0">Total Commande</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-bottom-xxl-0 border-bottom border-end border-end-md-0 pb-4 pb-xxl-0 pt-4 pt-md-0">
                        <span class="uil fs-5 lh-1 uil-user text-warning"></span>
                        <h1 class="fs-5 pt-3">{{$total['product']}}</h1>
                        <p class="fs-9 mb-0">T-shirt</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-xxl-0 border-bottom-xxl-0 border-end-md border-bottom pb-4 pb-xxl-0">
                        <span class="uil fs-5 lh-1 uil-euro text-success"></span>
                        <h1 class="fs-5 pt-3">{{number_format($orders->sum('total_ht'), 2, ',', ' ')}}€</h1>
                        <p class="fs-9 mb-0">Montant Total H.T</p>
                    </div>
                    <div
                        class="col-6 col-md-4 col-xxl-2 text-center border-translucent border-start-xxl border-end-md border-end-xxl-0 border-bottom border-bottom-md-0 pb-4 pb-xxl-0 pt-4 pt-xxl-0">
                        <span class="uil fs-5 lh-1 uil-euro text-danger"></span>
                        <h1 class="fs-5 pt-3">{{ number_format($orders->where('paid', 0)->sum('total_ht'), 2, ',', ' ') }}€</h1>
                        <p class="fs-9 mb-0">En retard</p>
                    </div>
                </div>
            </div>
        </div>
        {{-- <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>Tous </span><span class="text-body-tertiary fw-semibold">({{$orders->count()}})</span></a></li>
        </ul> --}}
        <div id="orderTable" data-list='{"valueNames":["order","total","customer","payment_status","fulfilment_status","delivery_type","date"],"page":10,"pagination":true}'>
        <div class="mb-1">
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
                                Statut <span class="fas fa-angle-down ms-2"></span></button>
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
                                Facturer<span class="fas fa-angle-down ms-2"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['billed' => 1])}}">Facturée</a></li>
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['billed' => 0])}}">Non facturée</a></li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['billed' => ''])}}">Tous</a></li>
                            </ul>
                        </div>
                        <div class="btn-group position-static text-nowrap" role="group">
                            <form action="" class="d-flex" method="GET">
                                <input type="date" class="form-control form-control-sm" name="date_debut" placeholder="Date de début" value="{{Request::get('date_debut')}}" />
                                <span> à </span>
                                <input type="date" class="form-control form-control-sm" name="date_fin"  placeholder="Date de fin" value="{{Request::get('date_fin')}}" />
                                <button class="btn btn-sm btn-phoenix-primary "><i class="fa fa-search"></i></button>
                            </form>

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
                                    <input class="form-check-input line-checkbox" 
                                    type="checkbox" 
                                    value="{{$order->id}}"  
                                    onchange="selectLine(this, '{{$order->id}}')" />
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
                            <td class="delivery_type align-middle white-space-nowrap text-body fs-9 text-center">
                                @if($order->invoices->isNotEmpty())
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
