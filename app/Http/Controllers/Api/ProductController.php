<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        if ($products->count() > 0) {
            return response()->json([
                'status' => 200,
                'data' => $products
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'No record found'
            ], 404);
        }
    }
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'image' => 'required|string',
            'category' => 'required|string|max:191',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'rating_rate' => 'required|numeric',
            'rating_count' => 'required|integer'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        // Create a new product using the validated data
        $product = Product::create($validator->validated());

        // Check if product was successfully created
        if ($product) {
            return response()->json([
                'status' => 200,
                'message' => 'Product successfully created',
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Product creation failed'
            ], 500);
        }
    }
    public function show($id){
        $product = Product::find($id);
        if($product){
            return response()->json([
                'status' => 200,
                'products' => $product
            ],200);
        }else {
            return response()->json([
                'status' => 404,
                'messages' => 'No Such Product'
            ],404);
        }
    }

    public function edit($id){
        $product = Product::find($id);
        if($product){
            return response()->json([
                'status' => 200,
                'products' => $product
            ],200);
        }else {
            return response()->json([
                'status' => 404,
                'messages' => 'No Such Product'
            ],404);
        }
    }
    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:191',
            'image' => 'required|string',
            'category' => 'required|string|max:191',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'rating_rate' => 'required|numeric',
            'rating_count' => 'required|integer'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors()
            ], 422);
        }

        $product = Product::find($id);

        // Check if product was successfully created
        if ($product) {
            $product->update($validator->validated());
            return response()->json([
                'status' => 200,
                'message' => 'Product successfully updated',
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Product updating failed'
            ], 500);
        }
    }
    public function destory($id){
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Product deleted Successfully'
            ], 200);
        }else {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ], 404);
        }
    }
}
