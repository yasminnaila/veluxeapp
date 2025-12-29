<?php
namespace App\Http\Controllers;
use App\Exports\ActivityLogsExport;
use App\Helpers\ActivityLogger;
use App\Models\ActivityLog;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
class ActivityLogExportController extends Controller
{
    public function exportExcel()
    {
    // optional: catat aktivitas export (akan menambah 1 baris log)
    ActivityLogger::log(event: 'export_excel', description: 'Export activity logs ke Excel');
    return Excel::download(new ActivityLogsExport, 'activity_logs.xlsx');
    }

    public function exportPdf()
    {
        ActivityLogger::log(event: 'export_pdf', description: 'Export activity logs ke PDF');

        $logs = ActivityLog::query()->orderByDesc('created_at')->get();

        if (!view()->exists('exports.activity-logs')) {
            Log::error('Export view not found: exports.activity-logs');
            abort(500, 'Template export tidak ditemukan.');
        }

        try {
            $pdf = Pdf::loadView('exports.activity-logs', compact('logs'));
            return $pdf->download('activity_logs.pdf');
        } catch (\Throwable $e) {
            Log::error('Failed to generate activity logs PDF: ' . $e->getMessage());
            abort(500, 'Gagal membuat file PDF.');
        }
    }
}
