<?php

namespace App\Http\Controllers\Api;

use App\DtbUser;
use App\SysResMenuInfo;
use Illuminate\Http\Request;
use Validator;

class SysRestaurantMenuController extends BaseController
{
    public function addResMenu(Request $request)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);
        //dd($user);
        $validator = Validator::make($request->all(), [
            'menu_name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }

        $resMenu = new SysResMenuInfo();
        $resMenu->category_id = $request->category_id;
        $resMenu->menu_name = $request->menu_name;
        $resMenu->overview = $request->overview;
        $resMenu->additional_info = $request->additional_info;
        $resMenu->selling_price = $request->selling_price;
        $resMenu->vat = $request->vat;
        $resMenu->availability = $request->availability;
        $resMenu->availability_from = $request->availability_from;
        $resMenu->availability_to = $request->availability_to;
        $resMenu->discount_status = $request->discount_status;
        $resMenu->discount_amount = $request->discount_amount;
        $resMenu->active_status = 1;
        $result = $resMenu->save();


        if ($result) {
            return response()->json([
                'status' => 'success',
                'data' => 'Restaurant Menu Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
    }

    public function getResMenu(Request $request)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);

        $resMenu = SysResMenuInfo::where('active_status', 1)->get();

        if ($resMenu) {
            return response()->json([
                'status' => 'success',
                'data' => $resMenu
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'No Data Right now'
            ]);
        }

        // return response()->json($products);

    }

    public function editResMenu(Request $request, $id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);

        $resMenu = SysResMenuInfo::where('id', $id)->first();

        if ($resMenu) {
            return response()->json([
                'status' => 'success',
                'data' => $resMenu
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
    }

    public function updateResMenu(Request $request, $id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);


        //dd($user);
        $validator = Validator::make($request->all(), [
            'menu_name' => 'required|string',

        ]);

        $resMenu = SysResMenuInfo::find($id);
        $resMenu->category_id = $request->category_id;
        $resMenu->menu_name = $request->menu_name;
        $resMenu->overview = $request->overview;
        $resMenu->additional_info = $request->additional_info;
        $resMenu->selling_price = $request->selling_price;
        $resMenu->vat = $request->vat;
        $resMenu->availability = $request->availability;
        $resMenu->availability_from = $request->availability_from;
        $resMenu->availability_to = $request->availability_to;
        $resMenu->discount_status = $request->discount_status;
        $resMenu->discount_amount = $request->discount_amount;
        $resMenu->active_status = 1;
        $result = $resMenu->save();




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

    public function deleteResMenu(Request $request, $id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);
        $result = SysResMenuInfo::find($id);
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
