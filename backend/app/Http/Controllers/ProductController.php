<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json([
            'products' => $products
        ]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'description'=> 'required',
        ]);
        $product = Product::create($data);

        if($product){
            return response()->json([
                'message' => 'Product Added Successfully',
                'code' => 200,
            ]);
        }else{
            return response()->json([
                'message'=> 'Product Add Failed',
                'code'=> 500,
            ]);
        }
    }

    public function show($product){
        $item = Product::findOrFail($product);
        return response()->json([
            'product'=> $item,
        ]);
    }

    public function update(Request $request, Product $product){
        $data = $request->validate([
            'name'=> 'required',
            'price'=> 'required',
            'description'=> 'required'
        ]);

        $product->update($data);
        
        if($product){
            return response()->json([
                'message'=> 'Product Updated',
                'code'=> 200
            ]);
        }else{
            return response()->json([
                'message'=> 'Product Update Failed',
                'code'=> 500
            ]);
        }
    }

    public function destroy(Product $product){
        $product->delete();
        return response()->json([
            'message'=> 'Product Deleted',
            'code'=> 200,
        ]);
    }
}
