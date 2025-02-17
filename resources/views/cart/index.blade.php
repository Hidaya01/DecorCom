@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4" style="color: #95674d;">Your Cart</h2>

    @if($cartItems->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->decor->name }}</td>
                            <td>{{ $cartItem->decor->price }} MAD</td>
                            <td>{{ $cartItem->quantity }}</td>
                            <td>{{ $cartItem->decor->price * $cartItem->quantity }} MAD</td>
                            <td class="d-flex gap-2">
                                <!-- Edit quantity -->
                                <a href="{{ route('cart.edit', $cartItem->id) }}" class="btn btn-warning btn-sm hover-scale">Edit</a>

                                <!-- Delete item -->
                                <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm hover-scale" onclick="return confirm('Delete this item?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @php $total += $cartItem->decor->price * $cartItem->quantity; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4 class="mb-0" style="color: #95674d;">Total: {{ $total }} MAD</h4>
            <div class="d-flex gap-2">
                <!-- Download cart as PDF -->
                <a href="{{ route('cart.pdf') }}" class="btn btn-outline-dark hover-scale">Download PDF</a>

                <!-- Clear cart -->
                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger hover-scale" onclick="return confirm('Are you sure you want to clear the cart?')">Clear Cart</button>
                </form>
            </div>
        </div>
    @else
        <p class="text-center">Your cart is empty.</p>
    @endif
</div>
@endsection

@push('styles')
<style>
    /* Hover Scale Effect */
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-scale:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Table Styling */
    .table {
        border-radius: 10px;
        overflow: hidden;
    }

    .table thead th {
        background-color: #6B8E23;
        color: white;
        border: none;
    }

    .table tbody tr {
        transition: background-color 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: rgba(107, 142, 35, 0.1);
    }

    /* Button Styling */
    .btn {
        border-radius: 30px;
        font-size: 14px;
        padding: 8px 16px;
    }

    .btn-warning {
        background-color: #f0ad4e;
        border-color: #f0ad4e;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .btn-outline-dark {
        border-color: #343a40;
        color: #343a40;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .d-flex.gap-2 {
            gap: 8px !important;
        }

        .btn {
            font-size: 12px;
            padding: 6px 12px;
        }
    }
</style>
@endpush