<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keylog extends Model
{
    use HasFactory;
    protected $fillable = ['key_room_id', 'user_id', 'action', 'details'];

    public function key()
    {
        return $this->belongsTo(Key::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
{
    return $this->belongsTo(Room::class, 'key_room_id');
}
}
