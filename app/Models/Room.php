<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ActivityLogger;
use App\Helpers\ChangeDetector;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'type', 'price', 'status'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    protected static function booted()
    {
        static::created(
            fn($m) =>
            ActivityLogger::log(
                event: 'created',
                description: "Menambah kamar baru #{$m->id}"
            )
        );

        static::updated(function ($m) {
            $changes = ChangeDetector::detect($m->getOriginal(), $m->getAttributes());

            ActivityLogger::log(
                event: 'updated',
                description: "Mengubah data kamar #{$m->id} - {$changes}"
            );
        });

        static::deleted(
            fn($m) =>
            ActivityLogger::log(
                event: 'deleted',
                description: "Hapus kamar #{$m->id}"
            )
        );
    }
}
