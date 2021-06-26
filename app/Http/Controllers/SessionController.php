<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Session;

class SessionController extends Controller
{
	public function index(Request $request)
	{
		$sessions = Session::paginate(50);

		return view('sessions', compact('sessions'));
	}
    public function store(Request $request)
	{
		Artisan::call('save:sessions');

		return redirect()->route('sessions.index');
	}
}
