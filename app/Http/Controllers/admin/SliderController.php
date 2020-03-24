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
        return view('admin.pages.sliders.allSlider', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.sliders.addSlider');
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
            'image' => 'required|mimes:jpg,jpeg,png|max:4000',
            'priority' => 'required|numeric|unique:sliders|min:1|max:20',
        ]);
        $slider = new Slider();

        $image = $request->file('image');

        $extension = $request->image->extension();
        $image_name = time() . "." . $extension;
        $upload_path = 'images/slider-images/';
        $image_url = $upload_path . $image_name;

        //slider table store
        $slider->image = $image_url;
        $slider->priority = $request->priority;
        $slider->save();

        //image upload on folder
        $image->move($upload_path, $image_name);

        //confirm message
        $notification = [
            'message' => 'Successfully slider added!',
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
        //delete slider by id
        $slider = Slider::find($id);
        //check for empty data
        if ($slider) {
            //if here has a slider, delete slider
            $image = $slider->image;
            if (file_exists($image)) {
                unlink($image);
            }
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
