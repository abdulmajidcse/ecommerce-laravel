<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            $carts = Cart::where('user_id', Auth::id())->where('order_id', NULL)->where('order_id', NULL)->get();
        } else {
            $carts = Cart::where('user_id', NULL)->where('ip_address', Request()->ip())->where('order_id', NULL)->where('order_id', NULL)->get();
        }

        if (count($carts) > 0) {
            return view('frontend.pages.cart', compact('carts'));   
        } else {
            $notification = [
                'message' => 'Cart is empty!',
                'alert-type' => 'info'
            ];
            return redirect()->route('home')->with($notification);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_quantity' => 'min:1|numeric'
        ]);
        $cart = Cart::orWhere('user_id', Auth::id())
                ->where('ip_address', $request->ip())
                ->where('product_id', $id)
                ->where('order_id', NULL)
                ->first();

        if (!is_null($cart)) {
            $cart->increment('product_quantity');

        } else {
            $cart = new Cart();
            if (Auth::check()) {
                $cart->user_id = Auth::id();
            }

            if ($request->product_quantity) {
                $cart->product_quantity = $request->product_quantity;
            }

            $cart->product_id = $id;
            $cart->ip_address = $request->ip();
            $cart->save();
        }

        $notification = [
            'message' => 'Product has added to cart',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_quantity' => 'required|numeric|min:1'
        ]);

        $cart = Cart::find($id);

        if (!is_null($cart)) {
            $cart->product_quantity = $request->product_quantity;
            $cart->save();
            $notification = [
                'message' => 'Product quantity added!',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
        }
        return redirect('/carts')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete cart item
        $cart = Cart::find($id);
        if (!is_null($cart)) {
            $cart->delete();
            $notification = [
                'message' => 'Successfully cart item deleted!',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
        }

        return redirect('/carts')->with($notification);
    }
}
