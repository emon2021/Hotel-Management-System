<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomAmenity extends Model
{
    use HasFactory;
    protected $fillable = [
        'amenity_name',
        'amenity_slug',
        
    ];
}
