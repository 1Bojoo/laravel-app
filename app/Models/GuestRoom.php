<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestRoom extends Model
{
    protected $table = 'guest_rooms';

    protected $fillable = ['annID', 'roomNum', 'floor', 'isOwned'];

    public function announcement(){
        return $this->belongsTo(Announcement::class);
    }

    public function reservation(){
        return $this->hasMany(Reservation::class);
    }
}
