<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DtbTimezone extends Model
{
    protected $guarded = [];

    public function timezones(){
		return $this->belongsTo(MtbTimezone::class);
	} 

	public function languages(){
		return $this->belongsTo(MtbLanguage::class);
	}

}
