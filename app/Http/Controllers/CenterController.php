<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Center;
use App\District;

class CenterController extends Controller
{
    public function index(Request $request)
	{
		$districts = District::orderBy('name')->get();

		$blocks = Center::join('districts', 'districts.id', 'centers.district_id')->select('districts.*', 'centers.*', 'districts.name as district_name')
						->when($request->district, function ($query) use ($request) {
							$query->where('districts.id', $request->district);
						})
						->where('districts.id', $request->district)
						->orderBy('districts.name')
						->get();
						//->groupBy('block_name');
echo "<pre>";print_r($blocks->toArray());die;

		$centers = Center::join('districts', 'districts.id', 'centers.district_id')->select('districts.*', 'centers.*', 'districts.name as district_name')
						->when($request->district, function ($query) use ($request) {
							$query->where('districts.id', $request->district);
						})
						->when($request->block, function ($query) use ($request) {
							$query->where('centers.block_name', $request->block);
						})
						->orderBy('districts.name')
						->paginate(50);

		return view('center', compact('centers', 'districts', 'blocks'));
	}
}
