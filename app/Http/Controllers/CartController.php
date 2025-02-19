<?php

namespace App\Http\Controllers;

use App\Models\Decor;
use App\Models\Cart;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CartController extends Controller
{
    /**
     * Affiche le panier de l'utilisateur.
     */
    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

    $cartItems = Cart::where('user_id', auth()->id())->with('decor')->get();
    return view('cart.index', compact('cartItems'));


    }

    /**
     * Ajoute un décor au panier.
     */
    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        $request->validate([
            'decor_id' => 'required|exists:decors,id',
        ]);

        $cartItem = Cart::where('user_id', auth()->id())
                        ->where('decor_id', $request->decor_id)
                        ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'decor_id' => $request->decor_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Décor ajouté au panier.');
    }
    public function edit(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Accès non autorisé.');
        }

        return view('cart.edit', ['cartItem' => $cart]);
    }

    /**
     * Met à jour la quantité d'un produit dans le panier.
     */
    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Accès non autorisé.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour.');
    }

    /**
     * Supprime un élément du panier.
     */
    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Accès non autorisé.');
        }

        $cart->delete();
        return redirect()->back()->with('success', 'Article supprimé du panier.');
    }

    /**
     * Vide complètement le panier de l'utilisateur.
     */
    public function clear()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        Cart::where('user_id', auth()->id())->delete();
        return redirect()->back()->with('success', 'Panier vidé.');
    }

    /**
     * Génère un PDF du panier.
     */
    public function generatePDF()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
        }

        $cart = Cart::where('user_id', auth()->id())->with('decor')->get();

        $pdf = Pdf::loadView('cart.pdf', compact('cart'));

        return $pdf->download('cart_products.pdf');
    }
    public function export()
    {
        return Excel::download(new CartExport, 'cart.xlsx');
    }

}
