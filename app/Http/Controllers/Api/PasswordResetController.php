<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\DtbUser;
use App\PasswordReset;
use Validator;


class PasswordResetController extends BaseController
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [      
            'email' => 'required|email' 
            
      
          ]);
                 if($validator->fails()){
            return $this->sendError('Bad Requests.', $validator->errors());
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => mt_rand(1000,9999)
             ]
        );
        
        if ($user && $passwordReset){
            $user->notify(
                new PasswordResetRequest($passwordReset->token)
            );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
        }
        else return response()->json([
            'message' => 'Cannot Send Mail'
        ]);
    }
    /**
     * Find token password reset
     *
     * @param  [string] $token
     * @return [string] message
     * @return [json] passwordReset object
     */
    public function find($otp)
    {
        $passwordReset = PasswordReset::select('email', 'token')->where('token', $otp)
            ->first();
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset OTP is invalid.'
            ], 404);
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();
            return response()->json([
                'message' => 'This password reset OTP is invalid.'
            ], 404);
        }
        return response()->json($passwordReset);
    }
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */
    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|confirmed',
            //'token' => 'required|string'
        ]);
        $passwordReset = PasswordReset::where([
            //['token', $request->token],
            ['email', $request->email]
        ])->first();
        //dd($passwordReset);
        if (!$passwordReset)
            return response()->json([
                'message' => 'This password reset email is invalid.'
            ], 404);
        $user = DtbUser::where('email', $passwordReset->email)->first();
        if (!$user)
            return response()->json([
                'message' => "We can't find a user with that e-mail address.'"
            ], 404);
        $user->password = bcrypt($request->password);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccess($passwordReset));
        return response()->json([
            'message' => 'Succefully Updated the Password!'
        ]);;
    }
}