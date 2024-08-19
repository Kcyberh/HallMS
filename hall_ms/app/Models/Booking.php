<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable =['started_at','ending_at',
    'user_id','room_id','hall_id',
    'gender','telephone','age','status'];

    public function Room(){
        return $this->belongsTo(Room::class);
    }
    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment(){
        return $this->hasMany(Payment::class, 'user_id');
    }
    public function resident()
    {
        return $this->hasMany(Resident::class);
    }
}
