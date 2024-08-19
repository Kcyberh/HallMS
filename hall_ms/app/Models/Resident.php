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


    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }


}
