<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select data from district table
        $sliders = Slider::orderBy('priority', 'asc')->get();
        return view('admin.pages.sliders.all_slider', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.sliders.add_slider');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);
        //check for empty data
        if ($slider) {
            return view('admin.pages.districts.edit_slider', compact('slider'));
        } else {
            //if here has no slider, redirect
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
            return redirect()->back()->with($notification);
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
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete slider by id
        $slider = Slider::find($id);
        //check for empty data
        if ($slider) {
            //if here has a slider, delete slider
            $slider->delete();
            $notification = [
                'message' => 'Successfully slider deleted!',
                'alert-type' => 'success'
            ];
        } else {
            //if here has no slider, redirect
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
        }

        return redirect()->back()->with($notification);
    }
}
