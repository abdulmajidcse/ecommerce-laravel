<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CustomPages;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $custom_pages = CustomPages::orderBy('id', 'desc')->get();
        return view('admin.custom_pages.all_custom_page', ['custom_pages' => $custom_pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.custom_pages.add_custom_page');
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
            'name' => 'required|string|max:255|unique:custom_pages',
            'slug' => 'required|string|max:100|unique:custom_pages',
            'type' => 'required|numeric|min:1|max:2',
            'image' => 'mimes:png,jpg,jpeg|max:4000',
            'content' => 'required',
        ]);

        $custom_page = new CustomPages();
        $custom_page->name = $request->name;
        $custom_page->slug = $request->slug;
        $custom_page->type = $request->type;
        
        //if image valid, go to upload image and store settings
        $image = $request->file('image');
        if ($image) {
            $extension = $request->image->extension();
            $image_name = time() . "." . $extension;
            $upload_path = 'images/page-images/';
            $image_url = $upload_path . $image_name;

            $custom_page->image = $image_url;

            //image upload on folder
            $image->move($upload_path, $image_name);
        }
        $custom_page->content = $request->content;
        $custom_page->save();

        $notification = [
            'message' => 'Successfully page added!',
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
        $custom_page = CustomPages::find($id);
        if ($custom_page) {
            return view('admin.custom_pages.view_custom_page', compact('custom_page'));
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $custom_page = CustomPages::find($id);
        if ($custom_page) {
            return view('admin.custom_pages.edit_custom_page', compact('custom_page'));
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:custom_pages,name,'.$id,
            'slug' => 'required|string|max:100|unique:custom_pages,slug,'.$id,
            'type' => 'required|numeric|min:1|max:2',
            'image' => 'mimes:png,jpg,jpeg|max:4000',
            'content' => 'required',
        ]);

        $custom_page = CustomPages::find($id);
        $custom_page->name = $request->name;
        $custom_page->slug = $request->slug;
        $custom_page->type = $request->type;
        
        //if image valid, go to upload image and store settings
        $image = $request->file('image');
        if ($image) {
            if (file_exists($custom_page->image)) {
                unlink($custom_page->image);
            }
            $extension = $request->image->extension();
            $image_name = time() . "." . $extension;
            $upload_path = 'images/page-images/';
            $image_url = $upload_path . $image_name;

            $custom_page->image = $image_url;

            //image upload on folder
            $image->move($upload_path, $image_name);
        }
        $custom_page->content = $request->content;
        $custom_page->save();

        $notification = [
            'message' => 'Successfully page saved!',
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
        $custom_page = CustomPages::find($id);
        if ($custom_page) {
            if (file_exists($custom_page->image)) {
                unlink($custom_page->image);
            }
            $custom_page->delete();
            $notification = [
                'message' => 'Successfully custom page deleted!',
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
