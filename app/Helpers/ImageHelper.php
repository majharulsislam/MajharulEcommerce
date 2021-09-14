<?php
namespace App\Helpers;

use App\Models\User;
use App\Helpers\GravatarHelper;

Class ImageHelper
{

	public static function getUserImage($id){

		$user = User::find($id);
		$avatar_url = "";

		if(!is_null($user)){
			if($user->avatar == NULL){
				if(GravatarHelper::validate_gravatar($user->email)){
					$avatar_url = GravatarHelper::gravatar_image($user->email, 80);
				}
				else{
					// when there is no gravatar image
					$avatar_url = url('images/defaults/user.png');
				}
			}
			else{
				// return that image
				$avatar_url = url('images/defaults/'.$user->avatar);
			}
		}
		else{
			//return redirect('/');
		}

		return $avatar_url;
	}

}