<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\CustomPages;

class PagesController extends Controller
{
    /**
     * Show single product
     * Single product by slug
     */
    public function singleProduct($slug){
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            $similarProducts = Product::orderBy('id', 'desc')->limit(4)->get();
            return view('frontend.pages.single-product', compact('product', 'similarProducts'));
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect()->route('home')->with($notification);
        }
    }

    /**
     * Show brand product
     * brand product by brand id
     */
    public function categoryProduct($name){
        $categoryName = Category::where('name', $name)->first();
        //check category
        if (!is_null($categoryName)) {
            //if brand not null
            $products = Product::where('category_id', $categoryName->id)->orderBy('id', 'desc')->paginate(24);
            //check products by category
            if (count($products) > 0) {
                //if here has products
                return view('frontend.pages.category-product', compact('products', 'categoryName'));
            } else {
                //if here has no products
                $notification = [
                    'message' => 'No products in the category!',
                    'alert-type' => 'info',
                ];
                return redirect()->route('home')->with($notification);
            }
        } else {
            //if brand is null
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect()->route('home')->with($notification);
        }
    }

    /**
     * Show brand product
     * brand product by brand id
     */
    public function brandProduct($name){
        $brandName = Brand::where('name', $name)->first();
        //check brand
        if (!is_null($brandName)) {
            //if brand not null
            $products = Product::where('brand_id', $brandName->id)->orderBy('id', 'desc')->paginate(24);
            //check products by brand
            if (count($products) > 0) {
                //if here has products
                return view('frontend.pages.brand-product', compact('products', 'brandName'));
            } else {
                //if here has no products
                $notification = [
                    'message' => 'No products in the brand!',
                    'alert-type' => 'info',
                ];
                return redirect()->route('home')->with($notification);
            }
        } else {
            //if brand is null
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect()->route('home')->with($notification);
        }
    }

    /*
	 * Search a product by search tag
    */
    public function searchProduct(Request $request){
    	$validateData = $request->validate([
    		'search' => 'required|min:1'
    	]);
    	$search = $request->search;
    	$products = Product::orWhere('title', 'like', '%'.$search.'%')
    				->orWhere('description', 'like', '%'.$search.'%')
    				->orWhere('slug', 'like', '%'.$search.'%')
    				->orWhere('price', 'like', '%'.$search.'%')
    				->orderBy('id', 'desc')->paginate(24);
    	if (count($products) > 0) {
    		return view('frontend.pages.search-product', compact('search', 'products'));
    	} else {
    		$notification = [
    			'message' => 'No found!',
    			'alert-type' => 'info'
    		];
    		return redirect()->route('home')->with($notification);
    	}
    	
    }

    public function customPageShow($slug)
    {
        $custom_page = CustomPages::where('slug', $slug)->get()->first();
        if ($custom_page) {
            return view('frontend.pages.custom_page', ['custom_page' => $custom_page]);
        } else {
            $notification = [
                'message' => 'Something went wrong!',
                'alert-type' => 'error',
            ];
            return redirect()->back()->with($notification);
        }
    }
}
