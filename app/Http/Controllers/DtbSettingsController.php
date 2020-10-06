<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbUser;
use App\MtbLanguage;
use App\DtbSetting;
use Storage;
use File;
use App\DtbActivityLog;

class DtbSettingsController extends Controller
{
    public function profileUpdate(){
        if (!Session()->has('user_id')) {
            return redirect('login');
        }

        $common_array = array(
            'content_heading' => 'Update Profile'
        );
    	$user_id = Session::get('user_id');
    	$editData = DtbUser::where('id', $user_id)->first();
    	$languages = MtbLanguage::all();
    	
    	return view('settings.users.profileUpdate', compact('editData', 'languages', 'common_array'));
    }

    public function profileGeneral(Request $request){
        $request->validate([
            'name'=>'required',
            'email' => 'required'          
        ]);

        $user_id= $request->user_id;
        $cloud_front_path = "";
        $userImageFile = "";
        if ($request->hasFile('userImage')) {
            $url = 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
            $cloud_front_path = env('AWS_URL') . '/';
            $userImageFile = Storage::disk('s3')->put('users', $request->userImage);
        }
        else{
            $user = DtbUser::find($user_id);
            $userImageFile = $user->icon_image_path;
        }

        $user = DtbUser::find($user_id);
        $user->name = $request->name;
        $user->english_name = $request->english_name;
        $user->email = $request->email;
        $user->icon_image_path = $cloud_front_path.$userImageFile;
        $result = $user->update();
        if($result){
          DtbActivityLog::updateActivityLog('updated', 'general profile');
          $user_id = Session::get('user_id');
          $usersData = DtbUser::find($user_id);
          Session::put('users_name', $usersData->name);
          Session::put('users_image', $usersData->icon_image_path);
          return redirect('/profile-update')->with('message-success', 'Info updated successfully');
      }
      else{
        return redirect('/profile-update')->with('message-danger', 'Something went wrong');
    }
}

public function profilePassword(Request $request){
    $profileData = DtbSetting::profilePassword($request);
    DtbActivityLog::updateActivityLog('updated', 'user password');
    return $profileData;
}

public function profileInfo(Request $request){
    $profileInfo = DtbSetting::profileInfo($request);
    DtbActivityLog::updateActivityLog('updated', 'user profile info');
    return $profileInfo;
}

public function profileLinks(Request $request){
    $profileLinks = DtbSetting::profileLinks($request);
    DtbActivityLog::updateActivityLog('updated', 'user profile links');
    return $profileLinks;
}


}
