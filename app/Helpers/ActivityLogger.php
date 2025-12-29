<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ActivityLogger
{
    public static function log($event, $model = null, $description = null, $meta = [])
    {
        $user = Auth::user();

        ActivityLog::create([
            'user_id' => $user?->id,
            'username' => $user?->name,
            'event' => $event,
            'description' => $description,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }

    // Membuat deskripsi perubahan
    public static function makeUpdateDescription($old, $new)
    {
        // field yang ditampilkan (biar tidak panjang)
        $fields = [
            'guests_id' => 'Tamu',
            'room_id' => 'Kamar',
            'check_in' => 'Check-in',
            'check_out' => 'Check-out',
        ];

        $changes = [];

        foreach ($fields as $key => $label) {
            if (!array_key_exists($key, $old) || !array_key_exists($key, $new)) {
                continue;
            }

            if ($old[$key] != $new[$key]) {
                $changes[] = "{$label}: '{$old[$key]}' → '{$new[$key]}'";
            }
        }

        // jika tidak ada perubahan bermakna
        return empty($changes) ? "Perubahan kecil pada data" : implode(', ', $changes);
    }

    /**
     * Format deskripsi delete (aman)
     */
    public static function makeDeleteDescription($model, $prefix = "Menghapus data")
    {
        $id = $model->id ?? '-';
        return "{$prefix} #{$id}";
    }

    /**
     * Format create
     */
    public static function makeCreateDescription($model, $text = "Menambahkan data")
    {
        return "{$text} #{$model->id}";
    }
}
