<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\State as StateModel;
use App\District;

class State extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:states';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store States';

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
        try {

		$response = $this->client->request('GET', 'https://cdn-api.co-vin.in/api/v2/admin/location/states', [
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
				StateModel::updateOrCreate([
					'id' => $state['state_id']
				], [
					'name' => $state['state_name']
				]);
			}
			$this->info(count($response['states']) . " successfully saved");
		} else {
			$this->error('No data found');
			return;
		}

		} catch (\Exception $ex) {
			$this->error($ex->getMessage());
			return;
		}
    }
}
