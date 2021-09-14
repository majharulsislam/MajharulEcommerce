<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Slider;
use DB;

class PagesController extends Controller
{
    
// home page
    public function index(){
        $sliders = Slider::orderBy('priority', 'asc')->get();
        $products = Product::orderBy('id','desc')->simplePaginate(3);
        return view('pages.index',compact('products', 'sliders'));
    }


// all product
    public function products(){    
        $products = Product::orderBy('id','desc')->simplePaginate(3);
        return view('pages.products.index')->with('products',$products);
    }


// Show single product
    public function show($slug){

        $products = Product::where('slug',$slug)->first();

        if (!is_null($products)){
            return view('pages.products.show',compact('products'));
        }
        else{

            $notify = array('messege'=> 'Sorry !! There is no product by this URL.','alert-type'=> 'warning');

            return redirect()->route('products')->with($notify);
        }
    }


// Show category base product and single product
    public function showcategory($id){

        $category = Category::find($id);
        if(!is_null($category)){
            return view('pages.products.categories.show',compact('category'));
        }
        else{
            return redirect('/');
        }
    }


// Search Product
    public function search(Request $request){

        $search = $request->searching;

        $products = Product::orWhere('title','like', '%'.$search.'%')
        ->orWhere('description','like', '%'.$search.'%')
        ->orWhere('pricee','like', '%'.$search.'%')
        ->orWhere('quantity','like', '%'.$search.'%')
        ->orderBy('id','desc')
        ->simplePaginate(10);

        return view('pages.products.search',compact('search','products'));
    }


}

