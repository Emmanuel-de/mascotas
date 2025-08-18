<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .summary { margin-bottom: 30px; }
        .summary-item { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total-row { font-weight: bold; background-color: #f9f9f9; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sales Report</h1>
        <p>Generated on: {{ $generatedAt->format('d/m/Y H:i') }}</p>
    </div>

    <div class="summary">
        <h2>Summary</h2>
        <div class="summary-item"><strong>Total Products Profit:</strong> ${{ number_format($totalProductsProfit, 2) }}</div>
        <div class="summary-item"><strong>Total Pets Sold:</strong> {{ $totalPetsSold }}</div>
        <div class="summary-item"><strong>Total Profit Earned:</strong> ${{ number_format($totalProfit, 2) }}</div>
        <div class="summary-item"><strong>Total Customers:</strong> {{ $customers->count() }}</div>
    </div>

    <h2>Customer Details</h2>
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Total Purchases</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                @php
                    $customerTotal = $sales->where('customer_id', $customer->id)->sum('total');
                @endphp
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone ?? 'N/A' }}</td>
                    <td>${{ number_format($customerTotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Sales Details</h2>
    <table>
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Subtotal</th>
                <th>Tax</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>#{{ $sale->id }}</td>
                    <td>{{ $sale->customer->name }}</td>
                    <td>{{ $sale->sale_date->format('d/m/Y H:i') }}</td>
                    <td>${{ number_format($sale->subtotal ?? 0, 2) }}</td>
                    <td>${{ number_format($sale->tax ?? 0, 2) }}</td>
                    <td>${{ number_format($sale->total, 2) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="5"><strong>TOTAL</strong></td>
                <td><strong>${{ number_format($totalProfit, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>