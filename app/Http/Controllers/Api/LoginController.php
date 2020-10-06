<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\DtbUser;
//use App\Model\DtbUserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DateTime;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $response['success'] = 1;
       // $response['access_token'] = '';

        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:dtb_users,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $response['message'] = 'The given data was invalid';
            $response['errors'] = $validator->errors();

            return response()->json($response);
        }
        else{

            $user = DtbUser::where('email', $request->email)->first();

            if($user) {
                if($user->password == md5($request->password) ) {
                //if success
                    $response = [
                        'success' => 0,
                        'message' => 'Success',


                    ];
                    
                } else {
                  

            $response['message'] = 'Invalid Password';
              }
          } else {
 

            $response['message'] = 'User not found';
        }

        return response()->json($response);
    }



}

}
