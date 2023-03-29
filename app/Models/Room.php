<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = ['dormId', 'roomNum', 'floor', 'isOwned'];

    public function dorm(){
        return $this->belongsTo(Dormitory::class);
    }

    public function reservation(){
        return $this->hasMany(Reservation::class);
    }

}
