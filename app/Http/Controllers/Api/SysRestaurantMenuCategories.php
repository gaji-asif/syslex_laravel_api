<?php

namespace App\Http\Controllers\Api;

use App\DtbUser;
use App\SysResMenuCategory;
use Illuminate\Http\Request;
use Validator;
use App\SysStore;
use App\Http\Controllers\Api\CustomeHelper;


class SysRestaurantMenuCategories extends BaseController
{
    public function addResMenuCategory(Request $request)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);
        //dd($user);
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string',

        ]);
        if ($validator->fails()) {
            return $this->sendError('Bad Requests.', $validator->errors());
        }

        $resMenuCategory = new SysResMenuCategory();
        $resMenuCategory->cat_name = $request->category_name;
        $resMenuCategory->active_status = 1;
        $result = $resMenuCategory->save();


        if ($result) {
            return response()->json([
                'status' => 'success',
                'data' => 'Restaurant Menu Category Added Successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
    }

    public function getResMenuCategory(Request $request)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);

        $resMenuCategory = SysResMenuCategory::where('active_status', 1)->get();

        if ($resMenuCategory) {
            return response()->json([
                'status' => 'success',
                'data' => $resMenuCategory
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'No Data Right now'
            ]);
        }

        // return response()->json($products);

    }

    public function editResMenuCategory(Request $request, $id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);

        $resMenuCategory = SysResMenuCategory::where('id', $id)->first();

        if ($resMenuCategory) {
            return response()->json([
                'status' => 'success',
                'data' => $resMenuCategory
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'error'
            ]);
        }
    }

    public function updateResMenuCategory(Request $request, $id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);


        //dd($user);
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string',

        ]);

        $resMenuCategory = SysResMenuCategory::find($id);
        $resMenuCategory->cat_name = $request->category_name;
        $resMenuCategory->active_status = 1;
        $result = $resMenuCategory->save();




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

    public function deleteResMenuCategory(Request $request, $id)
    {

        $token = $request->header('token');

        CustomeHelper::checkToken($token);
        $user = DtbUser::select('id', 'email')->where('api_token', $token)->first();
        CustomeHelper::checkUser($user);
        $result = SysResMenuCategory::find($id);
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
