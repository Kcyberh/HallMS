<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;
    protected $fillable = ['key_code','hall_id'];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'key_room');
    }
}
