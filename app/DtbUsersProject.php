<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbUsersProject extends Model
{

	protected $guarded = [];


    public function projects(){
      return $this->belongsTo('App\DtbProject', 'project_id', 'id');
     }

	public function users(){
		return $this->belongsTo(DtbUser::class,'user_id');
	}
	




}
