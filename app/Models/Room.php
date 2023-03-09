<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';

    protected $fillable = ['dormId', 'roomNum', 'floor', 'isOwned'];

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }

    public function reservation(){
        return $this->hasMany(Reservation::class);
    }
}
