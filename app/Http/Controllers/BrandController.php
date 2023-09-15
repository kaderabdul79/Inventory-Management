<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return response()->json(['brands' => $brands], 200);
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
            'name' => 'required|string|max:255|unique:brands',
            'is_active' => 'boolean',
        ]);

        $brand = Brand::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return response()->json(['brand' => $brand], 201);
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
        // Find the brand by ID
        $brand = Brand::findorFail($id);

        // Check if the brand exists
        if (!$brand) {
            return response()->json("This brand not found!", 404);
        }
        return response()->json($brand, 200);
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
        $brand = Brand::findOrFail($id);
    
        // Check if the brand exists
        if (!$brand) {
            return response()->json("brand not found!", 404);
        }
    
        // Update the existing brand
        $brand->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);
    
        return response()->json($brand,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
    
        // Delete brand
        $brand->delete();
    
        return response()->json([], 204);
    }

    // only get active brands
    public function getActiveBrands()
    {
        $activeBrands = Brand::where('is_active', true)->get();
        return response()->json(['brand' => $activeBrands], 200);
    }
}
