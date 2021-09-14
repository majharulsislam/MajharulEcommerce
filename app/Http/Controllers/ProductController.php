<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use Image;
use DB;

class ProductController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        // code here
    }

    
    public function manageproduct()
    {
        $productsall = Product::orderBy('id','desc')->get();
        return view('admin.pages.product.manageproduct',compact('productsall'));
    } 

    public function create()
    {
        return view('admin.pages.product.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:55',
            'desc'  => 'required',
            'quantity'  => 'required|numeric',
            'price'     => 'required|numeric',
            'brand_id'     => 'required|numeric',
            'category_id'     => 'required|numeric',
        ]);

    //--> Eloquent ORM Product Model

        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->desc;
        $product->slug = Str::slug($request->title, '-');
        $product->quantity = $request->quantity;
        $product->pricee = $request->price;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;
        $product->save();

    //--> Product Image Model

        if($request->hasFile('product_image')){
            $image = $request->file('product_image');
            $img = time().'.'.$image->getClientOriginalExtension();
            $destination = public_path('images/products/'.$img);
            Image::make($image)->resize(300, 300)->save($destination);

            $product_image = new ProductImage;
            $product_image->name = $img;
            $product_image->product_id = $product->id;
            $product_image->save();
        }


       $notification = array('messege'=> 'Product inserted successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.pages.product.edit')->with('product',$product);
    }

    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:55',
            'desc'  => 'required',
            'quantity'  => 'required',
            'price'     => 'required',
        ]);

    //--> Eloquent ORM Product Model

        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->desc;
        $product->slug = Str::slug($request->title, '-');
        $product->quantity = $request->quantity;
        $product->pricee = $request->price;
        $product->save();

        $notify =  array('messege'=> 'Product Update Successfully!','alert-type'=> 'success');
        return redirect()->back()->with($notify);
    }

    
    public function destroy($id)
    {
        $product = Product::find($id);
        if(!is_null($product)){
            $product->delete();
        }

        foreach($product->ProductImages as $img) {
            $filename = $img->name;

            if(file_exists('images/products/'.$filename)){
                unlink('images/products/'.$filename);
            }
            $img->delete();
        }


        $notify = array('messege'=> 'Product Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notify);
    }
}
