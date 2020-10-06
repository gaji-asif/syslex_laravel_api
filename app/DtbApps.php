<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbApps extends Model
{
    protected $guarded = [];

    public static function getProjectApps($projectId){
        $projectApps = DtbApps::query()
        ->from('dtb_apps as i')
        ->where('i.project_id', $projectId)
        ->orderBy('i.ordering','ASC')
        ->orderBy('i.id','ASC')
        ->get(['i.*']);
        return $projectApps;
        
    }
        
    
}
