<?php
namespace App\Http\Controllers\Api;

class CustomeHelper{
    static function checkToken($token)
    {
  
      if(empty($token)){
 
          return response()->json([
             'status' => 'token_error',
             'data' => 'Must give a Token',
         ], 400);
     }
    }

    static function checkUser($user)
    {
      
        if(empty($user)){
            return response()->json([
           'status' => 'Token mismatch',
           'data' => 'please Give a valid Token',
          
           ]);
       }
    }
}