<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Redirect;
use App\DtbUser;
use Auth;
use Session;
use DB;
use Validator;
use App\VerifyUser;
use App\Mail\VerifyMail;
use App\DtbActivityLog;

class DtbLoginController extends Controller
{
    public function login()
    {
        return view('auth.logins');
    }

    public function checkLogin(Request $request) {

        $email = $request->email;
        $password = md5($request->password);
        $results = DtbUser::select('dtb_users.*')->where('email', '=', $email)
        ->where('password', '=', $password)
        ->where('verified', '=', '1')
        ->first();

        if(!empty($results)){
            Session::put('user_id', $results->id);
            //Session::put('developer_id', $results->developer_id);
            Session::put('email', $results->email);
            //Session::put('english_name', $results->english_name);
            //Session::put('country', $results->country);
            //Session::put('language_id', $results->language_id);
            Session::put('role', $results->role);

            // if(isset($results->developertimezone) && !empty($results->developertimezone)) {
            //     Session::put('developertimezone', $results->developertimezone);
            // }else{
            //     Session::put('developertimezone', 'UTC');
            // }
            
           // DtbActivityLog::updateActivityLog('logged in', 'application');
//             if ( substr($results->url1, 0, 1)=='/' ){
//                 return redirect($results->url1);
//             }
            return redirect('/home');
        }
        else{
            return redirect('/login')->with('message-danger', 'Incorrect Email or password');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function makeRegister(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'space_name'=>'required',
            'email'=>'required' ,
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);

        $results = DtbUser::select('*')->where('email', '=', $request->email)
        ->first();

        if(!empty($results)){
            return redirect('/register')->with('message-danger', 'Email Address already exists.');
        }
        else{
            $user = DtbUser::registration($request);
            \Mail::to($user->email)->send(new VerifyMail($user));
            return redirect('/register')->with('message-success', "We have sent a verification link to your given email address.Please Confirm it First.");
        }
    }

    public function verifyUser($token){
        $verifyUser = VerifyUser::where('token', $token)->first();
        if(isset($verifyUser) ){
            $user = $verifyUser->user;
            if(!$user->verified) {
              $verifyUser->user->verified = 1;
              $verifyUser->user->save();
              $status = "Your e-mail is verified. You can now login.";
              return redirect()->route('email_confirm', array('already' => 'y'));
          } else {
              $status = "Your e-mail is already verified. You can now login.";
              return redirect()->route('email_confirm',array('already' => 'yy'));
          }
      } else {
        return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
    }
    return redirect('/login')->with('status', $status);
}

public function emailConfirm($already){
    return view('auth.email_verify', compact('already'));
}

public function destroy()
{
    if (!Session()->has('user_id')) {
        return redirect('login');
    }
    
    else{
        //DtbActivityLog::updateActivityLog('logged out', ' from application');
        auth()->logout();
        Session::flush(); // destroy all set session variable
        //Session::forget('user_id'); // destroy by individual session variable
        return redirect()->to('/login');
    }
    
  }
}
