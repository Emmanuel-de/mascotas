<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Pet;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class SaleController extends Controller
{
    public function __construct()
    {
        // Middleware is applied via routes/web.php
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'customer') {
            // Customers can only see sales where they are the customer
            $sales = Sale::with(['customer', 'user'])
                ->whereHas('customer', function($query) use ($user) {
                    $query->where('email', $user->email);
                })
                ->paginate(10);
        } else {
            // Administrators and employees can see all sales
            $sales = Sale::with(['customer', 'user'])->paginate(10);
        }

        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $user = auth()->user();
        
        if ($user->role === 'customer') {
            // For customers, find their customer record
            $customer = Customer::where('email', $user->email)->first();
            if (!$customer) {
                return redirect()->route('sales.index')
                    ->with('error', 'Customer profile not found. Please contact support.');
            }
            $customers = collect([$customer]);
        } else {
            // For administrators and employees, show all customers
            $customers = Customer::all();
        }
        
        $products = Product::where('stock', '>', 0)->get();
        $pets = Pet::where('available', true)->get();
        return view('sales.create', compact('customers', 'products', 'pets'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        // For customers, automatically set their customer_id
        if ($user->role === 'customer') {
            $customer = Customer::where('email', $user->email)->first();
            if (!$customer) {
                return redirect()->route('sales.index')
                    ->with('error', 'Customer profile not found. Please contact support.');
            }
            $request->merge(['customer_id' => $customer->id]);
        }
        
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array|min:1',
            'items.*.type' => 'required|in:product,pet',
            'items.*.id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;
            $items = [];

            foreach ($request->items as $item) {
                if ($item['type'] === 'product') {
                    $product = Product::findOrFail($item['id']);
                    if ($product->stock < $item['quantity']) {
                        throw new \Exception('Insufficient stock for ' . $product->name);
                    }
                    $price = $product->price;
                    $subtotal = $price * $item['quantity'];
                    $product->decrement('stock', $item['quantity']);
                } else {
                    $pet = Pet::findOrFail($item['id']);
                    if (!$pet->available) {
                        throw new \Exception('Pet ' . $pet->name . ' is not available');
                    }
                    $price = $pet->price;
                    $subtotal = $price * $item['quantity'];
                    $pet->update(['available' => false]);
                }

                $items[] = [
                    'item_type' => $item['type'],
                    'item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $price,
                    'subtotal' => $subtotal,
                ];

                $total += $subtotal;
            }

            $subtotal = $total;
            $tax = $subtotal * 0.16; // 16% tax
            $finalTotal = $subtotal + $tax;

            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'user_id' => auth()->id(),
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $finalTotal,
                'sale_date' => now(),
            ]);

            foreach ($items as $item) {
                $sale->saleItems()->create($item);
            }
        });

        return redirect()->route('sales.index')
            ->with('success', 'Sale created successfully.');
    }

    public function show(Sale $sale)
    {
        $user = auth()->user();

        // If user is a customer, only allow viewing their own sales
        if ($user->role === 'customer') {
            $customerMatch = $sale->customer && $sale->customer->email === $user->email;
            if (!$customerMatch) {
                abort(403, 'Unauthorized to view this sale.');
            }
        }

        $sale->load(['customer', 'user', 'saleItems']);
        return view('sales.show', compact('sale'));
    }

    public function generateSalesReport()
    {
        // Only administrators can generate reports
        if (auth()->user()->role !== 'administrator') {
            abort(403, 'Unauthorized to generate sales reports.');
        }

        $sales = Sale::with(['customer', 'user', 'saleItems'])->get();
        
        // Calculate totals
        $totalProductsProfit = 0;
        $totalPetsSold = 0;
        $totalProfit = $sales->sum('total');
        
        foreach ($sales as $sale) {
            foreach ($sale->saleItems as $item) {
                if ($item->item_type === 'product') {
                    $totalProductsProfit += $item->subtotal;
                } else {
                    $totalPetsSold += $item->quantity;
                }
            }
        }

        $customers = $sales->pluck('customer')->unique('id');
        
        $data = [
            'sales' => $sales,
            'totalProductsProfit' => $totalProductsProfit,
            'totalPetsSold' => $totalPetsSold,
            'totalProfit' => $totalProfit,
            'customers' => $customers,
            'generatedAt' => now()
        ];

        $pdf = Pdf::loadView('sales.report', $data);
        
        return $pdf->download('sales-report-' . now()->format('Y-m-d') . '.pdf');
    }
}