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

        return view('admin.pages.orders.all-order', compact('orders'));
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
            return view('admin.pages.orders.view-order', compact('order'));
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect('/admin/orders')->with($notification);
        }
    }

}
