<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct()
    {
        // Middleware is applied via routes/web.php
    }

    public function index()
    {
        $pets = Pet::paginate(10);
        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:excellent,good,fair',
            'description' => 'nullable|string',
        ]);

        Pet::create($request->all());

        return redirect()->route('pets.index')
            ->with('success', 'Pet created successfully.');
    }

    public function show(Pet $pet)
    {
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'breed' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:excellent,good,fair',
            'description' => 'nullable|string',
            'available' => 'boolean',
        ]);

        $pet->update($request->all());

        return redirect()->route('pets.index')
            ->with('success', 'Pet updated successfully.');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect()->route('pets.index')
            ->with('success', 'Pet deleted successfully.');
    }
}