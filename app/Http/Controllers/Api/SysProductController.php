<?php
namespace App\Http\Controllers\Api;

use App\DtbUser;
use Illuminate\Http\Request;
use Validator;
use App\SysStore;
use App\SysServiceCategory;
use App\SysProductInfo;

class SysProductController extends BaseController
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
        
        $products = new SysProductInfo;
        //$products->user_id = $request->user_id;
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

     public function get_products(Request $request)
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
       
       $products = SysProductInfo::where('active_status', 1)->get();

        if($products){
            return response()->json([
            'status' => 'success',
            'data' => $products
        ]);
        }
        else{
            return response()->json([
            'status' => 'error',
            'data' => 'No Data Right now'
          ]);
        }

      // return response()->json($products);
        
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




}
