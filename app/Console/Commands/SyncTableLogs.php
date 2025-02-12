<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\TableLog;

class SyncTableLogs extends Command
{
    protected $signature = 'sync:tablelogs';
    protected $description = 'Sync table_logs with existing database tables';

    public function handle()
    {
        $filters = ['table_logs', 'permissions', 'role_permissions']; // Các bảng cần bỏ qua
        $database_table_names = DB::select('SHOW TABLES');

        // Lấy danh sách các bảng trong database
        $database_tables = array_map('current', $database_table_names);
        $table_names = array_diff($database_tables, $filters);

        // Thêm bảng mới vào table_logs
        foreach ($table_names as $tableName) {
            if (!TableLog::where('table_name', $tableName)->exists()) {
                TableLog::create(['table_name' => $tableName]);
            }
        }

        // Xóa bảng đã bị xóa khỏi database
        $tableLogs_table_names = TableLog::pluck('table_name')->toArray();
        $diff = array_diff($tableLogs_table_names, $table_names);
        if (!empty($diff)) {
            TableLog::whereIn('table_name', $diff)->delete();
        }

        $this->info('✅ TableLogs sync successfully.');
    }
}
