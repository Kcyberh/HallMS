<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;
    protected $fillable = ['image','guardian_name','guardian_phone',
    'guardian_address','occupation',
    'user_id','booking_id','payment_id'];


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }



}
