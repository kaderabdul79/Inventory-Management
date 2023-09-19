<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|integer',
        ]);

        $stock = Stock::create([
            'product_id' => $request->product_id,
            'size_id' => $request->size_id,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['stock' => $stock], 201);
    }
}
