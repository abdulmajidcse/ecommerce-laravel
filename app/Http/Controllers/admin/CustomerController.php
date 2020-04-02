<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('admin.customers.all_customer', ['customers' => $users]);
    }

    public function changeStatus(Request $request, $id, $status)
    {
        $customer = User::find($id);
        if ($customer) {
            if ($status == 'active') {
                $customer->status = 1;
                $request->session()->flash('message', 'Successfully customer actived!');
                $request->session()->flash('alert-type', 'success');
            } elseif ($status == 'block') {
                $customer->status = 2;
                $request->session()->flash('message', 'Successfully customer blocked!');
                $request->session()->flash('alert-type', 'success');
            }
            $customer->save();
        } else {
            $request->session()->flash('message', 'Something went wrong!');
            $request->session()->flash('alert-type', 'error');
            
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $customer = User::find($id);
        if ($customer) {
            $customer->delete();
            $request->session()->flash('message', 'Successfully customer deleted!');
            $request->session()->flash('alert-type', 'success');
        } else {
            $request->session()->flash('message', 'Something went wrong!');
            $request->session()->flash('alert-type', 'error');
            
        }
        return redirect()->back();
    }
}
