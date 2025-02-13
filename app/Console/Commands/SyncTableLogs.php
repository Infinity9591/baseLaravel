<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\TableLogs;

class SyncTableLogs extends Command
{
    protected $signature = 'sync:tablelogs';
    protected $description = 'Sync table_logs with existing database tables';
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {

        while (true) {
            sleep(10);
            $filters = ['table_log', 'permission', 'role_permission']; // Các bảng cần bỏ qua
            $database_table_names = DB::select('SHOW TABLES');

            $database_tables = array_map('current', $database_table_names);
            $table_names = array_diff($database_tables, $filters);

            foreach ($table_names as $tableName) {

                if (!TableLogs::where('table_name', $tableName)->exists()) {
                    TableLogs::insert(['table_name' => $tableName]);
                }
            }

            $tableLogs_table_names = TableLogs::pluck('table_name')->toArray();
            $diff = array_diff($tableLogs_table_names, $table_names);

            if (!empty($diff)) {
                TableLogs::whereIn('table_name', $diff)->delete();
            }

            $this->info('✅ TableLogs sync successfully.');
        }
//        $filters = ['table_log', 'permission', 'role_permission']; // Các bảng cần bỏ qua
//        $database_table_names = DB::select('SHOW TABLES');
//
//        $database_tables = array_map('current', $database_table_names);
//        $table_names = array_diff($database_tables, $filters);
//
//        foreach ($table_names as $tableName) {
//
//            if (!TableLogs::where('table_name', $tableName)->exists()) {
//                TableLogs::insert(['table_name' => $tableName]);
//            }
//        }
//
//        $tableLogs_table_names = TableLogs::pluck('table_name')->toArray();
//        $diff = array_diff($tableLogs_table_names, $table_names);
//
//        if (!empty($diff)) {
//            TableLogs::whereIn('table_name', $diff)->delete();
//        }
//
//        $this->info('✅ TableLogs sync successfully.');
//        echo base_path('routes/console.php');
//        echo '✅ TableLogs sync successfully.';
    }
}
