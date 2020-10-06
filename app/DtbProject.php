<?php

namespace App;
use Session;

use Illuminate\Database\Eloquent\Model;

class DtbProject extends Model
{
    protected $guarded = [];

    public function dtbissuestatus(){
        return $this->hasOne(DtbIssueStatus::class,'project_id');
    }    


    public function dtbissue(){
        return $this->hasMany(DtbIssue::class,'project_id');
    }


    public function dtbissuetype(){
        return $this->hasMany(DtbGenIssueType::class,'project_id');
    }


    // scope for getting projects of logged in (developer_id) user only
    public function scopeloggeduserproject($query, $value){
        return $query->where('developer_id', $value);
    }

    public static function loggeduserproject($developer_id){
       $user_id = Session::get('user_id');
       if(Session::has('role')){
            if(Session::get('role') == '0'){
                $projects = DtbProject::query()
                ->where('dtb_projects.developer_id', $developer_id)
                ->orderBy('ordering','ASC')
                ->get([ 'dtb_projects.*' ]);
            }
            else{
                $projects = DtbUsersProjects::query()
                ->from('dtb_users_projects as up')
                ->leftjoin('dtb_projects as p','up.project_id', '=', 'p.id')
                ->where('up.user_id', $user_id)
                ->orderBy('ordering','ASC')
                ->get([ 'p.*' ]);
            }
        }
        return $projects;
    }
    public static function getProjects(){
        $developer_id = Session::get('developer_id');
        $user_id = Session::get('user_id');
        //echo Session::get('user_id');
        //exit;
        if(Session::has('role')){
            if(Session::get('role') == '0'){
                $projects = DtbProject::query()
                ->where('dtb_projects.developer_id', $developer_id)
                ->where('is_archived',0)
                ->orderBy('ordering', 'ASC')
                ->get([ 'dtb_projects.*' ]);
            }
            else{
                $projects = DtbUsersProject::query()
                ->from('dtb_users_projects as up')
                ->join('dtb_projects as p','up.project_id', '=', 'p.id')
                ->where('up.user_id', 0)
                ->orderBy('p.ordering', 'ASC')
                ->get([ 'p.*' ]);
            }
        }
        return $projects;
    }
    
    public static function getAllProjects(){
        $developer_id = Session::get('developer_id');
        $user_id = Session::get('user_id');
        if(Session::has('role')){
            if(Session::get('role') == '0'){
                $projects = DtbProject::query()
                ->get([ 'dtb_projects.*' ]);
            }
            else{
                $projects = DtbUsersProject::query()
                ->from('dtb_users_projects as up')
                ->leftjoin('dtb_projects as p','up.project_id', '=', 'p.id')
                ->where('up.user_id', $user_id)
                ->get([ 'p.*' ]);
            }
        }
        return $projects;
    }
    
}
