<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $table = 'storage';

    protected $fillable = ['pillow', 'duvet', 'bedsheet', 'bedclothes'];

}
