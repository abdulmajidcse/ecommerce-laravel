<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Slider;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $sliders = Slider::orderBy('priority', 'asc')->get();
        $products = Product::orderBy('id', 'desc')->limit(8)->get();
        return view('frontend.home', compact('products', 'sliders'));
    }
}
