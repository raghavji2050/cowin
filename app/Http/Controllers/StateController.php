<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use App\State;

class StateController extends Controller
{
	public function index()
	{
		$states = State::get()->toArray();

		return view('states', compact('states'));
	}

    public function store(Request $request)
	{
		Artisan::call('save:states');
	}
}
