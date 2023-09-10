<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json(['categories' => $categories], 200);
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
            'name' => 'required|string|max:255|unique:categories',
            'is_active' => 'boolean',
        ]);

        $category = Category::create([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);

        return response()->json(['category' => $category], 201);
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
    // edit getegory
    public function edit($id){
        // Find the category by ID
        $category = Category::findorFail($id);

        // Check if the category exists
        if (!$category) {
            return response()->json("Category not found!", 404);
        }
        return response()->json($category, 200);
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
        $category = Category::findOrFail($id);
    
        // Check if the category exists
        if (!$category) {
            return response()->json("Category not found!", 404);
        }
    
        // Update the existing Category
        $category->update([
            'name' => $request->name,
            'is_active' => $request->is_active,
        ]);
    
        return response()->json($category,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $category = Category::findOrFail($id);
    
        // Delete category
        $category->delete();
    
        return response()->json([], 204);
    }
}
