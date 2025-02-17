<!DOCTYPE html>
<html>
<head>
    <title>Cart Products</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Your Cart Products</h2>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td>{{ $item->decor->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->decor->price, 2) }} MAD</td>
                <td>{{ number_format($item->decor->price * $item->quantity, 2) }} MAD</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total: {{ number_format($cart->sum(fn($item) => $item->decor->price * $item->quantity), 2) }} MAD</h3>
</body>
</html>
    