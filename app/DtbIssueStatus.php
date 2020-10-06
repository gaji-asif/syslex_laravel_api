<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbIssueStatus extends Model
{

	protected $guarded = [];
    public function dtbproject(){
		return $this->belongsTo(DtbProject::class,'project_id');
	}

	 public function dtbissue(){
		return $this->hasOne(DtbIssue::class,'status');
	}
	
	public static function getIssueStatus($project_id){
	    $issueStatuss = DtbIssueStatus::query()
    	->from('dtb_issue_statuses as is')
    	->where('is.project_id', $project_id)
    	->where('is.is_true', 1)
    	->orderBy('is.ordering','ASC')
    	->get(['is.id', 'is.status_name']);
    	return $issueStatuss;
	}
	

	public static function getNotIssueStatus($project_id){
	    $issueStatuss = DtbIssueStatus::query()
	    ->from('dtb_issue_statuses as is')
	    ->leftjoin('dtb_issue_statuses as lis','lis.id', '=', 'is.condition_id')
	    ->where('is.project_id', $project_id)
	    ->where('is.is_true', 0)
	    ->orderBy('lis.ordering','ASC')
	    ->get(['is.condition_id as id', 'is.status_name']);
	    return $issueStatuss;
	}
	
}
