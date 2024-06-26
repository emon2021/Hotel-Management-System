<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_title','category_id','featured','room_rent'
    ];

    //  relationship
    public function category()
    {
        return $this->belongsTo(RoomCategory::class,'category_id');
    }
    
}
