<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
