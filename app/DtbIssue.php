<?php

namespace App;
use Session;

use Illuminate\Database\Eloquent\Model;

class DtbIssue extends Model
{
	protected $guarded = [];
    //protected $dates = ['deadline'];
    //for showing deadline field formatted.in view when use format() its showing error

    public function dtbdevelopgroup(){
		return $this->belongsTo(DtbDevelopGroup::class,'developer_id');
	}

	public function dtbissuecategory(){
		return $this->belongsTo(DtbIssueCategory::class,'category_id');
	}	

	public function dtbuserassignee(){
		return $this->belongsTo(DtbUser::class,'user_id');
	}	

	public function dtbproject(){
		return $this->belongsTo(DtbProject::class,'project_id');
	}	

	public function dtbpriority(){
		return $this->belongsTo(DtbIssuePriority::class,'issue_priority_id');
	}

    public function status(){
        return $this->belongsTo(DtbIssueStatus::class,'status');
    }



	// scope for getting issue list of logged in (developer_id) user only
	public function scopeIssueofloggeduser($query, $value){
        return $query->where('developer_id', $value);
    }


    public static function allIssues(){
       $developer_id = Session::get('developer_id');
       $user_id = Session::get('user_id');
       if(Session::has('role')){
            if(Session::get('role') == '0'){
                $issues = DtbIssue::query()
                ->from('dtb_issues as i')
                ->leftjoin('dtb_apps as a','i.app_id', '=', 'a.id')
                ->leftjoin('dtb_versions as v','i.version_id', '=', 'v.id')
                ->leftjoin('dtb_issue_statuses as s','i.status', '=', 's.id')
                ->leftjoin('dtb_issue_priorities as p','i.issue_priority_id', '=', 'p.id')
                ->leftjoin('dtb_issue_categories as c','i.category_id', '=', 'c.id')
                ->leftjoin('dtb_users as u','i.user_id', '=', 'u.id')
                ->where('i.developer_id', $developer_id)
                ->take(5)
                ->get([ 'i.*', 'a.app_name', 'v.version_name', 's.status_name', 'p.priority_name', 'c.category_name', 'u.name']);
            }
            else{
                $issues = DtbIssue::query()
                ->from('dtb_issues as i')
                ->leftjoin('dtb_apps as a','i.app_id', '=', 'a.id')
                ->leftjoin('dtb_versions as v','i.version_id', '=', 'v.id')
                ->leftjoin('dtb_issue_statuses as s','i.status', '=', 's.id')
                ->leftjoin('dtb_issue_priorities as p','i.issue_priority_id', '=', 'p.id')
                ->leftjoin('dtb_issue_categories as c','i.category_id', '=', 'c.id')
                ->leftjoin('dtb_users as u','i.user_id', '=', 'u.id')
                ->where('i.user_id', $user_id)
                ->take(5)
                ->get([ 'i.*', 'a.app_name', 'v.version_name', 's.status_name', 'p.priority_name', 'c.category_name', 'u.name']);
            }
        }
        return $issues;
    } 

    public static function projects(){
       $developer_id = Session::get('developer_id');
       $user_id = Session::get('user_id');
       if(Session::has('role')){
            if(Session::get('role') == '0'){
                $projects = DtbProject::where('developer_id',$developer_id)->get();
            }
            else{
                $projects = DtbUsersProject::query()
                ->from('dtb_users_projects as up')
                ->leftjoin('dtb_projects as p','up.project_id', '=', 'p.id')
                ->where('up.user_id', $user_id)
                ->get([ 'up.*']);
            }
        }
        return $projects;
    }


}
