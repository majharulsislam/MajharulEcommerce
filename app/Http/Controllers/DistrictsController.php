<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\District;
use App\Models\Division;
use DB;

class DistrictsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){ 
        $districts = District::orderBy('name','asc')->get();
        return view('admin.pages.district.index', compact('districts'));
    }

    public function create(){ 
        return view('admin.pages.district.create');
    }

    public function store(Request $request){ 
        $validated = $request->validate([
                'name' => 'required',
                'division_id' => 'required',
            ],
            [
                'name.required' => 'Please write your district name',
                'division_id.required' => 'Please provide a division id',
            ]
        );

        $district = new District;
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->save();

        $notify = array('messege' => 'District added successfully !!', 'alert-type' => 'success');
        return redirect()->route('admin.managedistrict')->with($notify);

    }

    public function edit($id){
        $district = District::find($id);
        if(!is_null($district)){
            return view('admin.pages.district.edit', compact('district'));
        }
        else{
            return redirect()->route('admin.managedistrict');
        }
    }

    public function update(Request $request, $id){
        $validate = $request->validate([
                'name' => 'required',
                'division_id' => 'required',
            ],
            [
                'name.required' => 'Please write your district name',
                'division_id.required' => 'Please provide a division id',
            ]
        );


        $district = District::find($id);
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->save();

        $notify = array('messege' => 'Value updated successfully !!', 'alert-type' => 'success');
        return redirect()->route('admin.managedistrict')->with($notify);

    }


    public function destroy($id){

        $district = District::find($id);

        if(!is_null($district)){
            $district->delete();
        }

        $notify = array('messege' => 'District delete successfully !!', 'alert-type' => 'danger');
        return back()->with($notify);
    }
}
