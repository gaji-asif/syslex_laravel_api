<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbGenIssueType extends Model
{
	protected $guarded = [];
    public function projects(){
		return $this->belongsTo(DtbProject::class,'project_id');
	} 
	
	public static function getProjectIssueType($projectId){
	    $issueTypes = DtbApps::query()
	    ->from('dtb_gen_issue_types as gi')
	    ->where('gi.project_id', $projectId)
	    ->orderBy('gi.ordering','ASC')
	    ->orderBy('gi.id','ASC')
	    ->get(['gi.*']);
	    return $issueTypes;
	    
	}
	
}
