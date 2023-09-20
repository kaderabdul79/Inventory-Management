<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', $request->perPage);
        $products = Product::with('category', 'size', 'brand')->paginate($perPage);

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
        // return $request;
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'size_id' => 'required|exists:sizes,id',
            'brand_id' => 'required|exists:brands,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity_in_stock' => 'required|integer',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // return $request;
        // $product = Product::create($request->all());
        $product = new Product();
        $product->name = $request->input('name');
        $product->category_id = $request->input('category_id');
        $product->size_id = $request->input('size_id');
        $product->brand_id = $request->input('brand_id');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->quantity_in_stock = $request->input('quantity_in_stock');

        // Handle file upload
        if ($request->hasFile('picture')) {
            // return $request->file('picture');
            $file = $request->file('picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('products_picture', $fileName, 'public');
            // return $fileName;
            $product->picture = $fileName;
        }else{
            return "file ni";
        }
        $product->save();
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
            // 'category_id' => 'required|exists:categories,id',
            // 'size_id' => 'required|exists:sizes,id',
            // 'brand_id' => 'required|exists:brands,id',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity_in_stock' => 'required|integer',
        ]);
        return $request;
        $product->update($request->all());

        return response()->json(['product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    
        return response()->json([], 204);
    }

    // product search by name and description
    public function search(Request $request)
    {
        // return $request->params;
        $query = $request->input('query');
        
        $products = Product::where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->get();
        
        return response()->json(['products' => $products], 200);
        
    }
    
    

}
