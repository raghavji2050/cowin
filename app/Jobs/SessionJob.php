<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use App\Session as SessionModel;
use App\District;
use App\Center;

class SessionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($district)
    {
		$this->districtId = $district;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->storeSessions($this->districtId);
    }

	public function storeSessions($districtId)
	{
		try {
		    $client = new Client();

			$response = $client->request('GET', 'https://cdn-api.co-vin.in/api/v2/appointment/sessions/public/findByDistrict?district_id='.$districtId.'&date='.today()->format('d-m-Y'), [
				'headers' => [
					'content-type' => 'application/json',
					'charset' => 'utf-8',
					'user-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36',
				]
			]);

			$response = $response->getBody();
			$response = json_decode($response, true);
			
			if (isset($response['sessions'])) {
				foreach($response['sessions'] as $session) {

					$center = Center::updateOrCreate([
						'id'		  => $session['center_id'],
						'district_id' => $districtId,
					], [
						'name' 		  => $session['name'] ?? null,
						'address' 	  => $session['address'] ?? null,
						'block_name' 	=> $session['block_name'] ?? null,
						'pincode' 		=> $session['pincode'] ?? null,
					]);
					
					SessionModel::updateOrCreate([
						'center_id' => $center->id,
						'date' 		=> $session['date'],
					], [
						'from' 		  	=> $session['from'] ?? null,
						'to' 		 	=> $session['to'] ?? null,
						'lat' 		  	=> $session['lat'] ?? null,
						'long' 		  	=> $session['long'] ?? null,
						'fee_type' 		=> $session['fee_type'] ?? null,
						'session_id' 	=> $session['session_id'] ?? null,
						'available_capacity' 	   => $session['available_capacity'] ?? null,
						'available_capacity_dose1' => $session['available_capacity_dose1'] ?? null,
						'available_capacity_dose2' => $session['available_capacity_dose2'] ?? null,
						'fee' 		  	=> $session['fee'] ?? null,
						'min_age_limit' => $session['min_age_limit'] ?? null,
						'vaccines' 		=> $session['vaccine'] ?? null,
						'slots' 		=> $session['slots'] ?? null,
					]);
				}
				print_r(count($response['sessions']) . " successfully saved for districtId ". $districtId);
				return;
			} else {
				print_r('No data found for districtId '. $districtId);
				return;
			}

		} catch (\Exception $ex) {
			print_r($ex->getMessage());return;
		}
	}
}
