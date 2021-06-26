<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class DistrictController extends Controller
{
	public function store(Request $request)
	{
		Artisan::call('save:districts');

		return redirect()->route('states.index');
	}
}
