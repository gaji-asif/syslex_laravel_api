<?php
namespace App\Http\Controllers\Api;

use App\DtbUser;
use Illuminate\Http\Request;
use Validator;
use App\SysStore;
use App\SysServiceCategory;
use App\SysProductInfo;
use Illuminate\Support\Facades\Storage;
use DB;

class SysUserDashboard extends BaseController
{

    public function addProduct(Request $request)
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
            'product_name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }
        //$input = $request->all();

       // // if ($request->hasFile('product_image')) {
       //      // $upload = $request->file('product_image');
       //      $upload = base64_decode($request->product_image);
       //      $file_type = $upload->getClientOriginalExtension();
       //      $upload_name =  time() . $upload->getClientOriginalName();
       //      $destinationPath = public_path('/uploads/products');
       //      $upload->move($destinationPath, $upload_name);
       //      $product_image = '/uploads/products/'.$upload_name;
            
       // // }


        $image = $request->product_image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $path = "http://quizhaat.com/syslex_laravel_api/storage/app/public/";

        $imageName = str_random(10) . '.png';

        $product_image = $path.$imageName;

        Storage::disk('local')->put($imageName, base64_decode($image));
        

     
        
         $products = new SysProductInfo;
        // $products->user_id = $request->user_id;
        $products->user_id = $request->user_id;
        $products->product_name = $request->product_name;
        $products->overview = $request->overview;
        $products->additional_info = $request->additional_info;
        $products->selling_price = $request->selling_price;
        $products->vat = $request->vat;
        $products->quantity_in_stock = $request->quantity_in_stock;
        $products->discount_status = $request->discount_status;
        $products->discount_percentage = $request->discount_percentage;
        $products->discount_amount = $request->discount_amount;
        $products->availability_status = $request->availability_status;
        $products->availability_from = $request->availability_from;
        $products->availability_to = $request->availability_to;
        $products->is_service = $request->is_service;
        $products->product_image = $product_image;
        $products->active_status = 1;
        $result = $products->save();


        if($result){
            return response()->json([
            'status' => 'success',
            'data' => 'Product Added Successfully'
        ]);
        }
        else{
            return response()->json([
            'status' => 'error',
            'data' => 'error'
          ]);
        }
        
     }

     public function get_all_restuarants(Request $request)
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
       
       // get all restuarants (36 is the restuarant id that is sevice category)
       //$all_stores = SysStore::where('service_category_id', 36)->get();

       $all_stores = DB::select(DB::raw("SELECT sys_stores.*, (select MIN(selling_price) from sys_service_infos WHERE user_id = sys_stores.user_id) min_selling_price, (select first_image_path from sys_service_infos WHERE user_id = sys_stores.user_id LIMIT 1) first_image_path FROM `sys_stores` WHERE service_category_id = 37"));

       // $store_lowest_service_images = '';
       // if(isset($all_stores)){
       //  //$service_id = $all_stores->id;
       //  $store_lowest_service_images = DB::select(DB::raw("SELECT min(selling_price) as selling_price, (select image_path from sys_service_images where service_id = sys_service_infos.id  LIMIT 1) image_path FROM `sys_service_infos` WHERE user_id= $user_id"));


       // }

         $response['status'] = 'success';
         $response['all_stores'] = $all_stores;
         //$response['store_lowest_service_images'] = $store_lowest_service_images;
         
         if($all_stores){
            return response()->json($response);
         }
         else{
             return response()->json([
             'status' => 'error',
             'data' => 'error'
           ]);
         }
        
     }


      public function get_tours_stores(Request $request)
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
       


       $all_stores = DB::select(DB::raw("SELECT sys_stores.*, (select MIN(selling_price) from sys_service_infos WHERE user_id = sys_stores.user_id) min_selling_price, (select first_image_path from sys_service_infos WHERE user_id = sys_stores.user_id LIMIT 1) first_image_path FROM `sys_stores` WHERE service_category_id = 38"));

     

         $response['status'] = 'success';
         $response['all_stores'] = $all_stores;
        
         
         if($all_stores){
            return response()->json($response);
         }
         else{
             return response()->json([
             'status' => 'error',
             'data' => 'error'
           ]);
         }
        
     }

     public function get_water_activities_stores(Request $request)
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
       


       $all_stores = DB::select(DB::raw("SELECT sys_stores.*, (select MIN(selling_price) from sys_service_infos WHERE user_id = sys_stores.user_id) min_selling_price, (select first_image_path from sys_service_infos WHERE user_id = sys_stores.user_id LIMIT 1) first_image_path FROM `sys_stores` WHERE service_category_id = 39"));

     

         $response['status'] = 'success';
         $response['all_stores'] = $all_stores;
        
         
         if($all_stores){
            return response()->json($response);
         }
         else{
             return response()->json([
             'status' => 'error',
             'data' => 'error'
           ]);
         }
        
     }

     public function get_land_activities_stores(Request $request)
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
       


       $all_stores = DB::select(DB::raw("SELECT sys_stores.*, (select MIN(selling_price) from sys_service_infos WHERE user_id = sys_stores.user_id) min_selling_price, (select first_image_path from sys_service_infos WHERE user_id = sys_stores.user_id LIMIT 1) first_image_path FROM `sys_stores` WHERE service_category_id = 40"));

     

         $response['status'] = 'success';
         $response['all_stores'] = $all_stores;
        
         
         if($all_stores){
            return response()->json($response);
         }
         else{
             return response()->json([
             'status' => 'error',
             'data' => 'error'
           ]);
         }
        
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


     public function editProduct(Request $request, $id){

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
     
        $productInfoDetails = SysProductInfo::where('id', $id)->first();
        
        // $categories = SysServiceCategory::find($id);
        // $categories->category_name = $request->category_name;
        // $result = $categories->save();




        if($productInfoDetails){
            return response()->json([
            'status' => 'success',
            'data' => $productInfoDetails
        ]);
        }
        else{
            return response()->json([
            'status' => 'error',
            'data' => 'error'
          ]);
        }
     }


     public function updateProduct(Request $request, $id){

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
            'product_name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }

        if ($request->hasFile('product_image')) {
            $upload = $request->file('product_image');
            $file_type = $upload->getClientOriginalExtension();
            $upload_name =  time() . $upload->getClientOriginalName();
            $destinationPath = public_path('/uploads/products');
            $upload->move($destinationPath, $upload_name);
            $product_image = '/uploads/products/'.$upload_name;
            
        }
        else{
          $product_image = '';
        }
     
       
        
        $products = SysProductInfo::find($id);
        $products->user_id = $request->user_id;
        $products->product_name = $request->product_name;
        $products->overview = $request->overview;
        $products->additional_info = $request->additional_info;
        $products->selling_price = $request->selling_price;
        $products->vat = $request->vat;
        $products->quantity_in_stock = $request->quantity_in_stock;
        $products->discount_status = $request->discount_status;
        $products->discount_percentage = $request->discount_percentage;
        $products->discount_amount = $request->discount_amount;
        $products->availability_status = $request->availability_status;
        $products->availability_from = $request->availability_from;
        $products->availability_to = $request->availability_to;
        $products->is_service = $request->is_service;
        $products->product_image = $product_image;
        $result = $products->save();




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


     public function deleteProduct(Request $request, $id){

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

       $result = SysProductInfo::find($id);
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


     public function updateProdcutQuantity(Request $request, $id)
     {
       
        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);


         //dd($user);
         $validator = Validator::make($request->all(), [
             'quantity_stock' => 'required|integer',
 
         ]);
         if ($validator->fails()) {
             return $this->sendError('Bad Requests.', $validator->errors());
         }
    
         
         // $products = SysProductInfo::find($request->id);
         $products = SysProductInfo::find($id);
         $current_stock = $products->quantity_in_stock + $request->quantity_stock;
   
         $products->quantity_in_stock = $current_stock ;
         $result = $products->save();
 
 
         if($result){
             return response()->json([
             'status' => 'success',
             'data' => 'Product Quanity Stock update Successfully'
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