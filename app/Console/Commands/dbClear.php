<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;
use Illuminate\Support\Facades\DB;

class dbClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:clear {table_name : Name of the table to clear records from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tableName = $this->argument('table_name');

        try {
            DB::table($tableName)->truncate();
            $this->info("All records cleared from table '$tableName'.");
        } catch (Exception $e) {
            $this->error("Error clearing records: " . $e->getMessage());
        }
    }
}
