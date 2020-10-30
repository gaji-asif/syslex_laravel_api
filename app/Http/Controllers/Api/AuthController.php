<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\User; 
use App\DtbUser;
use Validator;
use Session;
use App\SysStore;
use Illuminate\Support\Facades\Hash;
use App\SysBankCardInfo;

class AuthController extends BaseController 
{
  /** 
   * Login API 
   * 
   * @return \Illuminate\Http\Response 
   */ 
  public function login(Request $request){ 
    $validator = Validator::make($request->all(), [      
      'email' => 'required|email', 
      'password' => 'required', 

    ]);
    if($validator->fails()){
      return $this->sendError('Bad Requests.', $validator->errors());
    }
    if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
      $user = Auth::user(); 
      //$success['token'] =  $user->createToken('fitness_app')->accessToken; 
      $success['token'] =  $user->api_token;
      $success['id'] =  $user->id;
      $success['role'] = $user->role;
      $success['first_name'] =  $user->first_name;
      $success['last_name'] =  $user->last_name;
      $success['email'] =  $user->email;

     // Session::put('user_id', $user->id);

      // 1 = provider, 2 = user

      if($user->role == 1){
        $userStores = SysStore::where('user_id', $user->id)->first();
      }

      if($user->role == 2){
         $userStores = SysBankCardInfo::where('user_id', $user->id)->first();
      }
      

      
      if(isset($userStores)){
        $success['hasStore'] =  1;
      }
      else{
        $success['hasStore'] =  0;
      }

      return response()->json([
        'status' => 'success',
        'data' => $success
      ]); 
    } else { 
      return response()->json([
        'status' => 'error',
        'data' => 'These credentials do not match our records'
      ],400); 
    } 
  }
  
  /** 
   * Register API 
   * 
   * @return \Illuminate\Http\Response 
   */ 
  public function register(Request $request) 
  { 
    $validator = Validator::make($request->all(), [ 
      'role' => 'required|integer',
      'first_name' => 'required|string', 
      'last_name' => 'required|string', 
      'email' => 'required|email|unique:dtb_users,email', 
      'password' => 'required|between:6,12', 

    ]);
    if($validator->fails()){
      return $this->sendError('Bad Requests.', $validator->errors());
    }
    $input = $request->all(); 
    $input['password'] = bcrypt($input['password']);
    $input['api_token'] =  str_random(60);  
    $user = DtbUser::create($input); 
    //$success['token'] =  $user->createToken('fitness_app')->accessToken;
    $success['token'] =  $user->api_token; 
    $success['role'] = $user->role;
    $success['first_name'] =  $user->first_name;
    $success['email'] =  $user->email;
    return $this->sendResponse($success,'');
  }


  public function providerRegister(Request $request) 
  { 
    $validator = Validator::make($request->all(), [ 
      'role' => 'required|integer',
      'first_name' => 'required|string', 
      'email' => 'required|email|unique:dtb_users,email', 
      'password' => 'required|between:6,12', 
      'last_name' => ''

    ]);
    if($validator->fails()){
      return $this->sendError('Bad Requests.', $validator->errors());
    }
    $input = $request->all(); 
    $input['password'] = bcrypt($input['password']);
    $input['api_token'] =  str_random(60); 

    $user = new DtbUser;
    // $user->first_name = $input['first_name'];
    // $user->last_name = $input['last_name'];
    // $user->email = $input['email'];
    // $user->password = $input['password'];
    // $user->api_token = $input['api_token'];
    // $result = $user->save();

    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->password = $input['password'];
    $user->api_token = $input['api_token'];
    $user->role = $request->role;
    $result = $user->save();


    //$success['token'] =  $user->createToken('fitness_app')->accessToken;
    $success['token'] =  $user->api_token; 
    $success['role'] = $user->role;
    $success['first_name'] =  $user->first_name;
    $success['email'] =  $user->email;
    return $this->sendResponse($success,'');
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

    public function change_password(Request $request, $user_id){

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
            'password' => 'required|string'
            

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }

        $usersDetails = DtbUser::find($user_id);
        $usersDetails->password = Hash::make($request->password);
        $result = $usersDetails->save();

        if($result){
            return response()->json([
            'status' => 'success',
            'data' => 'Your Password Updated Successfully'
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