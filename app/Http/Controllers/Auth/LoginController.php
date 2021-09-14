<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\User;
use App\Notifications\VerifyRegistration;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        $user = User::where('email', $request->email)->first();

        if(!is_null($user)){
            if($user->status == 1){
            // login user
                if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
                    return redirect()->intended(route('index'));
                }
                else{
                    $messages = array('messege' => 'Invalid username or password', 'alert-type' => 'info');
                    return back()->with($messages);
                }
            }
            else{
                $user->notify(new VerifyRegistration($user));

                $messages = array('messege' => 'Confimation code again sent your email', 'alert-type' => 'info');
                return redirect()->route('index')->with($messages);
                
            }
        }
        else{
            $messages = array('messege' => 'Please register your account', 'alert-type' => 'info');
            return back()->with($messages);
        }
        
    }




}
