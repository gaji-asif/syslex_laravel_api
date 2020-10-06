<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbIssuePriority extends Model
{
	protected $guarded = [];
	
   	public function dtbissue(){
		return $this->hasOne(DtbIssue::class,'issue_priority_id');
	}
}
