<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            //code...
            $category_products = CategoryProduct::get(['id', 'name']);

            return response()->json([
                'status'    => true,
                'message'   => 'Success get data',
                'data'      => $category_products
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
                'name'   => 'required|max:255|string'
            ]);

            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status'    => false,
                    'message'   => 'Error',
                    'errors'    => $validator->errors()
                ], 200);
            }

            $data = CategoryProduct::create($validator->validated());

            return response()->json([
                'status'        => true,
                'message'       => 'Success add data',
                'data'          => $data
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
    public function show(CategoryProduct $categoryProduct)
    {
        //
        try {
            //code...
            return response()->json([
                'status'        => true,
                'message'       => 'Success',
                'data'          => $categoryProduct
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
    public function update(Request $request, CategoryProduct $categoryProduct)
    {
        //
        try {
            //code...

            $validator = Validator::make($request->all(), [
                'name'   => 'required|max:255|string'
            ]);

            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status'    => false,
                    'message'   => 'Error',
                    'errors'    => $validator->errors()
                ], 200);
            }

            $categoryProduct->update($request->all());

            return response()->json([
                'status'        => true,
                'message'       => 'Success update data',
                'data'          => $categoryProduct
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
    public function destroy(CategoryProduct $categoryProduct)
    {
        //
        try {
            //code...
            $categoryProduct->delete();

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
