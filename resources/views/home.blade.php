@extends('layouts.app')

@section('content')
<div class="pb-5">
    <div class="row g-4">
        <div class="col-12 col-xxl-6">
            <div class="mb-8">
            <h2 class="mb-2">Dashboard</h2>
            <h5 class="text-body-tertiary fw-semibold">Voici ce qui se passe actuellement dans votre entreprise</h5>
            </div>
            <div class="row align-items-center g-4">
            <div class="col-12 col-md-auto">
                <div class="d-flex align-items-center"><span class="fa-stack" style="min-height: 46px;min-width: 46px;"><span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-success-light" data-fa-transform="down-4 rotate--10 left-4"></span><span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-success" data-fa-transform="up-4 right-3 grow-2"></span><span class="fa-stack-1x fa-solid fa-star text-success " data-fa-transform="shrink-2 up-8 right-6"></span></span>
                <div class="ms-3">
                    <a href="{{route('order.index')}}">
                        <h4 class="mb-0">{{$orders->count()}}</h4>
                        <p class="text-body-secondary fs-9 mb-0">Commandes</p>
                    </a>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-auto">
                <div class="d-flex align-items-center">
                    <span class="fa-stack" style="min-height: 46px;min-width: 46px;">
                        <span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-warning-light" data-fa-transform="down-4 rotate--10 left-4"></span>
                        <span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-warning" data-fa-transform="up-4 right-3 grow-2"></span>
                        <span class="fa-stack-1x fa-solid fa-user text-warning " data-fa-transform="shrink-2 up-8 right-6"></span>
                    </span>
                <div class="ms-3">
                    <a href="{{route('client.index')}}">
                        <h4 class="mb-0">{{$clients->count()}}</h4>
                        <p class="text-body-secondary fs-9 mb-0">Clients</p>
                    </a>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-auto">
                <div class="d-flex align-items-center">
                    <span class="fa-stack" style="min-height: 46px;min-width: 46px;">
                        <span class="fa-solid fa-square fa-stack-2x dark__text-opacity-50 text-danger-light" data-fa-transform="down-4 rotate--10 left-4"></span>
                        <span class="fa-solid fa-circle fa-stack-2x stack-circle text-stats-circle-danger" data-fa-transform="up-4 right-3 grow-2"></span>
                        <span class="fa-stack-1x fa-solid fa-shirt text-danger " data-fa-transform="shrink-2 up-8 right-6"></span>
                    </span>
                    <div class="ms-3">
                        <a href="{{route('product.index')}}">
                            <h4 class="mb-0">{{ $products->sum('stock')}}</h4>
                            <p class="text-body-secondary fs-9 mb-0">Produits en Stock</p>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            <hr class="bg-body-secondary mb-6 mt-4" />
            <div class="row flex-between-center mb-4 g-3">
                <div class="col-auto">
                    <h3>Ventes de l'année</h3>
                    <p class="text-body-tertiary lh-sm mb-0">Statistique de ventes de l'année</p>
                </div>
                <div class="col-8 col-sm-4">
                    <select class="form-select form-select-sm" id="select-gross-revenue-year">
                        <option>Année 2025</option>
                        <option>Année 2024</option>
                    </select>
                </div>
            </div>
            <div id="sales-chart-year" style="min-height:320px;width:100%"></div>
        </div>
        <div class="col-12 col-xxl-6">
            <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="mb-1">Montant Total
                            <span class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2"></span>
                        </h5>
                        <h6 class="text-body-tertiary"></h6>
                    </div>
                    <h4>{{number_format($orders->sum('total_ttc', 2, ',', ' '))}}€</h4>
                    </div>
                    <div class="d-flex justify-content-center px-4 py-6">
                    <div class="echart-total-orders" style="height:85px;width:115px"></div>
                    </div>
                    <div class="mt-2">
                    <div class="d-flex align-items-center mb-2">
                        <div class="bullet-item bg-primary me-2"></div>
                        <h6 class="text-body fw-semibold flex-1 mb-0">Payée</h6>
                        <h6 class="text-body fw-semibold mb-0">{{number_format($orders->where('paid', true)->sum('total_ttc', 2, ',', ' '))}}€</h6>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bullet-item bg-primary-subtle me-2"></div>
                        <h6 class="text-body fw-semibold flex-1 mb-0">En attente paiement</h6>
                        <h6 class="text-body fw-semibold mb-0">{{number_format($orders->where('paid', false)->sum('total_ttc', 2, ',', ' '))}}€</h6>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="mb-1">Clients
                            <span class="badge badge-phoenix badge-phoenix-warning rounded-pill fs-9 ms-2"></span>
                        </h5>
                        <h6 class="text-body-tertiary">Last 7 days</h6>
                    </div>
                    <h4>{{$clients->count()}}</h4>
                    </div>
                    <div class="pb-0 pt-4">
                    <div class="echarts-new-customers" style="height:180px;width:100%;"></div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="mb-2">Produits</h5>
                    </div>
                    </div>
                    <div class="pb-4 pt-3">
                    <div class="echart-top-coupons" style="height:115px;width:100%;"></div>
                    </div>
                    <div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="bullet-item bg-primary me-2"></div>
                        <h6 class="text-body fw-semibold flex-1 mb-0">Percentage discount</h6>
                        <h6 class="text-body fw-semibold mb-0">72%</h6>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="bullet-item bg-primary-lighter me-2"></div>
                        <h6 class="text-body fw-semibold flex-1 mb-0">Fixed card discount</h6>
                        <h6 class="text-body fw-semibold mb-0">18%</h6>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bullet-item bg-info-dark me-2"></div>
                        <h6 class="text-body fw-semibold flex-1 mb-0">Fixed product discount</h6>
                        <h6 class="text-body fw-semibold mb-0">10%</h6>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card h-100">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="mb-2">Paying vs non paying</h5>
                        <h6 class="text-body-tertiary">Last 7 days</h6>
                    </div>
                    </div>
                    <div class="d-flex justify-content-center pt-3 flex-1">
                    <div class="echarts-paying-customer-chart" style="height:100%;width:100%;"></div>
                    </div>
                    <div class="mt-3">
                    <div class="d-flex align-items-center mb-2">
                        <div class="bullet-item bg-primary me-2"></div>
                        <h6 class="text-body fw-semibold flex-1 mb-0">Paying customer</h6>
                        <h6 class="text-body fw-semibold mb-0">30%</h6>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="bullet-item bg-primary-subtle me-2"></div>
                        <h6 class="text-body fw-semibold flex-1 mb-0">Non-paying customer</h6>
                        <h6 class="text-body fw-semibold mb-0">70%</h6>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
        </div>

        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-6 pb-9 border-top">
            <div class="row g-6">
                <div class="col-12 col-xl-12">
                    <div class="me-xl-4">
                        <div id="echart-designs" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-6 pb-9 border-top">
            <div class="row g-6">
                <div class="col-12 col-xl-12">
                    <div class="me-xl-4">
                        <div id="echart-products" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis pt-6 pb-9 border-top">
            <div class="row g-6">
                <div class="col-12 col-xl-12">
                    <div class="me-xl-4">
                        <div id="echart-stock" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        var chartSales = echarts.init(document.getElementById('sales-chart-year'));
        var options = {
            title: {
                //text: 'Ventes quotidiennes',
                left: 'center'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'cross'
                }
            },
            legend: {
                data: ['Montant total (€)', 'Nombre de ventes'],
                top: '10%'
            },
            xAxis: {
                type: 'category',
                data: @json($salesData['dates']) // Données des dates envoyées depuis le contrôleur
            },
            yAxis: [
                {
                    type: 'value',
                    name: 'Montant total (€)',
                    position: 'left',
                    axisLine: {
                        lineStyle: {
                            color: '#5470C6' // Couleur de l'axe gauche
                        }
                    },
                    axisLabel: {
                        formatter: '{value} €'
                    }
                },
                {
                    type: 'value',
                    name: 'Nombre de ventes',
                    position: 'right',
                    axisLine: {
                        lineStyle: {
                            color: '#91CC75' // Couleur de l'axe droit
                        }
                    },
                    axisLabel: {
                        formatter: '{value} ventes'
                    }
                }
            ],
            series: [
                {
                    name: 'Montant total (€)',
                    type: 'line',
                    data: @json($salesData['totals']), // Montant total des ventes
                    yAxisIndex: 0, // Associe cette série au premier axe Y (montant)
                    itemStyle: {
                        color: '#5470C6'
                    }
                },
                {
                    name: 'Nombre de ventes',
                    type: 'bar',
                    data: @json($salesData['ventes']), // Nombre de ventes
                    yAxisIndex: 1, // Associe cette série au deuxième axe Y (nombre de ventes)
                    itemStyle: {
                        color: '#91CC75'
                    }
                }
            ]
        };
        chartSales.setOption(options);

        /**
         *  Echart Design
         */

        // Initialisation de l'instance ECharts
        var echartDesigns = echarts.init(document.getElementById('echart-designs'));
        // Configuration améliorée du graphique
        var echartDesingsOption = {
            title: {
                text: 'Statistiques des ventes par design',
                subtext: 'Référence des T-Shirts et leur nombre de ventes',
                left: 'center'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow' // Met en évidence la barre correspondante
                }
            },
            legend: {
                data: ['T-Shirt'],
                top: 'bottom'
            },
            xAxis: {
                type: 'category',
                data: @json($designsData['reference']),
                axisLabel: {
                    rotate: 45, // Incline les étiquettes si elles sont longues
                    formatter: function (value) {
                        return value.length > 10 ? value.substring(0, 10) + '...' : value; // Tronque si trop long
                    }
                }
            },
            yAxis: {
                type: 'value',
                name: 'Nombre de ventes',
                axisLabel: {
                    formatter: '{value}'
                }
            },
            series: [
                {
                    name: 'T-Shirt',
                    type: 'bar',
                    data: @json($designsData['total_sales']),
                    itemStyle: {
                        color: '#5470C6' // Couleur personnalisée
                    },
                    label: {
                        show: true,
                        position: 'top', // Affiche les valeurs sur les barres
                        formatter: '{c}' // Affiche la valeur brute
                    }
                }
            ],
            grid: {
                left: '3%',
                right: '4%',
                bottom: '10%',
                containLabel: true
            }
        };
        // Appliquer les options au graphique
        echartDesigns.setOption(echartDesingsOption);



        /**
         *  Echart Product
         */ 
        // Initialisation de l'instance ECharts
        var echartProducts = echarts.init(document.getElementById('echart-products'));

        // Données récupérées depuis le backend
        var productsData = @json($productsData); // Assurez-vous que $data contient la nouvelle structure

        // Préparer les axes et les données
        var categories = [];
        var seriesData = [];

        Object.keys(productsData).forEach(productId => {
            productsData[productId].details.forEach(detail => {
                // Crée une catégorie pour chaque combinaison de taille et couleur
                categories.push(`${detail.size} | ${detail.color}`);
                seriesData.push(detail.sales);
            });
        });

        // Configuration du graphique
        var echartProductsOption = {
            title: {
                text: 'Statistiques des ventes par T-Shirt (taille et couleur)',
                subtext: 'Répartition des T-shirts vendus',
                left: 'center'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                }
            },
            xAxis: {
                type: 'category',
                data: categories,
                axisLabel: {
                    rotate: 45, // Incline les étiquettes pour éviter les chevauchements
                    formatter: function (value) {
                        return value.length > 20 ? value.substring(0, 20) + '...' : value; // Tronque si trop long
                    }
                }
            },
            yAxis: {
                type: 'value',
                name: 'Nombre de ventes',
                axisLabel: {
                    formatter: '{value}'
                }
            },
            series: [
                {
                    name: 'Ventes',
                    type: 'bar',
                    data: seriesData,
                    itemStyle: {
                        color: '#5470C6' // Couleur des barres
                    },
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{c}' // Affiche la valeur brute
                    }
                }
            ],
            grid: {
                left: '3%',
                right: '4%',
                bottom: '10%',
                containLabel: true
            }
        };

        // Appliquer les options au graphique
        echartProducts.setOption(echartProductsOption);

        /**
         *  Echart Stock
         */ 
        // Initialisation de l'instance ECharts
        var echartStock = echarts.init(document.getElementById('echart-stock'));

        // Données récupérées depuis le backend
        var stockData = @json($stockData); // Assurez-vous que $stockData contient les informations correctes

        // Préparer les catégories (taille + couleur) et les données de stock
        var categories = [];
        var seriesData = [];

        stockData.forEach(item => {
            // Combine taille et couleur pour les catégories
            categories.push(`${item.size} | ${item.color}`);

            // Ajouter les données avec les couleurs dynamiques basées sur le stock
            seriesData.push({
                value: item.stock,
                itemStyle: {
                    color: item.stock < 10 ? 'red' : item.stock < 30 ? 'orange' : 'green' // Couleur selon le stock
                }
            });
        });

        // Configuration du graphique
        var echartStockOption = {
            title: {
                text: 'Statistiques du Stock des Produits',
                subtext: 'Taille, Couleur, et Niveau de Stock',
                left: 'center'
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                formatter: function (params) {
                    // Affiche une info-bulle détaillée
                    var data = params[0].data;
                    return `
                <strong>${categories[params[0].dataIndex]}</strong><br>
                Stock: ${data.value}
            `;
                }
            },
            xAxis: {
                type: 'category',
                data: categories,
                axisLabel: {
                    rotate: 45, // Incline les étiquettes pour éviter les chevauchements
                    formatter: function (value) {
                        return value.length > 30 ? value.substring(0, 30) + '...' : value; // Tronque si trop long
                    }
                }
            },
            yAxis: {
                type: 'value',
                name: 'Quantité en Stock',
                axisLabel: {
                    formatter: '{value}'
                }
            },
            series: [
                {
                    name: 'Stock',
                    type: 'bar',
                    data: seriesData,
                    label: {
                        show: true,
                        position: 'top',
                        formatter: '{c}' // Affiche la valeur brute
                    }
                }
            ],
            grid: {
                left: '3%',
                right: '4%',
                bottom: '10%',
                containLabel: true
            }
        };

        // Appliquer les options au graphique
        echartStock.setOption(echartStockOption);
        echartStock.on('click', function (params) {
            // Récupérer l'ID du produit à partir des données
            var productId = params.data.product_id;

            // Rediriger vers la page produit
            if (productId) {
                window.location.href = `/product/${productId}`; // Route Laravel vers la page du produit
            }
        });




    });

</script>
@endsction