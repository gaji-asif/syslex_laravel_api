<?php

namespace App;
use Session;

use Illuminate\Database\Eloquent\Model;

class DtbActivityLog extends Model
{
	public static function allActivityLogs($created_at){
		$developer_id = Session::get('developer_id');
		return DtbActivityLog::where('developer_id', $developer_id)->whereDate('created_at', $created_at)->orderBy('created_at', 'desc')->get();
	}

	public static function activityTime($created_at){
		$secondsDifference=strtotime(date('Y-m-d H:i:s'))-strtotime($created_at);
        //converting seconds to minutes.
        $time_minitues = intval($secondsDifference/60);
        if($time_minitues <= 1){
        	return " just Now";
        }
        if($time_minitues <= 60){
        	return $time_minitues. " minites ago";
        }
        if($time_minitues > 60 && $time_minitues < 1440){
        	$time_hours = intval($time_minitues/60);
        	return $time_hours. " hours ago";
        }
        if($time_minitues > 1440 && $time_minitues < 43200){
        	$time_hours = intval($time_minitues/60);
        	$time_days = intval($time_hours/24);
        	return $time_days. " days ago";
        }
        if($time_minitues > 43200 && $time_minitues < 518400){
        	$time_hours = intval($time_minitues/60);
        	$time_days = intval($time_hours/24);
        	$time_months = intval($time_days/30);
        	return $time_months. " months ago";
        }

        if($time_minitues > 518400){
        	$time_hours = intval($time_minitues/60);
        	$time_days = intval($time_hours/24);
        	$time_months = intval($time_days/30);
        	$time_years = intval($time_months/12);
        	return $time_years. " years ago";
        }
    }

    public static function updateActivityLog($action, $function_name){
        $activityLog = new DtbActivityLog;
        $activityLog->developer_id = Session::get('developer_id');
		$activityLog->user_id = Session::get('user_id');
		$user_details = DtbUser::find(Session::get('user_id'));
		$activityLog->user_name = $user_details->name;
		$activityLog->icon_image_path = $user_details->icon_image_path;
		$activityLog->function_name = $function_name;
        $activityLog->action = $action;   
		$result = $activityLog->save();
	}

    public static function updateActivityLogPro($action, $function_name, $project_id){
        if(!empty($project_id)){
            $project_idd = $project_id;
        }
        else{
            $project_idd = '';
        }
        $activityLog = new DtbActivityLog;
        $activityLog->developer_id = Session::get('developer_id');
        $activityLog->user_id = Session::get('user_id');
        $user_details = DtbUser::find(Session::get('user_id'));
        $activityLog->user_name = $user_details->name;
        $activityLog->icon_image_path = $user_details->icon_image_path;
        $activityLog->function_name = $function_name;
        $activityLog->project_id = $project_idd;
        $activityLog->action = $action;   
        $result = $activityLog->save();
    }

    public static function isSameDeveloperGroup($project_or_issue_id, $project){
        if($project=='project'){
            $project_developer_id = DtbProject::select('developer_id')->where('id',$project_or_issue_id)->first();

            if(isset($project_developer_id->developer_id)){
                if(Session::get('developer_id') == $project_developer_id->developer_id){
                    return "match";
                }
                else{
                    return "mismatch";
                }
            }
            else{
                return "mismatch";
            }
        }
        if($project=='issue'){
            $project_developer_id = DtbIssue::select('developer_id')->where('id',$project_or_issue_id)->first();

            if(isset($project_developer_id->developer_id)){
                if(Session::get('developer_id') == $project_developer_id->developer_id){
                    return "match";
                }
                else{
                    return "mismatch";
                }
            }
            else{
                return "mismatch";
            }
        }
        
    }

}
