<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;

class PaymentSystemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('priority', 'asc')->get();
        return view('admin.paymentSystems.allPaymentSystems', ['payments' => $payments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paymentSystems.addPaymentSystems');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'image' => 'nullable|mimes:png|max:4000',
            'short_name' => 'required|string|max:200',
            'number' => 'nullable|numeric|min:11',
            'type' => 'nullable|string|max:100',
            'priority' => 'required|numeric|unique:payments',
        ]);

        $payment = new Payment();
        $payment->name = $request->name;
        
        //if logo valid, go to upload logo and store settings
        $image = $request->file('image');
        if ($image) {
            $extension = $request->image->extension();
            $image_name = time() . "." . $extension;
            $upload_path = 'images/payment-images/';
            $image_url = $upload_path . $image_name;

            $payment->image = $image_url;

            //logo upload on folder
            $image->move($upload_path, $image_url);
        }
        $payment->short_name = $request->short_name;
        $payment->no = $request->number;
        $payment->type = $request->type;
        $payment->priority = $request->priority;
        $payment->save();

        $notification = [
            'message' => 'Successfully payment system added!',
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
        $payment = Payment::find($id);
        if (empty($payment)) {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        } else {
            return view('admin.paymentSystems.editPaymentSystems', ['payment' => $payment]);
        }
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'image' => 'nullable|mimes:png|max:4000',
            'short_name' => 'required|string|max:200',
            'number' => 'nullable|numeric|min:11',
            'type' => 'nullable|string|max:100',
            'priority' => 'required|numeric|unique:payments,priority,'.$id,
        ]);

        $payment = Payment::find($id);
        $payment->name = $request->name;
        
        //if logo valid, go to upload logo and store settings
        $image = $request->file('image');
        if ($image) {
            $extension = $request->image->extension();
            $image_name = time() . "." . $extension;
            $upload_path = 'images/payment-images/';
            $image_url = $upload_path . $image_name;

            $payment->image = $image_url;

            //logo upload on folder
            $image->move($upload_path, $image_url);
        }
        $payment->short_name = $request->short_name;
        $payment->no = $request->number;
        $payment->type = $request->type;
        $payment->priority = $request->priority;
        $payment->save();

        $notification = [
            'message' => 'Successfully payment system updated!',
            'alert-type' => 'success',
        ];
        return redirect('admin/payment-systems')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        if (empty($payment)) {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
        } else {
            $image = $payment->image;
            if (file_exists($image)) {
                unlink($image);
            }
            $payment->delete();
            $notification = [
                'message' => 'Successfully payment system deleted!',
                'alert-type' => 'success',
            ];
        }
        return redirect()->back()->with($notification);
    }
}
