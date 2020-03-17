<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;

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

}
