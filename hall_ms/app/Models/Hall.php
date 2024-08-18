<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = ['name','block','location','capacity'];

    public function Room(){
        return $this->hasMany(Room::class);
    }
    public function Booking()
    {
        return $this->hasMany(Booking::class);
    }
}
