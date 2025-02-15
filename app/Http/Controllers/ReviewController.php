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
        'decor_id' => 'required|exists:decors,id',
    ]);

    $review = Review::create([
        'content' => $request->content,
        'rating' => $request->rating,
        'user_id' => auth()->id(),
        'decor_id' => $request->decor_id,
    ]);

    if (!$review) {
        return back()->with('error', 'Review could not be saved.');
    }

    return redirect()->back()->with('success', 'Review added successfully.');
}


    

public function update(Request $request, Review $review)
{
    // Ensure user owns the review
    if ($review->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Unauthorized');
    }

    $validatedData = $request->validate([
        'content' => 'required|string',
        'rating' => 'required|numeric|min:1|max:5',
    ]);

    $review->update($validatedData);

    return redirect()->back()->with('success', 'Review updated successfully.');
}


public function destroy(Review $review)
{
    if ($review->user_id !== auth()->id()) {
        return redirect()->back()->with('error', 'Unauthorized');
    }

    $review->delete();
    return redirect()->back()->with('success', 'Review deleted successfully.');
}
}