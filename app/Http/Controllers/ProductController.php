<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        $products = Product::with('category', 'size', 'brand')->get();
        return response()->json(['products' => $products], 200);
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
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'size_id' => 'required|exists:sizes,id',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity_in_stock' => 'required|integer',
        ]);

        $product = Product::create($request->all());

        return response()->json(['product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $product->load('category', 'size', 'brand');
        return response()->json(['product' => $product], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return response()->json(['product' => $product], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'size_id' => 'required|exists:sizes,id',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity_in_stock' => 'required|integer',
        ]);

        $product->update($request->all());

        return response()->json(['product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([], 202);
    }
}
