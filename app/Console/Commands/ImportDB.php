<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ImportDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tables = [
            'states',
            'districts',
            'centers',
            'sessions'
        ];

        foreach($tables as $table) {
            DB::table($table)->truncate();
            $datas = config($table);
            print_r($datas);

            if ($datas) {
                foreach($datas as $data) {
                    print_r($data);
                    DB::table($table)->insert($data);
                }
            }
        }
    }
}
