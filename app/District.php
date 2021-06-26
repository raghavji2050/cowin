<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $guarded 	 = [];
	public $incrementing = false;
	public $timestamps   = false;

	public function centers()
	{
		return $this->hasMany(Center::class);
	}

	public function state()
	{
		return $this->belongsTo(State::class);
	}
}
