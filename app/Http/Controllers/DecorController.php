<?php
namespace App\Http\Controllers;

use App\Models\Decor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class DecorController extends Controller
{
    public function index()
    {
        $decors = Decor::all();
        return view('decors.index', compact('decors'));
    }

    public function create()
    {
        return view('decors.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('decors', 'public');
            $validatedData['image'] = $imagePath;
        }

        Decor::create($validatedData);

        return redirect()->route('decors.index')->with('success', 'Décor ajouté avec succès.');
    }

    public function show(Decor $decor)
{
    $decor->load('reviews.user'); 
    return view('decors.show', compact('decor'));
}


    public function edit(Decor $decor)
    {
        return view('decors.edit', compact('decor'));
    }

    public function update(Request $request, Decor $decor)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            if ($decor->image) {
                Storage::disk('public')->delete($decor->image);
            }
            $imagePath = $request->file('image')->store('decors', 'public');
            $validatedData['image'] = $imagePath;
        }

        $decor->update($validatedData);

        return redirect()->route('decors.index')->with('success', 'Décor mis à jour avec succès.');
    }

    public function destroy(Decor $decor)
    {
        if ($decor->image) {
            Storage::disk('public')->delete($decor->image);
        }
        $decor->delete();
        return redirect()->route('decors.index')->with('success', 'Décor supprimé avec succès.');
    }
  




}
