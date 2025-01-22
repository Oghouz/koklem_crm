<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clients = Client::all();
        $orders = Order::all();
        $products = Product::all();

        $sales = $this->getSalesData(2025);

        // Transformation des données pour Echarts
        $salesData = [
            'dates' => array_column($sales, 'date'),
            'totals' => array_column($sales, 'total'),
            'ventes' => array_column($sales, 'vente')
        ];

        $designsData = $this->getDesignsData();
        $productsData = $this->getProductsData();
        $stockData = $this->getStockData();

        return view('home', [
            'clients' => $clients,
            'orders' => $orders,
            'products' => $products,
            'salesData' => $salesData,
            'designsData' => $designsData,
            'productsData' => $productsData,
            'stockData' => $stockData
        ]);
    }

    public function getSalesData($year = "2025")
    {
        // Récupérer les ventes et totaux groupés par mois pour l'année 2025
        $sales = Order::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_ttc) as total, COUNT(*) as vente')
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
            ->get();

        // Initialiser le tableau des données de ventes pour tous les mois
        $salesData = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthKey = str_pad($month, 2, '0', STR_PAD_LEFT); // Mois au format "01", "02", etc.
            $salesData[$month] = [
                'date' => "$year-$monthKey",
                'total' => 0,  // Valeur par défaut
                'vente' => 0,  // Valeur par défaut
            ];
        }

        // Mettre à jour les données avec les résultats réels de la base de données
        foreach ($sales as $sale) {
            $salesData[$sale->month]['total'] = $sale->total;
            $salesData[$sale->month]['vente'] = $sale->vente;
        }

        // Réindexer le tableau (si nécessaire) et transformer en liste pour le front-end
        $salesData = array_values($salesData);

        return $salesData;
    }

    public function getDesignsData()
    {
        // Récupérer les statistiques de vente pour tous les designs avec leur référence
        $salesStatistics = DB::table('order_lines')
            ->where('product_id', '<>', 25)
            ->select('design_id', 'reference', DB::raw('SUM(quantity) as total_sales'))
            ->groupBy('design_id', 'reference')
            ->orderBy('total_sales', 'desc')
            ->get()->toArray();

        // Retourner les statistiques sous forme de tableau
        $data = [
            'design_id' => array_column($salesStatistics, 'design_id'),
            'reference' => array_column($salesStatistics, 'reference'),
            'total_sales' => array_column($salesStatistics, 'total_sales')
        ];
        return $data;
    }

    public function getProductsData()
    {
        $salesStatistics = DB::table('order_lines')
            ->where('product_id', '<>', 25)
            ->select('product_id', 'size', 'color', DB::raw('SUM(quantity) as total_sales'))
            ->groupBy('product_id', 'size', 'color')
            ->orderBy('total_sales', 'desc')
            ->get();

        // Initialiser les données pour le retour
        $data = [];

        foreach ($salesStatistics as $stat) {
            // Si le produit n'existe pas encore dans $data, on l'initialise
            if (!isset($data[$stat->product_id])) {
                $data[$stat->product_id] = [
                    'product_id' => $stat->product_id,
                    'total_sales' => 0,
                    'details' => [] // Détails par taille et couleur
                ];
            }

            // Ajouter les ventes au total global du produit
            $data[$stat->product_id]['total_sales'] += $stat->total_sales;

            // Ajouter les détails (taille et couleur) à la liste
            $data[$stat->product_id]['details'][] = [
                'size' => $stat->size,
                'color' => $stat->color,
                'sales' => $stat->total_sales
            ];
        }

        return $data;
    }

    public function getStockData()
    {
        // Récupérer les produits avec leur couleur
        $products = Product::with('color')
            ->select('id', 'name', 'size', 'color_id', 'stock') // Colonnes nécessaires
            ->get();

        // Préparer les données pour le graphique
        $stockData = $products->map(function ($product) {
            return [
                'name' => $product->name,
                'size' => $product->size,
                'color' => $product->color ? $product->color->name : 'Inconnu',
                'stock' => $product->stock
            ];
        });

        return $stockData;
    }

}
