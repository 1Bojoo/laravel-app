<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomBedClothes extends Model
{
    protected $table = 'roombedclothes';

    protected $fillable = ['reservation_id', 'pillow', 'duvet', 'bedsheet', 'bedclothes'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
