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

        $salesData = $this->getSalesData(2025);

        // Transformation des données pour Echarts
        $dates = array_column($salesData, 'date');
        $totals = array_column($salesData, 'total');
        $ventes = array_column($salesData, 'vente');

        return view('home', [
            'clients' => $clients,
            'orders' => $orders,
            'products' => $products,
            'dates' => $dates,
            'totals' => $totals,
            'ventes' => $ventes,
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
}
