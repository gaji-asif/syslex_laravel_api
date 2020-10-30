<?php

namespace App\Http\Controllers\Api;

use App\DtbUser;
use Illuminate\Http\Request;
use Validator;
use App\SysStore;
use App\SysServiceCategory;
use App\SysProductInfo;
use App\SysServiceInfo;
use App\Http\Controllers\Api\CustomeHelper;

class SysServiceController extends BaseController

{
    public function addService(Request $request)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);
        //dd($user);
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }

        // echo "<pre>";
        // print_r($request->all());
        // exit;

        $service = new SysServiceInfo();
        $service->user_id = $request->user_id;
        $service->service_category_id = $request->service_category_id;
        $service->service_name = $request->service_name;
        $service->overview = $request->overview;
        $service->additional_info = $request->additional_info;
        $service->selling_price = $request->selling_price;
        $service->vat = $request->vat;
        $service->time_duration = $request->time_duration;
        $service->age_limit = $request->age_limit;
        $service->availability_status = $request->availability_status;
        $service->availability_from = $request->availability_from;
        $service->availability_to = $request->availability_to;
        $service->discount_status = $request->discount_status;
        $service->discount_amount = $request->discount_amount;
        $service->active_status = 1;
        $result = $service->save();


        if ($result) {
            return response()->json([
                'status' => 'success',
                'data' => 'Service Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
    }

    public function getServices(Request $request, $user_id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);

        
        $products = SysServiceInfo::where('user_id', $user_id)->get();

        if ($products) {
            return response()->json([
                'status' => 'success',
                'data' => $products
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'No Data Right now'
            ]);
        }

        // return response()->json($products);

    }

    public function editService(Request $request, $id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);

        $serviceInfoDetails = SysServiceInfo::where('id', $id)->first();

        if ($serviceInfoDetails) {
            return response()->json([
                'status' => 'success',
                'data' => $serviceInfoDetails
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
    }

    public function updateService(Request $request, $id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);


        //dd($user);
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string',

        ]);

        $service = SysServiceInfo::find($id);
        $service->service_category_id = $request->service_category_id;
        $service->service_name = $request->service_name;
        $service->overview = $request->overview;
        $service->additional_info = $request->additional_info;
        $service->selling_price = $request->selling_price;
        $service->vat = $request->vat;
        $service->time_duration = $request->time_duration;
        $service->age_limit = $request->age_limit;
        $service->discount_status = $request->discount_status;
        $service->discount_amount = $request->discount_amount;
        $service->active_status = 1;
        $result = $service->save();




        if ($result) {
            return response()->json([
                'status' => 'success',
                'data' => 'Updated Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
    }

    public function deleteService(Request $request, $id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);
        $result = SysServiceInfo::find($id);
        $results = $result->delete();

        if ($results) {
            return response()->json([
                'status' => 'success',
                'data' => 'Deleted Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
    }
 
   
}
