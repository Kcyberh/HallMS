<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['amount','image','user_id','booking_id','status','channel'];
    
    public function Booking(){
        return $this->belongsTo(Booking::class);
    }
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
