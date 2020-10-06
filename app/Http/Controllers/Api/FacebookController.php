<?php
namespace App\Http\Controllers\Api;
use App\DtbUser;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;
use Auth;
use Exception;


class FacebookController extends Controller
{


    //use AuthenticatesAndRegistersUsers, ThrottlesLogins;


    //protected $redirectTo = '/';


    // public function __construct()
    // {
    //     $this->middleware('guest', ['except' => 'logout']);
    // }


    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|max:255|unique:users',
    //         'password' => 'required|confirmed|min:6',
    //     ]);
    // }


    protected function create(array $data)
    {
        return DtbUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }


    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function handleFacebookCallback()
    {
        try {
            //$user = Socialite::driver('facebook')->user();
            $providerUser = Socialite::driver('facebook')->stateless()->user();
            //dd($providerUser);
            $create['name'] = $user->name;
            $create['email'] = $user->email;
            $create['facebook_id'] = $user->id;
            
            $userModel = new DtbUser;
            $createdUser = $userModel->addNew($create);
            //dd($createdUser);
            Auth::loginUsingId($createdUser->id);
            //return \response("Added Succefully");

            return response()->json([
                'message' => "Success ."
            ], 200);
        } catch (Exception $e) {
            
            return response()->json([
                'message' => "We can't find a user ."
            ], 404);
        }
        
    }
}