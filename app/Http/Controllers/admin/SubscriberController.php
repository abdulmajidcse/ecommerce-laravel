<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscriber;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::orderBy('id', 'desc')->paginate(30);
        return view('admin.subscribers.allSubscriber', ['subscribers' => $subscribers]);
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
            'subscriber_email' => 'required|unique:subscribers,email|max:255',
        ]);

        $subscriber = new Subscriber();
        $subscriber->email = $request->subscriber_email;
        $subscriber->save();
        $notification = [
            'message' => 'Congratulations! You added as a subscriber. Now you get update in your email.',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber = Subscriber::find($id);
        if (empty($subscriber)) {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
        } else {
            $subscriber->delete();
            $notification = [
                'message' => 'Successfully subscriber deleted!',
                'alert-type' => 'success',
            ];
        }
        return redirect()->back()->with($notification);
    }
}
