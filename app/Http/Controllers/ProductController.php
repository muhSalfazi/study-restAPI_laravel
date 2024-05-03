<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|max:50',
            'product_type' => 'required|in:snack,drink,fruit',
            'product_price' => 'required|numeric',
            'expired_at' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $payload = $validator->validated();
        Product::create([
            'product_name' => $payload['product_name'],
            'product_type' => $payload['product_type'],
            'product_price' => $payload['product_price'],
            'expired_at' => $payload['expired_at']
        ]);

        return response()->json([
            'message' => 'Data berhasil disimpan'
        ])->setStatusCode(201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'sometimes|max:50',
            'product_type' => 'sometimes|in:snack,drink,fruit',
            'product_price' => 'sometimes|numeric',
            'expired_at' => 'sometimes|date'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages())->setStatusCode(422);
        }
        $valid = $validator->validated();
        $product = Product::findOrFail($id);
        if ($product) {
            Product::where('id', $id)->update($valid);
            return response()->json([
                'message' => 'Data berhasil diupdate'
            ])->setStatusCode(200);
        }
        return response()->json(['data dengan id (' . $id . ')tidak di  temukan']);
    }


    public function delete ($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product) {
            Product::where('id', $id)->delete();
            return response()->json([
               'message' => 'Data berhasil dihapus'
            ])->setStatusCode(200);
        }
        return response()->json(['data dengan id (' . $id . ')tidak di  temukan']);
    }
}