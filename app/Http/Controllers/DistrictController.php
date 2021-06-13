<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\State;
use App\District;

class DistrictController extends Controller
{
	public function __construct()
	{
		$this->client = new Client();
	}

    public function store(Request $request)
	{
		$states = State::all();

		foreach ($states as $state) {
			$this->storeDistrict($state->id);
		}
	}

	public function storeDistrict($stateId)
	{
		try {
			$response = $this->client->request('GET', 'https://cdn-api.co-vin.in/api/v2/admin/location/districts/'.$stateId, [
				'headers' => [
					'content-type' => 'application/json',
					'charset' => 'utf-8',
					'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
				]
			]);

			$response = $response->getBody();
			$response = json_decode($response, true);

			if (isset($response['districts'])) {
				foreach($response['districts'] as $district) {
					District::updateOrCreate([
						'id' => $district['district_id']
					], [
						'state_id' => $stateId,
						'name' => $district['district_name']
					]);
				}
				echo "<pre>"; print_r(count($response['districts']) . " successfully saved for stateId ". $stateId);
			} else {
				echo "<pre>"; print_r('No data found for stateId '. $stateId);
			}

		} catch (\Exception $ex) {
			echo "<pre>"; print_r($ex->getMessage());die;
		}
	}
}
