<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Slider;
use Image;
use File;
use DB;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){ 
        $sliders = Slider::orderBy('priority','asc')->get();
        return view('admin.pages.slider.index', compact('sliders'));
    }

    public function store(Request $request){ 
        $validated = $request->validate([
                'slider_title' => 'required',
                'slider_priority' => 'required',
            ],
            [
                'slider_title.required' => 'Please write your slider title',
                'slider_priority.required' => 'Please provide a priority status',
            ]
        );

        if($request->hasFile('slider_image')){
            $images = $request->file('slider_image');
            $img = time().'.'.$images->getClientOriginalExtension();
            $destination = public_path('images/slider/'.$img);
            Image::make($images)->resize(1100, 550)->save($destination);

        }

        $slider = new Slider;
        $slider->title = $request->slider_title;
        $slider->sub_title = $request->slider_subtitle;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->slider_priority;
        $slider->image = $img;
        $slider->save();

        $notify = array('messege' => 'New Slider added successfully !!', 'alert-type' => 'success');
        return redirect()->route('admin.slider.index')->with($notify);

    }

    public function update(Request $request, $id){

        $slider = Slider::find($id);

        if($request->hasFile('slider_image')){

            if(File::exists('images/slider/'.$slider->image)){
                File::delete('images/slider/'.$slider->image);                    
            }

            $images = $request->file('slider_image');
            $img = time().'.'.$images->getClientOriginalExtension();
            $destination = public_path('images/slider/'.$img);
            Image::make($images)->resize(800, 400)->save($destination);

            $slider->image = $img;
        }

        $slider->title = $request->slider_title;
        $slider->sub_title = $request->slider_subtitle;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->slider_priority;
        $slider->save();

        $notify = array('messege' => 'Slider Update Successfully !!', 'alert-type' => 'success');
        return redirect()->route('admin.slider.index')->with($notify);
    }


    public function destroy($id){

        $slider = Slider::find($id);

        // Image delete
        if(File::exists('images/slider/'.$slider->image)){
            File::delete('images/slider/'.$slider->image);
        }

        if(!is_null($slider)){
            $slider->delete();
        }

        $notify = array('messege' => 'Slider delete successfully !!', 'alert-type' => 'success');
        return back()->with($notify);
    }


}
