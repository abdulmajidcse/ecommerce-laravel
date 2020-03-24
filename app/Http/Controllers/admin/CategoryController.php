<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::orderBy('name', 'asc')->get();

        return view('admin.pages.categories.all-category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('id', 'desc')->get();
        return view('admin.pages.categories.add-category', compact('category'));
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

       $category = new Category();

       $data = array();

       $data['name'] = $request->name;
       $data['description'] = $request->description;
       $data['parent_id'] = $request->parent_id;
       $image = $request->file('image');

       /**
        * if image valid, go to upload image and store category
        */
       if ($image) {
            $extension = $request->image->extension();
            $image_name = time() . "." . $extension;
            $upload_path = 'images/category-images/';
            $image_url = $upload_path . $image_name;

            //category table store
            $category->name = $data['name'];
            $category->description = $data['description'];
            $category->image = $image_url;
            $category->parent_id = $data['parent_id'];
            $category->save();

            //image upload on folder
            $image->move($upload_path, $image_name);

            //confirm message
            $notification = [
                'message' => 'Successfully category added!',
                'alert-type' => 'success',
            ];
        } else {
            //category table store
            $category->name = $data['name'];
            $category->description = $data['description'];
            $category->parent_id = $data['parent_id'];
            $category->save();
            //confirm message
            $notification = [
                'message' => 'Successfully category added!',
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
        $category = Category::find($id);
        if (!is_null($category)) {
            $all_category = Category::where('id', '!=', $id)->orderBy('name', 'asc')->get();
            return view('admin.pages.categories.edit-category', compact('category', 'all_category'));
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect('/admin/categories/')->with($notification);
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

       $category = Category::find($id);

       $data = array();

       $data['name'] = $request->name;
       $data['description'] = $request->description;
       $data['parent_id'] = $request->parent_id;
       $image = $request->file('image');

       /**
        * if image valid, go to upload image and store category
        */
       if ($image) {
            //old image
            $old_image = $category->image;
            if (!is_null($old_image)) {
                if (file_exists($old_image)) {
                    unlink($old_image);
                }
            }
            $extension = $request->image->extension();
            $image_name = time() . "." . $extension;
            $upload_path = 'images/category-images/';
            $image_url = $upload_path . $image_name;

            //category table store
            $category->name = $data['name'];
            $category->description = $data['description'];
            $category->image = $image_url;
            $category->parent_id = $data['parent_id'];
            $category->save();

            //image upload on folder
            $image->move($upload_path, $image_name);

            //confirm message
            $notification = [
                'message' => 'Successfully category saved!',
                'alert-type' => 'success',
            ];
        } else {
            //category table store
            $category->name = $data['name'];
            $category->description = $data['description'];
            $category->parent_id = $data['parent_id'];
            $category->save();
            //confirm message
            $notification = [
                'message' => 'Successfully category saved!',
                'alert-type' => 'success',
            ];
        }

       return redirect()->to('/admin/categories/')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            if ($category->parent_id == NULL) {
                //delete sub category
                $sub_category = Category::where('parent_id', $category->id)->get();
                if (!is_null($sub_category)) {
                    foreach ($sub_category as $sub) {
                        if (!is_null($sub->image)) {
                            if (file_exists($sub->image)) {
                                unlink($sub->image);
                            }
                        }
                        $sub->delete();
                    }
                }
            }
            $image = $category->image;
            if (!is_null($image)) {
                if (file_exists($image)) {
                    unlink($image);
                }
            }
            $category->delete();
            $notification = [
                'message' => 'Successfully category deleted!',
                'alert-type' => 'success'
            ];
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error'
            ];
        }
        return redirect()->to('/admin/categories/')->with($notification);
    }
}
