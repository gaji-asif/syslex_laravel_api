<?php
namespace App\Http\Controllers\Api;

use App\DtbUser;
use Illuminate\Http\Request;
use Validator;
use App\SysStore;
use App\SysServiceCategory;
use Illuminate\Support\Facades\Storage;
use App\SysBankAccount;
use App\SysBankCardInfo;
use DB;

class SysStoreController extends BaseController
{

    public function createStore(Request $request)
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
        'company_name' => 'required|string',

    ]);
     if ($validator->fails()) {
        return $this->sendError('Bad Requests.', $validator->errors());
    }
    $input = $request->all();


       
        $icon_image_path = '';
       if(!empty($request->icon_image_path) && $request->icon_image_path != ''){
         $image_64 = $request->icon_image_path; //your base64 encoded data
         $path = "http://quizhaat.com/syslex_laravel_api/storage/app/public/";
          //$extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

          $extension = 'png';
          $replace = substr($image_64, 0, strpos($image_64, ',')+1); 

        // find substring fro replace here eg: data:image/png;base64,

          $image = str_replace($replace, '', $image_64); 

          $image = str_replace(' ', '+', $image); 

          $imageName = str_random(10).'.'.$extension;
          $icon_image_path = $path.$imageName;

          Storage::disk('local')->put($imageName, base64_decode($image));
}

        
        $stores = new SysStore;
        $stores->user_id = $request->user_id;
        $stores->youtube_link = $request->youtube_link;
        $stores->service_category_id = $request->service_category_id;
        $stores->company_name = $request->company_name;
        $stores->phone_no = $request->phone_no;
        $stores->email = $request->email;
        $stores->address = $request->address;
        $stores->about_com = $request->about_com;
        //$stores->store_image = $store_image;
        $stores->active_status = 1;
        $result = $stores->save();

        $userDetails = DtbUser::find($request->user_id);
        $userDetails->icon_image_path = $icon_image_path;
        $resultss = $userDetails->save();


        if($result){
            return response()->json([
                'status' => 'success',
                'data' => 'Store Added Successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
        
    }


    public function create_bank_card_details(Request $request)
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
        'card_holder_name' => 'required|string',

    ]);

        if ($validator->fails()) {
           return $this->sendError('Bad Requests.', $validator->errors());
        }
        $input = $request->all();

        $cardInfos = new SysBankCardInfo;
        $cardInfos->user_id = $request->user_id;
        $cardInfos->card_holder_name = $request->card_holder_name;
        $cardInfos->expiry_date = date('Y-m-d', strtotime($request->expiry_date));
        $cardInfos->card_no = $request->card_no;
        $cardInfos->cvv = $request->cvv;
        $cardInfos->active_status = 1;
        $result = $cardInfos->save();



        if($result){
            return response()->json([
                'status' => 'success',
                'data' => 'Card Details Added Successfully'
            ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
        
    }

    public function editStore(Request $request, $id){

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
      
         //$storeDetails = SysStore::find($id);
      $storeDetails = SysStore::where('user_id', $id)->first();

      $getUserDetailss = '';
      if(!empty($storeDetails->user_id)){
        $getUserDetailss = DtbUser::find($storeDetails->user_id);
    }



    $response['status'] = 'success';
    $response['storeDetails'] = $storeDetails;
    $response['UserDetails'] = $getUserDetailss;

    if($storeDetails){
        return response()->json($response);
    }
    else{
     return response()->json([
         'status' => 'error',
         'data' => 'error'
     ]);
 }
}


public function get_store_details(Request $request, $id){

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
      
         //$storeDetails = SysStore::find($id);
      $storeDetails = SysStore::find($id);

      $all_services = '';
      if(!empty($storeDetails->user_id)){
        $all_services = DB::select(DB::raw("SELECT sys_service_infos.*, sys_service_categories.category_name FROM sys_service_infos LEFT JOIN sys_service_categories ON sys_service_infos.service_category_id = sys_service_categories.id WHERE user_id = '$storeDetails->user_id'"));
    }



    $response['status'] = 'success';
    $response['storeDetails'] = $storeDetails;
    $response['all_services'] = $all_services;

    if($storeDetails){
        return response()->json($response);
    }
    else{
     return response()->json([
         'status' => 'error',
         'data' => 'error'
     ]);
 }
}

public function get_user_profile_details(Request $request, $user_id){

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
      
    $UserDetails = DtbUser::find($user_id);



    $response['status'] = 'success';
    $response['UserDetails'] = $UserDetails;

    if($UserDetails){
        return response()->json($response);
    }
    else{
     return response()->json([
         'status' => 'error',
         'data' => 'error'
     ]);
 }
}

public function update_store(Request $request, $user_id){
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
    'first_name' => 'required|string',
    'last_name' => 'required|string',

]);
 if ($validator->fails()) {
    return $this->sendError('Bad Requests.', $validator->errors());
}

        // $stores = SysStore::where('user_id', $user_id)->first();
$usersDetails = DtbUser::find($user_id);

        // for image upload

if(!empty($request->icon_image_path) && $request->icon_image_path != ''){
         $image_64 = $request->icon_image_path; //your base64 encoded data
         $path = "http://quizhaat.com/syslex_laravel_api/storage/app/public/";
          //$extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

          $extension = 'png';
          $replace = substr($image_64, 0, strpos($image_64, ',')+1); 

        // find substring fro replace here eg: data:image/png;base64,

          $image = str_replace($replace, '', $image_64); 

          $image = str_replace(' ', '+', $image); 

          $imageName = str_random(10).'.'.$extension;
          $icon_image_path = $path.$imageName;

          Storage::disk('local')->put($imageName, base64_decode($image));
}
        else{
            $icon_image_path = $usersDetails->icon_image_path;
        }



$result = SysStore::where('user_id', '=', $user_id)
->update(
    array(
        'about_com' => $request->about_com,
        'address' => $request->address,
                //'store_image' => $store_image,

    )
);

        // update in users details in dtb_users table 


$usersDetails->first_name = $request->first_name;
$usersDetails->last_name = $request->last_name;
$usersDetails->mobile = $request->mobile;
$usersDetails->country = $request->country;
$usersDetails->icon_image_path = $icon_image_path;
$result = $usersDetails->save();


if($result){
    return response()->json([
        'status' => 'success',
        'data' => 'Profile Details Updated Successfully'
    ]);
}
else{
    return response()->json([
        'status' => 'error',
        'data' => 'error'
    ]);
}


}


public function update_user_profile_details(Request $request, $user_id){
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
    'first_name' => 'required|string',
    'last_name' => 'required|string',

]);
 if ($validator->fails()) {
    return $this->sendError('Bad Requests.', $validator->errors());
}


    // $stores = SysStore::where('user_id', $user_id)->first();
$usersDetails = DtbUser::find($user_id);

        // for image upload

if(!empty($request->icon_image_path) && $request->icon_image_path != ''){
         $image_64 = $request->icon_image_path; //your base64 encoded data
         $path = "http://quizhaat.com/syslex_laravel_api/storage/app/public/";
          $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

          $extension = 'png';
          $replace = substr($image_64, 0, strpos($image_64, ',')+1); 

        // find substring fro replace here eg: data:image/png;base64,

          $image = str_replace($replace, '', $image_64); 

          $image = str_replace(' ', '+', $image); 

          $imageName = str_random(10).'.'.$extension;
          $icon_image_path = $path.$imageName;

          Storage::disk('local')->put($imageName, base64_decode($image));
}
        else{
            $icon_image_path = $usersDetails->icon_image_path;
        }





        // update in users details in dtb_users table 


$usersDetails->first_name = $request->first_name;
$usersDetails->last_name = $request->last_name;
$usersDetails->mobile = $request->mobile;
$usersDetails->country = $request->country;
$usersDetails->icon_image_path = $icon_image_path;
$result = $usersDetails->save();


if($result){
    return response()->json([
        'status' => 'success',
        'data' => 'Profile Details Updated Successfully'
    ]);
}
else{
    return response()->json([
        'status' => 'error',
        'data' => 'error'
    ]);
}


}

public function get_bank_details(Request $request, $user_id){

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

  $bankDetails = SysBankAccount::where('user_id', $user_id)->first();

  if($bankDetails){
     return response()->json([
         'status' => 'success',
         'data' => $bankDetails,
     ]);
 }
 else{
     return response()->json([
         'status' => 'error',
         'data' => 'error'
     ]);
 }
}


public function update_bank_details(Request $request, $user_id){
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

$result = SysBankAccount::where('user_id', '=', $user_id)
->update(
    array(
        'bank_account_name' => $request->bank_account_name,
        'bank_name' => $request->bank_name,
        'iban' => $request->iban,
        'swift_bic' => $request->swift_bic,
    )
);



if($result){
    return response()->json([
        'status' => 'success',
        'data' => 'Bank Details Updated Successfully'
    ]);
}
else{
    return response()->json([
        'status' => 'error',
        'data' => 'error'
    ]);
}


}


public function get_bank_card_details(Request $request, $user_id){

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

  $bankCardDetails = SysBankCardInfo::where('user_id', $user_id)->first();

  if($bankCardDetails){
     return response()->json([
         'status' => 'success',
         'data' => $bankCardDetails,
     ]);
 }
 else{
     return response()->json([
         'status' => 'error',
         'data' => 'error'
     ]);
 }
}

public function update_bank_card_details(Request $request, $user_id){
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
    'card_holder_name' => 'required|string',


]);
 if ($validator->fails()) {
    return $this->sendError('Bad Requests.', $validator->errors());
}

$result = SysBankCardInfo::where('user_id', '=', $user_id)
->update(
    array(
        'card_holder_name' => $request->card_holder_name,
        'expiry_date' => date('Y-m-d', strtotime($request->expiry_date)),
        'cvv' => $request->cvv,
        'card_no' => $request->card_no,
    )
);



if($result){
    return response()->json([
        'status' => 'success',
        'data' => 'Bank Card Details Updated Successfully'
    ]);
}
else{
    return response()->json([
        'status' => 'error',
        'data' => 'error'
    ]);
}


}


public function getServiceCategory(Request $request)
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

 $serviceCategories = SysServiceCategory::where('active_status', 1)->get();

 return response()->json($serviceCategories);

}

public function create_service_category(Request $request){
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
    'category_name' => 'required|string',

]);
 if ($validator->fails()) {
    return $this->sendError('Bad Requests.', $validator->errors());
}

$input = $request->all();

$categories = new SysServiceCategory;
$categories->category_name = $request->category_name;
$categories->active_status = 1;
$result = $categories->save();


if($result){
    return response()->json([
        'status' => 'success',
        'data' => 'Category Added Successfully'
    ]);
}
else{
    return response()->json([
        'status' => 'error',
        'data' => 'error'
    ]);
}
}


public function edit_service_category(Request $request, $id){

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

 $categoriesDetails = SysServiceCategory::where('id', $id)->first();

        // $categories = SysServiceCategory::find($id);
        // $categories->category_name = $request->category_name;
        // $result = $categories->save();




 if($categoriesDetails){
    return response()->json([
        'status' => 'success',
        'data' => $categoriesDetails
    ]);
}
else{
    return response()->json([
        'status' => 'error',
        'data' => 'error'
    ]);
}
}


public function update_service_category(Request $request, $id){

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
    'category_name' => 'required|string',

]);
 if ($validator->fails()) {
    return $this->sendError('Bad Requests.', $validator->errors());
}

$input = $request->all();



$categories = SysServiceCategory::find($id);
$categories->category_name = $request->category_name;
$result = $categories->save();




if($result){
    return response()->json([
        'status' => 'success',
        'data' => 'Updated Successfully'
    ]);
}
else{
    return response()->json([
        'status' => 'error',
        'data' => 'error'
    ]);
}
}


public function delete_service_category(Request $request, $id){

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

 $result = SysServiceCategory::find($id);
 $results = $result->delete();


 if($results){
    return response()->json([
        'status' => 'success',
        'data' => 'Deleted Successfully'
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
