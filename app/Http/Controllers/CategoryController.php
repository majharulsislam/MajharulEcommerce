<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Image;
use File;
use DB;

class CategoryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('admin.pages.categories.managecategory')->with('categories',$categories);
    }

    public function create()
    {
       $parent_categories = Category::orderBy('title','desc')->where('parent_id', 0)->get();
       return view('admin.pages.categories.create',compact('parent_categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
                'title' => 'required',
                'image' => 'required|image',
            ],
            [
                'title.required' => 'Please write your category name',
                'image.required' => 'Please provide a valid image.such as jpg,jpeg,png,gif etc'
            ]
        );

        // image validate
        if($request->hasFile('image')){

            $images = $request->file('image');
            $img = time().'.'.$images->getClientOriginalExtension();
            $destination = public_path('images/categories/'.$img);
            Image::make($images)->resize(300, 300)->save($destination);
        }

        $category_store = new Category;
        $category_store->title = $request->title;
        $category_store->slug = Str::of($request->title)->slug('-');;
        $category_store->description = $request->description;
        $category_store->parent_id = $request->parent_id;
        $category_store->image = $img;
        $category_store->save();

        $notification = array('messege'=>'Category add successfully','alert-type'=>'success');
        return redirect()->route('admin.managecategory')->with($notification);

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $editcate = Category::find($id);
        $parent_categories = Category::orderBy('title','desc')->where('parent_id', 0)->get();
        return view('admin.pages.categories.edit',compact('editcate','parent_categories'));
    }

    
    public function update(Request $request, $id)
    {
        $category_store = Category::find($id);
        $category_store->title = $request->title;
        $category_store->slug = Str::of($request->title)->slug('-');
        $category_store->description = $request->description;
        $category_store->parent_id = $request->parent_id;
        // image validate
        if($request->hasFile('image')){

            if(File::exists('images/categories/'.$category_store->image)){
                File::delete('images/categories/'.$category_store->image);
            }

            $images = $request->file('image');
            $img = time().'.'.$images->getClientOriginalExtension();
            $destination = public_path('images/categories/'.$img);
            Image::make($images)->resize(300, 300)->save($destination);

            $category_store->image = $img;
        }
        $category_store->save();

        $notification = array('messege'=>'Category has updated successfully','alert-type'=>'success');
        return redirect()->route('admin.managecategory')->with($notification);
    }

    
    public function destroy($id)
    {
        $deletecategory = Category::find($id);
        
        if(!is_null($deletecategory)){

            if($deletecategory->parent_id == NULL){
                $subcategory = Category::orderBy('title','desc')->where('parent_id',NULL)->get();
                foreach ($subcategory as $sub){

                    if(File::exists('images/categories/'.$sub->image)){
                        File::delete('images/categories/'.$sub->image);
                    }
                    $sub->delete();
                }
            }

            if(File::exists('images/categories/'.$deletecategory->image)){
                File::delete('images/categories/'.$deletecategory->image);
            }

            $deletecategory->delete();
        }
        $notify = array('messege' => 'Category Deleted Successfully!','alert-type' => 'success');
        return back()->with($notify);
    }
}
