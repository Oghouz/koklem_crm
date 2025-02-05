@extends('layouts.app')
@section('content')

<div class="container-small">
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{route('invoice.index')}}">Retour</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between align-items-end mb-4">
        <h2 class="mb-0">FACTURE N°{{$invoice->invoice_num}}</h2>
        <div>
            <div class="dropdown">
                <a class="btn btn-phoenix-secondary me-2 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg class="svg-inline--fa fa-download me-sm-2" aria-hidden="true" focusable="false" data-prefix="fas"
                        data-icon="download" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                        <path fill="currentColor"
                            d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z">
                        </path>
                    </svg><!-- <span class="fa-solid fa-download me-sm-2"></span> Font Awesome fontawesome.com --><span
                        class="d-none d-sm-inline-block">Télécharger Facture</span>
                </a>
            
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{route('invoice.pdf.download', $invoice->id)}}" target="_blank">Ligne détaillée</a></li>
                    <li><a class="dropdown-item" href="{{route('invoice.pdf.download', ['key'=>$invoice->id,'type'=>'grouped'])}}" target="_blank">Ligne grouppée</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="bg-body dark__bg-gray-1100 p-4 mb-4 rounded-2">
        <div class="row g-4">
            <div class="col-12 col-lg-5">
                <div class="row g-4 g-lg-2">
                    <table class="table table-borderless fs-9">
                        <tr>
                            <td class="p-0">N° de Fracture</td>
                            <td class="p-0">{{$invoice->invoice_num}}</td>
                        </tr>
                        <tr>
                            <td class="p-0">Date facture</td>
                            <td class="p-0">{{$invoice->issue_date}}</td>
                        </tr>
                        <tr>
                            <td class="p-0">Date d'échéance :</td>
                            <td class="p-0">{{$invoice->due_date}}</td>
                        </tr>
                        <tr>
                            <td class="p-0">N° Commande :</td>
                            <td class="p-0">
                                <a href="{{route('order.show', $invoice->order_id)}}" class="fs-9 fw-bold mb-0">{{$invoice->order_id}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-0">Date de Commande :</td>
                            <td class="p-0"> {{$invoice->order->created_at}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-7">
                <div class="row g-4">
                    <div class="col-12 col-lg-6">
                        <h6 class="mb-2"> Adresse de facturation :</h6>
                        <div class="fs-9 text-body-secondary fw-semibold mb-0">
                            <p class="mb-2 fw-bold">{{$invoice->client_company}}</p>
                            <p class="mb-0">{{$invoice->client_address1}}</p>
                            <p class="mb-2">{{$invoice->client_zip_code . ', ' . $invoice->client_city}}</p>
                            @if($invoice->client_phone)<p class="mb-0">{{$invoice->client_phone}}</p>@endif
                            @if($invoice->client_email)<p class="mb-0">{{$invoice->client_email}}</p>@endif
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <h6 class="mb-2"> Adresse de livraison :</h6>
                        <div class="fs-9 text-body-secondary fw-semibold mb-0">
                            <p class="mb-2 fw-bold">{{$invoice->client_company}}</p>
                            <p class="mb-0">{{$invoice->client_address1}}</p>
                            <p class="mb-2">{{$invoice->client_zip_code . ', ' . $invoice->client_city}}</p>
                            @if($invoice->client_phone)
                            <p class="mb-0">{{$invoice->client_phone}}</p>@endif
                            @if($invoice->client_email)
                            <p class="mb-0">{{$invoice->client_email}}</p>@endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-0 mb-3">
        <div class="table-responsive scrollbar">
            <table class="table fs-9 text-body mb-0">
                <thead class="bg-body-secondary">
                    <tr>
                        <th scope="col">Réf.</th>
                        <th scope="col">Désignation</th>
                        <th class="ps-5" scope="col">Couleur</th>
                        <th scope="col">Taille</th>
                        <th class="text-center" scope="col">Quantité</th>
                        <th class="text-end" scope="col">P.U (HT)</th>
                        <th class="text-end" scope="col">TVA</th>
                        <th class="text-end pe-2" scope="col">Total H.T</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->lines as $index => $line)
                        <tr>
                            <td class="align-middle ps-2 fw-bold">{{$line->product_reference}}</td>
                            <td class="align-middle">{{$line->product_name}}</td>
                            <td class="align-middle ps-5">{{$line->product_color}}</td>
                            <td class="align-middle fw-semibold">{{$line->product_size}}</td>
                            <td class="align-middle text-center fw-bold">{{$line->quantity}}</td>
                            <td class="align-middle text-end fw-semibold">{{number_format($line->product_price, 2, ',')}}€</td>
                            <td class="align-middle text-end">{{number_format($line->product_tva, 2, ',')}}%</td>
                            <td class="align-middle text-end fw-semibold pe-2">{{number_format(($line->product_price * $line->quantity), 2, ',')}}€</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td class="align-middle fw-semibold text-end" colspan="6">Total H.T</td>
                        <td class="align-middle text-end fw-bold">{{number_format($invoice->total_ht, 2, ',')}}€</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="align-middle fw-semibold text-end" colspan="6">Total TVA</td>
                        <td class="align-middle text-end fw-bold">{{number_format($invoice->total_tva, 2, ',')}}€</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="align-middle fw-semibold text-end" colspan="6">Total T.T.C</td>
                        <td class="align-middle text-end fw-bold">{{number_format($invoice->total_ttc, 2, ',')}}€</td>
                        <td></td>
                    </tr>
                    <tr class="bg-body-secondary fw-bold fs-8">
                        <td></td>
                        <td class="align-middle text-end" colspan="6">NET À PAYER</td>
                        <td class="align-middle text-end">{{number_format($invoice->total_ttc, 2, ',')}}€</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection