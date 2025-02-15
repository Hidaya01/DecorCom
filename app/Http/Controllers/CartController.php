<?php

namespace App\Http\Controllers;

use App\Models\Decor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Decor $decor)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$decor->id])) {
            $cart[$decor->id]['quantity']++;
        } else {
            $cart[$decor->id] = [
                'name' => $decor->name,
                'price' => $decor->price,
                'quantity' => 1
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Décor ajouté au panier.');
    }

    public function remove(Decor $decor)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$decor->id])) {
            unset($cart[$decor->id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Décor retiré du panier.');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Panier vidé.');
    }
}
