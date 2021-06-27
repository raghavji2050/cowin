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
        $local_database = DB::connection('mysql');

        $tables = [
            'states',
            'districts',
            'centers',
            'sessions'
        ];

        foreach($tables as $table) {
            DB::connection('pgsql')->statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::connection('pgsql')->table($table)->truncate();

            print_r($table);
           
            foreach($local_database->table('states')->get() as $data) {
                print_r($data);
                DB::connection('pgsql')->table('states')->insert((array) $data);
            }

            DB::connection('pgsql')->statement('SET FOREIGN_KEY_CHECKS=1;');
        }

    }
}
