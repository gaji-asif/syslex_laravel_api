<?php

namespace App;
use Session;

use Illuminate\Database\Eloquent\Model;

class DtbDevelopTeam extends Model
{

   protected $guarded = [];

    public static function addTeam($request){
    	$developer_id = Session::get('developer_id');
    	$teams = new DtbDevelopTeam;
    	$teams->team_name = $request->team_name;
    	$teams->developer_id = $developer_id;
    	$results = $teams->save();
    	return $results;
    }

    public static function updateTeam($request, $id){
    	$teams = DtbDevelopTeam::find($id);
    	$teams->team_name = $request->team_name;
    	$results = $teams->update();
    	return $results;
    }


    public function devteamuser(){
        return $this->hasMany(DtbDevelopTeamUser::class,'team_id');
    }



}
