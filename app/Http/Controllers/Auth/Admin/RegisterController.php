<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Notifications\VerifyRegistration;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        $divisions = Division::orderBy('priority','asc')->get();
        $districts = District::orderBy('name','asc')->get();
        return view('auth.register',compact('divisions','districts'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['nullable', 'string', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'phone_no' => ['required', 'string', 'max:11'],
            'division_id' => ['required', 'numeric', 'max:20'],
            'district_id' => ['required', 'numeric', 'max:20'],
            'street_address' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    
    protected function create(array $data)
    {
        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => Str::of($data['first_name'].$data['last_name'])->slug('-'),
            'email' => $data['email'],
            'phone_no' => $data['phone_no'],
            'division_id' => $data['division_id'],
            'district_id' => $data['district_id'],
            'street_address' => $data['street_address'],
            'ip_address' => request()->ip(),
            'status' => 0,
            'remember_token' => Str::random(50),
            'password' => Hash::make($data['password']),
        ]);


        $user->notify(new VerifyRegistration($user)); // ata dara notification pathano hcce

        $message = array('messege' => 'Confirmation sms sent to your email','alert-type' => 'success');

        return back()->with($message);

    }
}
