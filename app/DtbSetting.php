<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbSetting extends Model
{
    public static function profilePassword($request){
    	$user = DtbUser::find($request->user_id);
    	$user->password = md5($request->password);
    	//$user->english_name = $_POST['english_name'];
    	$result = $user->update();
    	if($result){
    		echo "success";

    	}
    }

    public static function profileInfo($request){
    	$user = DtbUser::find($request->user_id);
    	$user->introduce = $request->introduce;
    	$user->country = $request->country;
    	$user->language_id = $request->language_id;
    	$result = $user->update();
    	if($result){
    		echo "success";

    	}
    }

    public static function profileLinks($request){
    	$user = DtbUser::find($request->user_id);
    	$user->url1 = $request->url1;
    	$user->url2 = $request->url2;
    	$user->url3 = $request->url3;
    	$user->url4 = $request->url4;
    	$result = $user->update();
    	if($result){
    		echo "success";

    	}
    }
}
