<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DbList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:list {table_name? : Name of the table to list records from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all tables in the database. If you want to see the records of a specific table, use the command: db:list {table_name}';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tableName = $this->argument('table_name');
        
        if($tableName) {
            $records = DB::table($tableName)->get();
            $this->info("Records in table '$tableName':");
            $this->table(array_keys((array)$records->first()), $records->toArray());
        } else {
            $tables = DB::select('SHOW TABLES');
            $this->info('Tables in the database:');
            foreach ($tables as $table) {
                $tableName = array_values((array)$table)[0];
                $this->line($tableName);
            }
        }
    }
}
