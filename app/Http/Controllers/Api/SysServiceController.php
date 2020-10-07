<?php

namespace App\Http\Controllers\Api;

use App\DtbUser;
use Illuminate\Http\Request;
use Validator;
use App\SysStore;
use App\SysServiceCategory;
use App\SysProductInfo;
use App\SysServiceInfo;

class SysServiceController extends BaseController

{
    public function addService(Request $request)
    {

        $token = $request->header('token');

        if (empty($token)) {
            return response()->json([
                'status' => 'token_error',
                'data' => 'Must give a Token',

            ], 400);
        }

        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();

        if (empty($user)) {
            return response()->json([
                'status' => 'Token mismatch',
                'data' => 'please Give a valid Token',

            ]);
        }
        //dd($user);
        $validator = Validator::make($request->all(), [
            'service_name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }

        $service = new SysServiceInfo();
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
                'data' => 'Service Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
    }

    public function getServices(Request $request)
    {

        $token = $request->header('token');

        if (empty($token)) {
            return response()->json([
                'status' => 'token_error',
                'data' => 'Must give a Token',

            ], 400);
        }

        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();

        if (empty($user)) {
            return response()->json([
                'status' => 'Token mismatch',
                'data' => 'please Give a valid Token',

            ]);
        }

        $products = SysServiceInfo::where('active_status', 1)->get();

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
}
