<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\State;
use App\District as DistrictModel;

class District extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:districts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store Districts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
		
		$this->client = new Client();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $states = State::all();

		foreach ($states as $state) {
			$this->storeDistrict($state->id);
		}
		
		if (!count($states)) {
			$this->error('No state found');
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
					DistrictModel::updateOrCreate([
						'id' => $district['district_id']
					], [
						'state_id' => $stateId,
						'name' => $district['district_name']
					]);
				}
				$this->error(count($response['districts']) . " successfully saved for stateId ". $stateId);
			} else {
				$this->error('No data found for stateId '. $stateId);
			}

		} catch (\Exception $ex) {
			$this->error($ex->getMessage());
		}
	}
}
