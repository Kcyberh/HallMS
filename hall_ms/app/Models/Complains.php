<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complains extends Model
{
    use HasFactory;

    protected $fillable = ['time_date','statement','user_id','resident_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
