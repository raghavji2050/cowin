<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Session;
use App\District;
use App\Jobs\SessionJob;

class SessionController extends Controller
{
	public function index(Request $request)
	{
		$sessions = Session::when($request->center, function ($query) use ($request) {
								$query->where('centers.id', $request->center);
							})->join('centers', 'sessions.center_id', 'centers.id')->select('centers.*', 'sessions.*', 'centers.name as center_name')->paginate(10);

		return view('sessions', compact('sessions'));
	}

    public function store(Request $request)
	{
		$districts = District::orderBy('id')->offset(0)->limit(1000)->get();

		foreach ($districts as $district) {
			SessionJob::dispatch($district);
		}

		// Artisan::call('save:sessions');

		return redirect()->route('sessions.index');
	}
}
