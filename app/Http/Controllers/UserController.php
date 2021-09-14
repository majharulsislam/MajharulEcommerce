<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use Auth;

class UserController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard() {
        $user = Auth::user();
        return view('pages.user.dashboard',compact('user'));
    }


    public function profile() {

        $user = Auth::user();
        $divisions = Division::orderBy('priority','asc')->get();
        $districts = District::orderBy('name','asc')->get();
        return view('pages.user.profile', compact('user', 'divisions', 'districts'));
    }


    public function profileUpdate(Request $request) {

       $user = Auth::user();

       $this->validate($request, [
            'first_name' => 'required|string|max:30',
            'last_name' => 'nullable|string|max:15',
            'username' => 'required|alpha_dash|max:100|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:100|unique:users,email,'.$user->id,
            'phone_no' => 'required|string|max:11',
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'street_address' => 'required|string|max:100',
            'shipping_address' => 'nullable|string|max:100',
        ]);

       $user->first_name = $request->first_name;
       $user->last_name = $request->last_name;
       $user->username = $request->username;
       $user->email = $request->email;
       $user->phone_no = $request->phone_no;
       $user->division_id = $request->division_id;
       $user->district_id = $request->district_id;
       $user->street_address = $request->street_address;
       $user->shipping_address = $request->shipping_address;
       $user->ip_address = $request->ip();
       if($request->password != NULL || $request->password != ""){
            $user->password = Hash::make($request->password);
       }
       $user->save();

       $notify = array('messege' => 'Your Profile Updated Successfully!!', 'alert-type' => 'success');

       return redirect()->route('user.dashboard')->with($notify);


    }

}
