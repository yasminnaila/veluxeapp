<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ActivityLogger;
use App\Helpers\ChangeDetector;

class reservation extends Model
{
    use HasFactory;

    protected $fillable = ['guests_id', 'room_id', 'check_in', 'check_out'];

    public function guests()
    {
        return $this->belongsTo(Guest::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    protected static function booted()
    {
        static::created(function ($model) {
            ActivityLogger::log('created', $model, "Menambahkan reservasi baru #{$model->id}");
        });

        static::updated(function ($model) {
            $changes = ChangeDetector::detect($model->getOriginal(), $model->getAttributes());
            ActivityLogger::log('updated', $model, "Mengubah data reservasi #{$model->id} - {$changes}");
        });

        static::deleted(function ($model) {
            ActivityLogger::log('deleted', $model, "Hapus data reservasi #{$model->id}");
        });
    }
}
