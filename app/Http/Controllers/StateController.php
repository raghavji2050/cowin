<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
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
		$client = new Client();
		try {

		$response = $client->request('GET', 'https://cdn-api.co-vin.in/api/v2/admin/location/states', [
			'headers' => [
				'content-type' => 'application/json',
				'charset' => 'utf-8',
				'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
			]
		]);
		$response = $response->getBody();
		$response = json_decode($response, true);

		if (isset($response['states'])) {
			foreach($response['states'] as $state) {
				State::updateOrCreate([
					'id' => $state['state_id']
				], [
					'name' => $state['state_name']
				]);
			}
			echo "<pre>"; print_r(count($response['states']) . " successfully saved");die;
		} else {
			echo "<pre>"; print_r('No data found');die;
		}

		} catch (\Exception $ex) {
			echo "<pre>"; print_r($ex->getMessage());die;
		}
	}
}
