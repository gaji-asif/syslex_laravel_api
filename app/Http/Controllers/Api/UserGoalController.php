<?php
namespace App\Http\Controllers\Api;

use App\DtbUser;
use Illuminate\Http\Request;
use Validator;
use App\SysBankAccount;

class UserGoalController extends BaseController
{

    public function addBankAccount(Request $request)
    {
      
        $token = $request->header('token');

         if(empty($token)){
             return response()->json([
                'status' => 'token_error',
                'data' => 'Must give a Token',
           
            ], 400);
        }

        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();

        if(empty($user)){
             return response()->json([
            'status' => 'Token mismatch',
            'data' => 'please Give a valid Token',
           
            ]);
        }
        //dd($user);
        $validator = Validator::make($request->all(), [
            'bank_account_name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }
        $input = $request->all();
        
        $bank_accounts = new SysBankAccount;
        $bank_accounts->user_id = $request->user_id;
        $bank_accounts->bank_account_name = $request->bank_account_name;
        $bank_accounts->bank_name = $request->bank_name;
        $bank_accounts->iban = $request->iban;
        $bank_accounts->swift_bic = $request->swift_bic;
        $bank_accounts->created_by = $request->created_by;
        $result = $bank_accounts->save();


        if($result){
            return response()->json([
            'status' => 'success',
            'data' => 'Bank Account Added Successfully'
        ]);
        }
        else{
            return response()->json([
            'status' => 'error',
            'data' => 'error'
          ]);
        }
        
     }

}
