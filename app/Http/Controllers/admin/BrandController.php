<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = Brand::orderBy('name', 'asc')->get();

        return view('admin.pages.brands.all-brand', compact('brand'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.brands.add-brand');
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
            'name' => 'required|unique:categories|max:20',
            'description' => 'max:50',
            'image' => 'mimes:jpg,jpeg,png|max:4000',
        ]);

       $brand = new Brand();

       $data = array();

       $data['name'] = $request->name;
       $data['description'] = $request->description;
       $image = $request->file('image');

       /**
        * if image valid, go to upload image and store category
        */
       if ($image) {
            $extension = $request->image->extension();
            $image_name = time() . "." . $extension;
            $upload_path = 'images/brand-images/';
            $image_url = $upload_path . $image_name;

            //category table store
            $brand->name = $data['name'];
            $brand->description = $data['description'];
            $brand->image = $image_url;
            $brand->save();

            //image upload on folder
            $image->move($upload_path, $image_name);

            //confirm message
            $notification = [
                'message' => 'Successfully brand added!',
                'alert-type' => 'success',
            ];
        } else {
            //category table store
            $brand->name = $data['name'];
            $brand->description = $data['description'];
            $brand->save();
            //confirm message
            $notification = [
                'message' => 'Successfully brand added!',
                'alert-type' => 'success',
            ];
        }

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
        $brand = Brand::find($id);
        if (!is_null($brand)) {
            return view('admin.pages.brands.edit-brand', compact('brand'));
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect('/admin/brands')->with($notification);
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
            'name' => 'required|max:20',
            'description' => 'max:50',
            'image' => 'mimes:jpg,jpeg,png|max:4000',
        ]);

       $brand = Brand::find($id);

       $data = array();

       $data['name'] = $request->name;
       $data['description'] = $request->description;
       $image = $request->file('image');

       /**
        * if image valid, go to upload image and store category
        */
       if ($image) {
            //old image
            $old_image = $brand->image;
            if (!is_null($old_image)) {
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $extension = $request->image->extension();
            $image_name = time() . "." . $extension;
            $upload_path = 'images/brand-images/';
            $image_url = $upload_path . $image_name;

            //category table store
            $brand->name = $data['name'];
            $brand->description = $data['description'];
            $brand->image = $image_url;
            $brand->save();

            //image upload on folder
            $image->move($upload_path, $image_name);

            //confirm message
            $notification = [
                'message' => 'Successfully brand saved!',
                'alert-type' => 'success',
            ];
        } else {
            //category table store
            $brand->name = $data['name'];
            $brand->description = $data['description'];
            $brand->save();
            //confirm message
            $notification = [
                'message' => 'Successfully brand saved!',
                'alert-type' => 'success',
            ];
        }

       return redirect()->to('/admin/brands')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if (!is_null($brand)) {
            $image = $brand->image;
            if (!is_null($image)) {
                if (file_exists($image)) {
                    unlink($image);
                }
            }
            $brand->delete();
            $notification = [
                'message' => 'Successfully brand deleted!',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
        }
        return redirect()->to('/admin/brands')->with($notification);
    }
}
