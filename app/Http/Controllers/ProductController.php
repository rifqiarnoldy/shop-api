<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            //code...
            $products = Product::with(['category_product', 'user'])->get();

            return response()->json([
                'status'    => true,
                'message'   => 'Success get data',
                'data'      => $products
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'    => false,
                'message'   => 'Error',
                'errors'    => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function get_product($user)
    {
        //
        try {
            //code...
            $products = Product::with(['category_product', 'user'])->where(['user_id' => $user])->get();

            return response()->json([
                'status'    => true,
                'message'   => 'Success get data',
                'data'      => $products
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'    => false,
                'message'   => 'Error',
                'errors'    => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'user_id'               => 'required',
                'name'                  => 'required|max:255|string',
                'description'           => 'required|max:255|string',
                'spesification'         => 'required',
                'category_product_id'   => 'required|exists:category_products,id',
                'price'                 => 'required|numeric|min:0',
                'stock'                 => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status'    => false,
                    'message'   => 'Error',
                    'errors'    => $validator->errors()
                ], 200);
            }

            $image1 = "p" . random_int(1, 12) . ".jpg";
            $image2 = "p" . random_int(1, 12) . ".jpg";

            Product::create([
                'user_id'               => $request->user_id,
                'name'                  => $request->name,
                'description'           => $request->description,
                'spesification'         => json_encode($request->spesification),
                'category_product_id'   => $request->category_product_id,
                'price'                 => $request->price,
                'stock'                 => $request->stock,
                'images'                => json_encode([$image1, $image2]),
            ]);

            return response()->json([
                'status'    => true,
                'message'   => 'Success add data',
                'data'      => $request->all()
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'    => false,
                'message'   => 'Error',
                'errors'    => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try {
            //code...
            $product = Product::with('category_product')->where(['id' => $id])->first();

            return response()->json([
                'status'    => true,
                'message'   => 'Success get data',
                'data'      => $product
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'    => false,
                'message'   => 'Error',
                'errors'    => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'user_id'               => 'required',
                'name'                  => 'required|max:255|string',
                'description'           => 'required|max:255|string',
                'spesification'         => 'required',
                'category_product_id'   => 'required|exists:category_products,id',
                'price'                 => 'required|numeric|min:0',
                'stock'                 => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status'    => false,
                    'message'   => 'Error',
                    'errors'    => $validator->errors()
                ], 200);
            }

            $image1 = "p" . random_int(1, 12) . ".jpg";
            $image2 = "p" . random_int(1, 12) . ".jpg";

            $product->user_id               = $request->user_id;
            $product->name                  = $request->name;
            $product->description           = $request->description;
            $product->spesification         = json_encode($request->spesification);
            $product->category_product_id   = $request->category_product_id;
            $product->price                 = $request->price;
            $product->stock                 = $request->stock;
            $product->images                = json_encode([$image1, $image2]);
            $product->save();


            return response()->json([
                'status'    => true,
                'message'   => 'Success update data',
                'data'      => $request->all()
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'    => false,
                'message'   => 'Error',
                'errors'    => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        try {
            //code...
            $product->delete();

            return response()->json([
                'status'    => true,
                'message'   => 'Success delete data'
            ], 200);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status'    => false,
                'message'   => 'Error',
                'errors'    => $th->getMessage()
            ], 500);
        }
    }
}
