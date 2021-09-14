<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Brand;
use Image;
use File;
use DB;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $brands = Brand::orderBy('id','desc')->get();
        return view('admin.pages.brands.managebrands')->with('brands',$brands);
    }

    public function create()
    { 
        return view('admin.pages.brands.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
                'title' => 'required',
                'description' => 'required',
                'image' => 'required|image',
            ],
            [
                'title.required' => 'Please write your brand name',
                'description.required' => 'Please write your description',
                'image.required' => 'Please provide a valid image.such as jpg,jpeg,png,gif etc'
            ]
        );

        // image validate
        if($request->hasFile('image')){

            $images = $request->file('image');
            $img = time().'.'.$images->getClientOriginalExtension();
            $destination = public_path('images/brands/'.$img);
            Image::make($images)->resize(300, 300)->save($destination);
        }

        $brand_store = new Brand;
        $brand_store->title = $request->title;
        $brand_store->slug = Str::of($request->title)->slug('-');
        $brand_store->description = $request->description;
        $brand_store->image = $img;
        $brand_store->save();

        $notification = array('messege'=>'Brand add successfully','alert-type'=>'success');
        return redirect()->route('admin.managebrands')->with($notification);

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $editbrand = Brand::find($id);
        return view('admin.pages.brands.edit',compact('editbrand'));
    }

    
    public function update(Request $request, $id)
    {
        $brand_up = Brand::find($id);
        $brand_up->title = $request->title;
        $brand_up->slug = Str::of($request->title)->slug('-');
        $brand_up->description = $request->description;
        // image validate
        if($request->hasFile('image')){

            if(File::exists('images/brands/'.$brand_up->image)){
                File::delete('images/brands/'.$brand_up->image);
            }

            $images = $request->file('image');
            $img = time().'.'.$images->getClientOriginalExtension();
            $destination = public_path('images/brands/'.$img);
            Image::make($images)->resize(300, 300)->save($destination);

            $brand_up->image = $img;
        }
        $brand_up->save();

        $notification = array('messege'=>'Brand has updated successfully','alert-type'=>'success');
        return redirect()->route('admin.managebrands')->with($notification);
    }

    
    public function destroy($id)
    {
        $deltebrand = Brand::find($id);
        
        if(!is_null($deltebrand)){
            
            if(File::exists('images/brands/'.$deltebrand->image)){
                File::delete('images/brands/'.$deltebrand->image);
            }

            $deltebrand->delete();
        }
        $notify = array('messege' => 'Brand has deleted successfully!','alert-type' => 'success');
        return back()->with($notify);
    }

}
