<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MtbTimezone extends Model
{
    protected $guarded = [];
    
    public function dtbtimezone(){
        return $this->hasMany(Dtbtimezone::class);
    }

}
