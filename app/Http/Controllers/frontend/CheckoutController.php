<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Cart;
use App\Payment;
use App\Order;
use App\Product;

class CheckoutController extends Controller
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
            $paymentMethods = Payment::orderBy('priority', 'asc')->get();
            return view('frontend.pages.checkout', compact('carts', 'products', 'paymentMethods'));   
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
            return redirect()->route('home')->with($notification);
        }
    }

    /**
     * Show payment method by payment_method_id
     */
    public function selectPaymentMethod($payment_method_id)
    {
        if ($payment_method_id == "Select a payment method") {
            echo "";
        } else {
            $paymentMethod = Payment::find($payment_method_id);
            if (!is_null($paymentMethod)) {
                $no = $paymentMethod->no;
                if (empty($no)) {
                    echo "<div class='alert alert-success mt-3'><h4>For Cash in, there is nothing necessary. Just click Finish Order.</h4><small>You will get your product in two or three business days.</small></div>";
                } else {
                    echo "<div class='alert alert-success mt-3'><h4>$paymentMethod->name Payment</h4><p><strong>$paymentMethod->name No: $paymentMethod->no</strong><br/><strong>Account Type: $paymentMethod->type</strong></p><p>Please, send the above money to this bKash No and write your transaction code below there.</p><input type='text' name='transaction_id' class='form-control' placeholder='Transaction ID'></div>";
                }
            }
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
        $validateData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'max:50',
            'phone' => 'required|numeric|min:11',
            'shipping_address' => 'required|string|max:500',
            'message' => 'max:500',
            'payment_method_id' => 'required|numeric',
            'transaction_id' => 'nullable',
        ],
        [
            'payment_method_id.required' => 'Please, select a payment method!',
            'payment_method_id.numeric' => 'Please, select a payment method!',
        ]);

        //if carts has in session
        if ($request->session()->has('carts')) {
            $carts = $request->session()->get('carts');
            //check product quantity if available
            foreach ($carts as $cart_item) {
                $product = Product::find($cart_item['product_id']);
                //if product quantity not available, store message in $product_stock variable
                if ($product->quantity < $cart_item['product_quantity']) {
                    $product_stock['stock'][] = [
                        'product_name' => $product->title,
                        'product_quantity' => $product->quantity,
                    ];
                }
            }
            //if isset $product_stock, redirect back and show product quantity decreament message
            if (isset($product_stock)) {
                return redirect('carts')->with($product_stock);
            } else {
                //if product quantity is available, store data in Order table
                $order = new Order();
                if (Auth::check()) {
                    $order->user_id = Auth::user()->id;
                }
                $order->payment_id = $request->payment_method_id;
                $order->ip_address = $request->ip();
                $order->name = $request->name;
                $order->phone = $request->phone;
                $order->shipping_address = $request->shipping_address;
                $order->email = $request->email;
                $order->message = $request->message;
                $order->transaction_id = $request->transaction_id;
                $order->save();
                //now store cart items in Cart table
                foreach ($carts as $cart_item) {
                    $cart = new Cart();
                    $cart->product_id = $cart_item['product_id'];
                    if (Auth::check()) {
                        $cart->user_id = Auth::user()->id;
                    }
                    $cart->order_id = $order->id;
                    $cart->ip_address = $cart_item['ip_address'];
                    $cart->product_quantity = $cart_item['product_quantity'];
                    $cart->save();
                    //decreament product quantity
                    $product = Product::find($cart->product_id);
                    $product->quantity -= $cart->product_quantity;
                    $product->save();
                }
                $request->session()->forget('carts');
                $notification = [
                    'message' => 'Order confirmed! Please, wait for admin confirmation.',
                    'alert-type' => 'success'
                ];
                return redirect()->route('home')->with($notification);
            }
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
