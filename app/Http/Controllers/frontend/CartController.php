<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->session()->has('carts')) {
            $carts = $request->session()->get('carts');
            $products = array();
            foreach ($carts as $cart_item) {
                $products[] = Product::find($cart_item['product_id']);
            }
            return view('frontend.pages.cart', ['carts' => $carts, 'products' => $products]);  
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
    public function store(Request $request)
    {

        //set a array
        $data = ['carts' => array()];

        //if cart item already exist
        if ($request->session()->has('carts')) {
            $data['carts'] = $request->session()->get('carts');
            $request->session()->forget('carts');

            //check product id
            foreach ($data['carts'] as $cart_id => $cart_item) {
                //if product id already exist, store id in $cart_array_id
                if ($cart_item['product_id'] == $request->id) {
                    $cart_array_id = $cart_id;
                }
            }

            //if isset $cart_array_id, increament product_quantity
            if (isset($cart_array_id)) {
                $data['carts'][$cart_array_id]['product_quantity'] += 1;
            } else {
                $data['carts'][] = [
                    'ip_address' => $request->ip(),
                    'product_id' => $request->id,
                    'product_quantity' => 1
                ];
            }
        } else {
            $data['carts'][] = [
                'ip_address' => $request->ip(),
                'product_id' => $request->id,
                'product_quantity' => 1
            ];
        }
        
        //store cart item in session
        $request->session()->put($data);
        $cart_items = NULL;
        foreach ($data['carts'] as $cart_item) {
            $cart_items += $cart_item['product_quantity'];
        }

        $notification = [
            'message' => 'Product has added to cart. Total cart Items: ' . $cart_items,
            'items' => $cart_items,
        ];
        return json_encode($notification);
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

        if ($request->session()->has('carts.'.$id)) {
            $data = ['carts' => array()];
            $data['carts'] = $request->session()->get('carts');
            $request->session()->forget('carts');
            $data['carts'][$id]['product_quantity'] = $request->product_quantity;
            $request->session()->put($data);
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
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->session()->has('carts')) {
            $request->session()->forget('carts.'.$id);
            if ($request->session()->get('carts') == NULl) {
                $request->session()->forget('carts');
            }
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

        return redirect()->back()->with($notification);
    }
}
