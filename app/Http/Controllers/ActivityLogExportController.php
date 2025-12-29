<?php
namespace App\Http\Controllers;
use App\Exports\ActivityLogsExport;
use App\Helpers\ActivityLogger;
use App\Models\ActivityLog;
use Maatwebsite\Excel\Facades\Excel;
class ActivityLogExportController extends Controller
{
    public function exportExcel()
    {
    // optional: catat aktivitas export (akan menambah 1 baris log)
    ActivityLogger::log(event: 'export_excel', description: 'Export activity logs ke Excel');
    return Excel::download(new ActivityLogsExport, 'activity_logs.xlsx');
    }
}
