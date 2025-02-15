<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Decor;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user', 'decor')->get();  
        $decors = Decor::all();  
        
        return view('reviews.index', compact('reviews', 'decors'));
    }
    public function create()
    {
        $decors = Decor::all();  // Récupérer tous les décors disponibles
        return view('reviews.create', compact('decors'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
            'user_id' => 'required|exists:users,id',
            'decor_id' => 'required|exists:decors,id',
        ]);

        Review::create($validatedData);

        return redirect()->back()->with('success', 'Avis ajouté avec succès.');
    }

    public function update(Request $request, Review $review)
    {
        $validatedData = $request->validate([
            'content' => 'required|string',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $review->update($validatedData);

        return redirect()->back()->with('success', 'Avis mis à jour avec succès.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->back()->with('success', 'Avis supprimé avec succès.');
    }
}
