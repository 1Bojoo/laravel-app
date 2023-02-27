<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitory extends Model
{
    protected $table = 'dormitory';

    protected $fillable = ['userID', 'name', 'desc', 'price', 'country', 'city', 'province', 'street', 'hNum', 'postalCode', 0, 'image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
