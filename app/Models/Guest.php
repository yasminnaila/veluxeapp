<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ActivityLogger;
use App\Helpers\ChangeDetector;

class Guest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'contact',
    ];

    protected static function booted()
    {
        static::created(
            fn($m) =>
            \App\Helpers\ActivityLogger::log(
                event: 'created',
                description: "Menambah data tamu #{$m->id}"
            )
        );

        static::updated(function ($m) {
            $changes = ChangeDetector::detect($m->getOriginal(), $m->getAttributes());

            ActivityLogger::log(
                event: 'updated',
                description: "Mengubah data tamu #{$m->id} - {$changes}"
            );
        });

        static::deleted(
            fn($m) =>
            ActivityLogger::log(
                event: 'deleted',
                description: "Hapus tamu #{$m->id}"
            )
        );
    }
}
