<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // $stocks = Stock::all();
        $stocks = Stock::with('product')->get();
        return response()->json(['stocks' => $stocks], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|integer',
            'location' => 'required|string'
        ]);

        $stock = Stock::create([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
            'location' => $request->location,
        ]);

        return response()->json(['stock' => $stock], 201);
    }
}
