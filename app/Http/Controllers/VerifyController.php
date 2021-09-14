<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class VerifyController extends Controller
{
    
    public function verify($token){

        $user = User::where('remember_token', $token)->first();
        if(!is_null($user)){
            $user->status = 1;
            $user->remember_token = NULL;
            $user->save();
            $message = array('messege' => 'Now your accout active', 'alert-type' => 'success');
            return redirect('login')->with($message);
        }

        else{
            $message = array('messege' => 'Sorry ! Your token not matched.', 'alert-type' => 'error');

            return redirect('/')->with($message);
        }
        

    }

}
