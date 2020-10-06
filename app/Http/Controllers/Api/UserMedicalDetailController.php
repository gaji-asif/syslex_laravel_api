<?php
namespace App\Http\Controllers\Api;

use App\DtbUser;
use Illuminate\Http\Request;
use Validator;

class UserMedicalDetailController extends BaseController
{

    public function usermedicalDetail(Request $request)
    {
        //$user = Auth::user();
        //dd($request->all());
        $token = $request->header('token');
        $user = DtbUser::select('id', 'ud_id', 'email')->where('api_token', $token)->first();
        //dd($user);
        $validator = Validator::make($request->all(), [
            'injuries' => 'required|string',
            'chronic_diseases' => 'required|string',
            'emergency_name' => 'required|string',
            'emergency_phone' => 'required||min:11|numeric',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }
        $input = $request->all();
        $input['injuries'] = $input['injuries'];
        $input['chronic_diseases'] = $input['chronic_diseases'];
        $input['emergency_name'] = $input['emergency_name'];
        $input['emergency_phone'] = $input['emergency_phone'];
        $user = DtbUser::where('email', $user['email'])
            ->update(["injuries" => $input['injuries'],
            "chronic_diseases" => $input['chronic_diseases'],
            "emergency_name" => $input['emergency_name'],
            "emergency_phone" => $input['emergency_phone']]);

        return response()->json([
            'status' => 'User Medical Details Added Successfully',
            //'data' => $success
        ]);
        // else
        //   return response()->json([
        //     'status' => 'error',
        //     'data' => 'These credentials do not match our records'
        //   ]);

    }

}
