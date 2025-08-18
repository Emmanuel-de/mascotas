<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Pet;
use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalPets = Pet::where('available', true)->count();
        $totalSales = Sale::count();
        $totalCustomers = Customer::count();
        $lowStockProducts = Product::where('stock', '<=', 10)->count();
        $recentSales = Sale::with(['customer', 'user'])
            ->latest()
            ->take(5)
            ->get();
        $salesToday = Sale::whereDate('created_at', today())->count();

        return view('dashboard', compact(
            'totalProducts',
            'totalPets',
            'totalSales',
            'totalCustomers',
            'lowStockProducts',
            'recentSales',
            'salesToday'
        ));
    }
}