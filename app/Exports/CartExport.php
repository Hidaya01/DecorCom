<?php
namespace App\Exports;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CartExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $cartItems = Cart::with('decor')->where('user_id', Auth::id())->get();

        return $cartItems->transform(function ($cartItem) {
            return [
                'Product' => $cartItem->decor ? $cartItem->decor->name : 'N/A',
                'Price' => $cartItem->decor ? $cartItem->decor->price : 'N/A',
                'Quantity' => $cartItem->quantity,
                'Total' => $cartItem->decor ? $cartItem->decor->price * $cartItem->quantity : 'N/A'
            ];
        });
    }

    public function headings(): array
    {
        return ['Product', 'Price', 'Quantity', 'Total'];
    }
}
