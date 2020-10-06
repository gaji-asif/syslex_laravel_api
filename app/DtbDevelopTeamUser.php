<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbDevelopTeamUser extends Model
{
   
 	protected $guarded = [];

 	public function users(){
		return $this->belongsTo(DtbUser::class,'user_id');
	} 

	public function developteam(){
		return $this->belongsTo(DtbDevelopTeam::class,'team_id');
	} 


}
