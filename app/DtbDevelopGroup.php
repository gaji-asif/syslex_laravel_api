<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbDevelopGroup extends Model
{
    protected $guarded = [];

    public function dtbissue(){
        return $this->hasOne(DtbIssue::class,'developer_id');
    }

    public function dtbuser(){
        return $this->hasOne(DtbUser::class,'developer_id');
    }



}
