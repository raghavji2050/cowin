<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded   = [];
	public $incrementing = false;
	public $timestamps   = false;

	public function districts()
	{
		return $this->hasMany(District::class);
	}
}
