<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $guarded   = [];
	protected $casts = [
		'slots' => 'array'
	];

	public function center()
	{
		return $this->belongsTo(Center::class);
	}
}
