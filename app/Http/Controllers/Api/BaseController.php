<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Auth; 
use App\User; 
use Validator;

class BaseController extends Controller
{
public function sendResponse($result, $message)
    {
        $response = [
            'success' => 200,
            'contents' => $result,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 400)
    {

        $response = [
            'success' => 401,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {

            $response['contents'] = $errorMessages;

        }

        return response()->json($response, $code);
    }
}
