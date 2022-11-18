<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $table = 'announcements';

    protected $fillable = ['name', 'desc', 'price', 'country', 'city', 'province', 'street', 'hNum', 'postalCode', 0, 'image'];
}
