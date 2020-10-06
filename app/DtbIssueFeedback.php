<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class DtbIssueFeedback extends Model
{
    protected $guarded = [];
    //check it's exists
    public static function getExistsFeedBack($request,$issue_id){
        
        $user_id = Session::get('user_id');
        
        $results = DtbIssueFeedback::where([['issue_id','=',$issue_id],['feedback_type','=',$request->get('feedback_type')],['user_id','=',$user_id]])->get();
        return $results;
    }
    //add new feedback
    public static function addFeedBack($request,$user_id){
        
      if (!Session()->has('user_id')) {
          return redirect('login');
      }
        
        $data = new DtbIssueFeedback;
        $data->issue_id = $request->issue_id;
        $data->feedback_type = $request->get('feedback_type');
        $data->user_id = $user_id;
        $data->created_at = strtotime(now());
        $data->save();
    }
    
    
}
