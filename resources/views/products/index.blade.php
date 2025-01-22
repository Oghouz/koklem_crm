@extends('layouts.app')

@section('content')
<div class="mb-9">
    <div class="row g-3 mb-4">
    <div class="col-auto">
        <h2 class="mb-0">Produits</h2>
    </div>
    </div>
    <ul class="nav nav-links mb-3 mb-lg-2 mx-n3">
    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{route('product.index')}}"><span>Tous </span><span class="text-body-tertiary fw-semibold">({{$products->count()}})</span></a></li>
    </ul>
    <div id="products" data-list='{"valueNames":["product","price","category","tags","vendor","time"],"page":10,"pagination":true}'>
    <div class="mb-4">
        <div class="d-flex flex-wrap gap-3">
        <div class="search-box">
            <form class="position-relative">
                <input class="form-control search-input search" name="search" type="search" value="{{request('search')}}" placeholder="Recherche..." aria-label="Search" />
                <span class="fas fa-search search-box-icon"></span>
            </form>
        </div>
        <div class="scrollbar overflow-hidden-y">
            <div class="btn-group position-static" role="group">
            <div class="btn-group position-static text-nowrap">
                <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                    @if(request('category'))
                        <i class="fa fa-check"></i> {{$categories->find(request('category'))->name}}
                    @else
                        Catégorie<span class="fas fa-angle-down ms-2"></span>
                    @endif
                </button>
                <ul class="dropdown-menu">
                    @foreach ($categories as $category)
                        <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['category' => $category->id])}}">
                            @if(request('category') == $category->id) <i class="fa fa-check"></i> @endif{{$category->name}}</a>
                        </li>
                    @endforeach
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['category' => ''])}}">Tous</a></li>
                </ul>
            </div>
            <div class="btn-group position-static text-nowrap">
                <button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                    @if(request('size'))
                        <i class="fa fa-check"></i> {{$sizes[array_search(request('size'), $sizes)]}}
                    @else
                        Taille<span class="fas fa-angle-down ms-2"></span>
                    @endif
                </button>
                <ul class="dropdown-menu">
                    @foreach ($sizes as $size)
                        <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['size' => $size])}}">{{$size}}</a></li>
                    @endforeach
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['size' => ''])}}">Tous</a></li>
                </ul>
            </div>
            <div class="btn-group position-static text-nowrap">
                <button class="btn btn-sm btn-phoenix-secondary px-7 flex-shrink-0" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                    @if(request('color'))
                        <i class="fa fa-check"></i> {{$colors[request('color')]}}
                    @else
                        Couleur<span class="fas fa-angle-down ms-2"></span>
                    @endif
                </button>
                <ul class="dropdown-menu">
                    @foreach ($colors as $i_color => $color)
                        <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['color' => $i_color])}}">{{$color}}</a></li>
                    @endforeach
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="{{request()->fullUrlWithQuery(['color' => ''])}}">Tous</a></li>
                </ul>
            </div>
            </div>
        </div>
        <div class="ms-xxl-auto">
            <button class="btn btn-link text-body me-4 px-0"><span class="fa-solid fa-file-export fs-9 me-2"></span>Export</button>
            <a href="{{route('product.create')}}" class="btn btn-primary" id="addBtn"><span class="fas fa-plus me-2"></span>Nouveau Produit</a>
        </div>
        </div>
    </div>
    <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
        <div class="table-responsive scrollbar mx-n1 px-1">
        <table class="table fs-9 mb-0">
            <thead>
            <tr>
                <th class="white-space-nowrap fs-9 align-middle ps-0">
                <div class="form-check mb-0 fs-8">
                    <input class="form-check-input" id="checkbox-bulk-products-select" type="checkbox" data-bulk-select='{"body":"products-table-body"}' />
                </div>
                </th>
                <th class="sort white-space-nowrap align-middle fs-10" scope="col"></th>
                <th class="sort white-space-nowrap align-middle" scope="col">
                    @sortablelink('reference', 'REFERENCE')
                </th>
                <th class="sort white-space-nowrap align-middle ps-4" scope="col">
                    @sortablelink('name', 'NOM')
                </th>
                <th class="sort align-middle ps-4" scope="col">
                    @sortablelink('size', 'TAILLE')
                </th>
                <th class="sort align-middle ps-3" scope="col">
                    @sortablelink('color_id', 'COULEUR')
                </th>
                <th class="sort align-middle text-center ps-4" scope="col">
                    @sortablelink('stock', 'STOCK')
                </th>
                <th class="sort align-middle ps-4" scope="col">
                    @sortablelink('created_at', 'CREER LE')
                </th>
                <th class="sort text-end align-middle pe-0 ps-4" scope="col"></th>
            </tr>
            </thead>
            <tbody class="list" id="products-table-body">
                @foreach ($products as $product)
                <tr class="position-static">
                    <td class="fs-9 align-middle">
                        <div class="form-check mb-0 fs-8">
                            <input class="form-check-input" type="checkbox" data-bulk-select-row='{"product":"Fitbit Sense Advanced Smartwatch with Tools for Heart Health, Stress Management & Skin Temperature Trends, Carbon/Graphite, One Size (S & L Bands...","productImage":"/products/1.png","price":"$39","category":"Plants","tags":["Health","Exercise","Discipline","Lifestyle","Fitness"],"star":false,"vendor":"Blue Olive Plant sellers. Inc","publishedOn":"Nov 12, 10:45 PM"}' />
                        </div>
                    </td>
                    <td class="align-middle white-space-nowrap py-0">
                        <a class="d-block border border-translucent rounded-2" href="{{route('product.show', $product)}}">
                            <img src="{{asset('images/products') . '/' . $product->image}}" alt="" width="53" />
                        </a>
                    </td>
                    <td class="align-middle white-space-nowrap py-0">
                        <span class="fw-bold">{{$product->reference}}</span>
                    </td>
                    <td class="product align-middle ps-4">
                        <a class="fw-semibold line-clamp-3 mb-0" href="{{route('product.show', $product)}}">
                            <span>{{ $product->name }}</span>
                        </a>
                    </td>
                    <td class="category align-middle white-space-nowrap text-body-quaternary fs-9 ps-4 fw-semibold">
                        <span class="badge text-bg-secondary">{{$product->size}}</span>
                    </td>
                    <td class="tags align-middle review pb-2 ps-3" style="min-width:225px;">
                        @if($product->color)
                        <i class="fas fa-border fa-tshirt" style="color:{{$product->color->code}}"></i>
                        {{$product->color->name}}
                        @endif
                    </td>
                    <td class="align-middle review fs-8 text-center ps-4">
                        <span class="badge badge-phoenix badge-phoenix-secondary">{{$product->stock}}</span>
                    </td>
                    <td class="time align-middle white-space-nowrap text-body-tertiary text-opacity-85 ps-4">
                        {{$product->created_at}}
                    </td>
                    <td class="align-middle white-space-nowrap text-end pe-0 ps-4 btn-reveal-trigger">
                    <div class="btn-reveal-trigger position-static">
                        <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10" type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-ellipsis-h fs-10"></span></button>
                        <div class="dropdown-menu dropdown-menu-end py-2">
                            <a class="dropdown-item" href="#!">Voir</a>
                            <a class="dropdown-item" href="#!">Modifier</a>
                        <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="#!">Supprimer</a>
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
