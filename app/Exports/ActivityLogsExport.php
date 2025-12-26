<?php

namespace App\Exports;

use App\Models\ActivityLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ActivityLogsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return ActivityLog::query()
            ->orderByDesc('created_at')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Username',
            'Event',
            'Deskripsi',
            'IP Address',
            'User Agent',
            'Waktu',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->user_id,
            $row->username,
            $row->event,
            $row->description,
            $row->ip_address,
            $row->user_agent,
            optional($row->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
