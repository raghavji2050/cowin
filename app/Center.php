<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $guarded 	 = [];
	public $incrementing = false;
	public $timestamps   = false;

	public function sessions()
	{
		return $this->hasMany(Session::class);
	}
}
