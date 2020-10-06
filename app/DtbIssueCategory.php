<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbIssueCategory extends Model
{

	protected $guarded = [];
	
    public function dtbissue(){
		return $this->hasOne(DtbIssue::class,'category_id');
	}
}
