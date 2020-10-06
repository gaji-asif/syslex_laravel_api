<?php
namespace App\Http\Controllers\Api;

use App\DtbUser;
use Illuminate\Http\Request;
use Validator;
use App\SysStore;
use App\SysServiceCategory;


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
        
        $stores = new SysStore;
        $stores->user_id = $request->user_id;
        $stores->youtube_link = $request->youtube_link;
        $stores->company_name = $request->company_name;
        $stores->phone_no = $request->phone_no;
        $stores->email = $request->email;
        $stores->address = $request->address;
        $stores->about_com = $request->about_com;
        $stores->active_status = 1;
        $result = $stores->save();


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
