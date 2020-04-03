<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Brand;
use App\ProductImage;
use App\Subscriber;
use Auth;
use App\Notifications\SubscriberNotification;
use Notification;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('title', 'asc')->paginate(30);
        return view('admin.pages.products.all-product', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_category = Category::orderBy('name', 'asc')->where('parent_id', NULL)->get();

        $brand = Brand::orderBy('name', 'asc')->get();
        return view('admin.pages.products.add-product', compact('parent_category', 'brand'));
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
            'title' => 'required|max:100',
            'short_details' => 'required',
            'full_details' => 'required',
            'category_id' => 'required|min:1',
            'brand_id' => 'required|min:1',
            'slug' => 'required|unique:products|min:1|max:100',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'offer_price' => 'nullable|numeric|min:1',
            'image.*' => 'mimes:jpg,jpeg,png|max:4000',
        ]);

        $product = new Product();

        $product->admin_id = Auth::user()->id;
        $product->title = $request->title;
        $product->short_details = $request->short_details;
        $product->full_details = $request->full_details;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->slug = $request->slug;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->save();

        //multiple image image
        if (!is_null($request->image)) {
            foreach ($request->file('image') as $image) {

                $extension = $image->extension();
                $image_name = uniqid() . "." . $extension;
                $upload_path = 'images/product-images/';
                $image_url = $upload_path . $image_name;

                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                $product_image->name = $image_url;
                $product_image->save();

                //image upload on folder
                $image->move($upload_path, $image_name);
            }
        }
        //sent a mail to subscriber for notify
        if (Subscriber::count() > 0) {
            $subscribers = Subscriber::all();
            Notification::send($subscribers, new SubscriberNotification($product->slug));
        }

        //confirm message
        $notification = [
            'message' => 'Successfully product added and send mail to subscriber for new product!',
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
        $product = Product::find($id);
        if (!is_null($product)) {
            $parent_category = Category::orderBy('name', 'asc')->where('parent_id', NULL)->get();

            $brand = Brand::orderBy('name', 'asc')->get();
            return view('admin.pages.products.edit-product', compact('product', 'parent_category', 'brand'));
        } else {
            //confirm message
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
            'title' => 'required|max:50',
            'short_details' => 'required',
            'full_details' => 'required',
            'category_id' => 'required|min:1',
            'brand_id' => 'required|min:1',
            'slug' => 'required|min:1|max:50',
            'quantity' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'offer_price' => 'nullable|numeric|min:1',
            'image.*' => 'mimes:jpg,jpeg,png|max:4000',
        ]);

        $product = Product::find($id);

        $product->admin_id = Auth::user()->id;
        $product->title = $request->title;
        $product->short_details = $request->short_details;
        $product->full_details = $request->full_details;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->slug = $request->slug;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->offer_price = $request->offer_price;
        $product->save();

        //old images delete
        if ($request->image_del_check == "on") {
            //product image delete
            if (!is_null($product->productImages)) {
                foreach ($product->productImages as $image) {
                    if (file_exists($image->name)) {
                        unlink($image->name);
                    }
                    $image->delete();
                }
            }
        }

        //multiple image image
        if (!is_null($request->image)) {
            foreach ($request->file('image') as $image) {

                $extension = $image->extension();
                $image_name = uniqid() . "." . $extension;
                $upload_path = 'images/product-images/';
                $image_url = $upload_path . $image_name;

                $product_image = new ProductImage();
                $product_image->product_id = $product->id;
                $product_image->name = $image_url;
                $product_image->save();

                //image upload on folder
                $image->move($upload_path, $image_name);
            }
        }

        //confirm message
        $notification = [
            'message' => 'Successfully product saved!',
            'alert-type' => 'success',
        ];

        return redirect()->to('/admin/products')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!is_null($product)) {
            //product image delete
            if ($product->productImages) {
                foreach ($product->productImages as $image) {
                    if (file_exists($image->name)) {
                        unlink($image->name);
                    }
                    $image->delete();
                }
            }
            //product delete
            $product->delete();

            $notification = [
                'message' => 'Successfully product deleted!',
                'alert-type' => 'success',
            ];
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
        }

        return redirect()->to('/admin/products')->with($notification);

    }
}
