<?php

namespace App\Model;

use Sifoni\Model\Base;

class User extends Base {
	public $timestamps=false;

	public static function checkLogin($email, $password){
		$user = User::where('email', $email)->first();
        
        if ($user && $user['password'] == md5($password)) {
            unset($user['password']);
            return $user;
        }
        return false;
	}

	public static function register($postData){
		$user = User::where('email', $postData['email'])->first();
		if($user)
			return false;
		else{
			$postData['password'] = md5($postData['password']);
			unset($postData['retype']);
			$newUser=new User;
			foreach ($postData as $key => $value) {
				$newUser->$key=$value;
			}
			$newUser->save();
			unset($newUser['password']);
			return $newUser;
		}
		return false;
	}
}