<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['type','gender','price','hall_id','number'];

    public function Hall(){
        return $this->belongsTo(Hall::class);
    }
    
    public function Booking(){
        return $this->belongsTo(Booking::class);
    }
    public function keys()
    {
        return $this->belongsToMany(Key::class, 'key_room');
    }
    public function keyLogs()
{
    return $this->hasMany(KeyLog::class);
}
    
}
