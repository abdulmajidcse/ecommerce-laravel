<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Cart;
use PDF;
use App\Settings;

class OrdersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();

        return view('admin.pages.orders.all_order', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if (!is_null($order)) {
            $order->is_seen_by_admin = 1;
            $order->save();
            return view('admin.pages.orders.view_order', compact('order'));
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect('/admin/orders')->with($notification);
        }
    }

    public function cartUpdate(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_quantity' => 'required|numeric|min:1'
        ]);
        $cart = Cart::find($id);
        if (is_null($cart)) {
            $request->session()->flash('message', 'Something went wrong!');
            $request->session()->flash('alert-type', 'error');
            return redirect()->back();
        } else {
            $cart->product_quantity = $request->product_quantity;
            $cart->save();
            $request->session()->flash('message', 'Successfully product quantity saved!');
            $request->session()->flash('alert-type', 'success');
            return redirect()->back();
        }
    }

    public function giveOffer(Request $request, $id)
    {
        $validateData = $request->validate([
            'offer' => 'required|numeric|min:0'
        ]);
        $offer = Order::find($id);
        if (is_null($offer)) {
            $request->session()->flash('message', 'Something went wrong!');
            $request->session()->flash('alert-type', 'error');
            return redirect()->back();
        } else {
            $offer->offer = $request->offer;
            $offer->save();
            $request->session()->flash('message', 'Successfully offer added!');
            $request->session()->flash('alert-type', 'success');
            return redirect()->back();
        }
    }

    public function complete($id)
    {
        $order = Order::find($id);
        if ($order->is_completed) {
            $order->is_completed = 0;
            $notification = [
                'message' => 'Order Cancel successfully!',
                'alert-type' => 'success'
            ];
        } else {
            $order->is_completed = 1;
            $notification = [
                'message' => 'Order completed successfully!',
                'alert-type' => 'success'
            ];
        }
        $order->save();

        return redirect()->back()->with($notification);

    }

    public function paid($id)
    {
        $order = Order::find($id);
        if ($order->is_paid) {
            $order->is_paid = 0;
            $notification = [
                'message' => 'Payment cancel successfully!',
                'alert-type' => 'success'
            ];
        } else {
            $order->is_paid = 1;
            $notification = [
                'message' => 'Paid order successfully!',
                'alert-type' => 'success'
            ];
        }
        $order->save();

        return redirect()->back()->with($notification);

    }

    /**
     * dom pdf invoice
     **/
    public function invoice($id)
    {
        $order = Order::find($id);
        $settings = Settings::get()->first();
        // return view('admin.pages.orders.invoice', ['order' => $order]);
        $pdf = PDF::loadView('admin.pages.orders.invoice', ['order' => $order, 'settings' => $settings]);
        return $pdf->stream();
        // return $pdf->download($order->name . '-invoice.pdf');
    }

    public function cartDestroy(Request $request, $id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            $request->session()->flash('message', 'Successfully cart item deleted!');
            $request->session()->flash('alert-type', 'success');
            return redirect()->back();
        } else {
            $request->session()->flash('message', 'Something went wrong!');
            $request->session()->flash('alert-type', 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        if (!empty($order)) {
            foreach ($order->carts as $cart) {
                $cart->delete();
            }
            $order->delete();
            $notification = [
                'message' => 'Successfully order deleted!',
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

}
