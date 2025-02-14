<?php
namespace App\Http\Controllers;

use App\Models\Decor;
use Illuminate\Http\Request;

class DecorController extends Controller
{
    public function index()
    {
        // Récupérer tous les décors
        $decors = Decor::all();
        
        // Passer les données à la vue
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
        ]);

        Decor::create($validatedData);

        return redirect()->route('decors.index')->with('success', 'Décor ajouté avec succès.');
    }

    public function show(Decor $decor)
    {
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
        ]);

        $decor->update($validatedData);

        return redirect()->route('decors.index')->with('success', 'Décor mis à jour avec succès.');
    }

    public function destroy(Decor $decor)
    {
        $decor->delete();
        return redirect()->route('decors.index')->with('success', 'Décor supprimé avec succès.');
    }
}
