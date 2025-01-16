@extends('layouts.app')

@section('content')
<div class="mb-9">
    <div class="row g-3 mb-4">
    <div class="col-auto">
        <h2 class="mb-0">Design</h2>
    </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#"><span>All </span><span class="text-body-tertiary fw-semibold">(68817)</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#"><span>Published </span><span class="text-body-tertiary fw-semibold">(70348)</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#"><span>Drafts </span><span class="text-body-tertiary fw-semibold">(17)</span></a></li>
    <li class="nav-item"><a class="nav-link" href="#"><span>On discount </span><span class="text-body-tertiary fw-semibold">(810)</span></a></li>
    </ul>
    <div id="products" data-list='{"valueNames":["product","price","category","tags","vendor","time"],"page":10,"pagination":true}'>
    <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
        <div class="search-box">
            <form class="position-relative">
            <input class="form-control search-input search" type="search" placeholder="Search products" aria-label="Search" />
            <span class="fas fa-search search-box-icon"></span>

            </form>
        </div>
        <div class="scrollbar overflow-hidden-y">
            <div class="btn-group position-static" role="group">
            <div class="btn-group position-static text-nowrap">
                <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                Category<span class="fas fa-angle-down ms-2"></span></button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <div class="btn-group position-static text-nowrap">
                <button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                Vendor<span class="fas fa-angle-down ms-2"></span></button>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="#">Separated link</a></li>
                </ul>
            </div>
            <button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0">More filters</button>
            </div>
        </div>
        <div class="ms-xxl-auto">
            <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button>
            <button class="btn btn-primary" id="addBtn"><span class="fas fa-plus me-2"></span>Add product</button>
        </div>
        </div>
    </div>
    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
        <div class="table-responsive scrollbar mx-n1 px-1">
        <table class="table fs-9 mb-0">
            <thead>
            <tr>
                <th class="white-space-nowrap fs-9 align-middle ps-0" style="max-width:20px; width:18px;">
                <div class="form-check mb-0 fs-8">
                    <input class="form-check-input" id="checkbox-bulk-products-select" type="checkbox" data-bulk-select='{"body":"products-table-body"}' />
                </div>
                </th>
                <th class="sort white-space-nowrap align-middle fs-10" scope="col" style="width:70px;"></th>
                <th class="sort align-middle text-end ps-4" scope="col" data-sort="price" style="width:150px;">REFERENCE</th>
                <th class="sort white-space-nowrap align-middle ps-4" scope="col">PRODUCT NAME</th>
                <th class="sort align-middle ps-4" scope="col">COULEUR</th>
                <th class="sort align-middle ps-4" scope="col">CREE LE</th>
                <th class="sort text-end align-middle pe-0 ps-4" scope="col"></th>
            </tr>
            </thead>
            <tbody class="list" id="products-table-body">
                @foreach($designs as $design)
                <tr class="position-static">
                    <td class="fs-9 align-middle">
                        <div class="form-check mb-0 fs-8">
                            <input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Fitbit Sense Advanced Smartwatch with Tools for Heart Health, Stress Management & Skin Temperature Trends, Carbon/Graphite, One Size (S & L Bands...","productImage":"/products/1.png","price":"$39","category":"Plants","tags":["Health","Exercise","Discipline","Lifestyle","Fitness"],"star":false,"vendor":"Blue Olive Plant sellers. Inc","publishedOn":"Nov 12, 10:45 PM"}' />
                        </div>
                    </td>
                    <td class="align-middle white-space-nowrap py-0">
                        <a class="d-block border border-translucent rounded-2" href="{{route('design.show', $design)}}">
                            <img src="{{asset('images/designs').'/'.$design->image}}" alt="" width="53" />
                        </a>
                    </td>
                    <td class="price align-middle white-space-nowrap text-end fw-bold text-body-tertiary ps-4">
                        <span class="fw-bold">{{$design->reference}}</span>
                    </td>
                    <td class="product align-middle ps-4">
                        <a class="fw-semibold line-clamp-3 mb-0" href="{{route('design.show', $design)}}">
                            {{$design->name}}
                       </a>
                    </td>
                    
                    <td class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                        @if($design->color)
                            {{$design->color->name}}
                        @endif
                    </td>
                    <td class="time align-middle white-space-nowrap text-body-tertiary text-opacity-85 ps-4">
                        {{$design->created_at->format('d/m/Y')}}
                    </td>
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger">
                    <div class="btn-reveal-trigger position-static">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                            <a class="dropdown-item" href="{{route('design.show', $design)}}">Voir</a>
                            <a class="dropdown-item" href="{{route('design.edit', $design)}}">Modifier</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Supprimer</a>
                        </div>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="row align-items-center justify-content-between py-2 pe-0 fs-9">
        <div class="col-auto d-flex">
            <p class="mb-0 d-none d-sm-block me-3 fw-semibold text-body" data-list-info="data-list-info"></p><a class="fw-semibold" href="#!" data-list-view="*">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semibold d-none" href="#!" data-list-view="less">View Less<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
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
