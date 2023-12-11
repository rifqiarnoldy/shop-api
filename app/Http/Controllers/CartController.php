<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //
    public function cart(Request $request)
    {
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'user_id'       => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status'    => false,
                    'message'   => 'Error',
                    'errors'    => $validator->errors()
                ], 200);
            }

            $carts = Cart::with(['user', 'product.category_product'])->where(['user_id' => $request->user_id])->get();

            return response()->json([
                'status'    => true,
                'message'   => 'Success get data',
                'data'      => $carts,
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

    public function add_cart(Request $request)
    {
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'user_id'       => 'required|exists:users,id',
                'product_id'    => 'required|exists:products,id',
            ]);

            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status'    => false,
                    'message'   => 'Error',
                    'errors'    => $validator->errors()
                ], 200);
            }

            $cart = Cart::where(['user_id' => $request->user_id, 'product_id' => $request->product_id])->first();

            if ($cart) {
                # code...
                $cart->qty += $request->qty ? $request->qty : 1;
                $cart->save();
            } else {
                $cart = Cart::create([
                    'user_id'       => $request->user_id,
                    'product_id'    => $request->product_id,
                    'qty'           => $request->qty ? $request->qty : 1,
                ]);
            }

            return response()->json([
                'status'        => true,
                'message'       => 'Success',
                'data'          => $cart
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

    public function update_cart(Request $request)
    {
        try {
            //code...
            $cart = Cart::where(['id' => $request->id])->first();
            $cart->qty = $request->qty;
            $cart->save();

            return response()->json([
                'status' => true,
                'message' => 'Success update',
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

    public function remove_cart(Request $request)
    {
        try {
            //code...
            $validator = Validator::make($request->all(), [
                'user_id'       => 'required|exists:users,id',
                'product_id'    => 'required|exists:products,id',
                'qty'           => 'required|numeric|min:1',
            ]);

            if ($validator->fails()) {
                # code...
                return response()->json([
                    'status'    => false,
                    'message'   => 'Error',
                    'errors'    => $validator->errors()
                ], 200);
            }
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
