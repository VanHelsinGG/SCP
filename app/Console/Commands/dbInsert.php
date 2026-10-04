<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Exception;

class dbInsert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:insert {table_name : Name of the table to insert records into} {--columns= : Comma-separated list of column names} {--values= : Comma-separated list of values corresponding to the columns}';

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
        // Get the table name, columns, and values from the command arguments and options
        $tableName = $this->argument('table_name');
        $columns = $this->option('columns');
        $values = $this->option('values');

        if (!$columns || !$values) {
            $this->error('Both --columns and --values options are required.');
            return;
        }

        // Convert the comma-separated strings into arrays
        $columnsArray = array_map('trim', explode(',',$columns));
        $valuesArray = array_map('trim', explode(',',$values));

        if(count($columnsArray) !== count($valuesArray)) {
            $this->error('The number of columns and values must match.');
            return;
        }

        // Create an associative array for the insert operation
        $data = array_combine($columnsArray, $valuesArray);

        // Insert the data into the specified table
        try {
            DB::table($tableName)->insert($data);
            $this->info("Record inserted successfully into table '$tableName'.");
        } catch (Exception $e) {
            $this->error("Error inserting record: " . $e->getMessage());
        }
    }
}
