<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Division;
use App\Models\District;
use DB;

class DivisionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){ 
        $divisions = Division::orderBy('priority','asc')->get();
        return view('admin.pages.division.index')->with('divisions',$divisions);
    }

    public function create(){ 
        return view('admin.pages.division.create');
    }

    public function store(Request $request){ 
        $validated = $request->validate([
                'name' => 'required',
                'priority' => 'required',
            ],
            [
                'name.required' => 'Please write your division name',
                'priority.required' => 'Please provide a priority status',
            ]
        );

        $division = new Division;
        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();

        $notify = array('messege' => 'New division added successfully !!', 'alert-type' => 'success');
        return redirect()->route('admin.managedivision')->with($notify);

    }

    public function edit($id){
        $division = Division::find($id);
        if(!is_null($division)){
            return view('admin.pages.division.edit', compact('division'));
        }
        else{
            return redirect()->route('admin.managedivision');
        }
    }

    public function update(Request $request, $id){
        $validate = $request->validate([
                'name' => 'required',
                'priority' => 'required',
            ],
            [
                'name.required' => 'Please write your division name',
                'priority.required' => 'Please provide a priority status',
            ]
        );


        $division = Division::find($id);
        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();

        $notify = array('messege' => 'Division updated successfully !!', 'alert-type' => 'success');
        return redirect()->route('admin.managedivision')->with($notify);
    }


    public function destroy($id){

        $division = Division::find($id);

        if(!is_null($division)){

            $districts = District::where('division_id',$division->id)->get();
            foreach($districts as $district){
                $district->delete();
            }
            
            $division->delete();
        }

        $notify = array('messege' => 'Division delete successfully !!', 'alert-type' => 'success');
        return back()->with($notify);
    }


}
