<?php
namespace App\Http\Controllers\Api;

use App\DtbUser;
use Illuminate\Http\Request;
use Validator;

class UserPersonalDetailController extends BaseController
{

    public function userpersonalDetail(Request $request)
    {
        //$user = Auth::user();
        //dd($request->all());
        $token = $request->header('token');
        $user = DtbUser::select('id', 'ud_id', 'email')->where('api_token', $token)->first();
        //dd($user);
        $validator = Validator::make($request->all(), [
            'gender' => 'required|in:male,female',
            'dob' => 'required|date_format:Y-m-d|before:today',
            'height' => 'required|integer',
            'weight' => 'required|integer',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }
        $input = $request->all();
        $input['gender'] = $input['gender'];
        $input['dob'] = $input['dob'];
        $input['height'] = $input['height'];
        $input['weight'] = $input['weight'];
        $user = DtbUser::where('email', $user['email'])
            ->update(["gender" => $input['gender'],
            "date_of_birth" => $input['dob'],
            "height" => $input['height'],
            "weight" => $input['weight']]);

        return response()->json([
            'status' => 'User Personal Details Added Successfully',
            //'data' => $success
        ]);
        // else
        //   return response()->json([
        //     'status' => 'error',
        //     'data' => 'These credentials do not match our records'
        //   ]);

    }
    public function userplanType(Request $request)
    {
        //$user = Auth::user();
        //dd($request->all());
        $token = $request->header('token');
        $user = DtbUser::select('id', 'ud_id', 'email')->where('api_token', $token)->first();
        //dd($user);
        $validator = Validator::make($request->all(), [
            'plan_type' => 'required|string',


        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }
        $input = $request->all();
        $input['plan_type'] = $input['plan_type'];

        $user = DtbUser::where('email', $user['email'])
            ->update(["plan_type" => $input['plan_type']
            ]);

        return response()->json([
            'status' => 'User Personal plan_type Added Successfully',
            //'data' => $success
        ]);
        // else
        //   return response()->json([
        //     'status' => 'error',
        //     'data' => 'These credentials do not match our records'
        //   ]);

    }
    public function getuserData(Request $request)
    {
        //$user = Auth::user();
        //dd($request->all());
        $token = $request->header('token');
        $user = DtbUser::select('id', 'ud_id', 'email')->where('api_token', $token)->first();
        //dd($user);
        // $validator = Validator::make($request->all(), [
        //     'plan_type' => 'required|string',


        // ]);
        // if ($validator->fails()) {
        //     return $this->sendError('Bad Requests.', $validator->errors());
        // }
        // $input = $request->all();
        // $input['plan_type'] = $input['plan_type'];

        $user = DtbUser::where('email', $user['email'])->first();
        //dd($user); 
        $success['Username'] =  $user['first_name'];
        $success['Name'] =  $user['first_name'];   	  
        $success['Email'] =  $user['email']; 
        $success['Birthday'] =  $user['date_of_birth'];
        $success['Gender'] =  $user['gender'];
        $success['Height'] =  $user['height'];
        $success['Weight'] =  $user['weight'];
        
        $success['Distance_unit'] =  $user['height_unit'];
        $success['Weight_unit'] =  $user['weight_unit'];
        // $success['role'] = $user->role;
        // $success['first_name'] =  $user->first_name;
        // $success['email'] =  $user->email;
        // $success['mobile'] = $user->mobile;
        return $this->sendResponse($success,'');
        // return response()->json([
        //     'status' => 'User Personal plan_type Added Successfully',
        //     //'data' => $success
        // ]);
        // else
        //   return response()->json([
        //     'status' => 'error',
        //     'data' => 'These credentials do not match our records'
        //   ]);

    }

}
