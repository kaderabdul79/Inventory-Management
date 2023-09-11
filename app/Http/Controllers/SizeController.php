<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::all();
        return response()->json(['sizes' => $sizes], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:sizes',
            'is_active' => 'boolean',
        ]);

        $size = Size::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return response()->json(['size' => $size], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the size by ID
        $size = Size::findorFail($id);

        // Check if the size exists
        if (!$size) {
            return response()->json("size not found!", 404);
        }
        return response()->json($size, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);
    
        // Find the existing user
        $size = Size::findOrFail($id);
    
        // Check if the size exists
        if (!$size) {
            return response()->json("size not found!", 404);
        }
    
        // Update the existing size
        $size->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);
    
        return response()->json($size,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = Size::findOrFail($id);
    
        // Delete size
        $size->delete();
    
        return response()->json([], 204);
    }
}
