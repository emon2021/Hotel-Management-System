<?php
namespace App\services;

use App\Models\RoomAmenity;
use Illuminate\Support\Str;

class AmenityServices
{
    //  amenity storing
    public static function amenityStore($request)
    {
        RoomAmenity::create([
            "amenity_name" => $request->amenity_name,
            "amenity_slug" => Str::slug($request->amenity_name,'-'),
        ]);
    }

    //  amenity updating
    public static function amenityUpdate($request)
    {
        $amenity = RoomAmenity::find($request->id);
        $amenity->update([
            "amenity_name" => $request->amenity_name,
            "amenity_slug" => Str::slug($request->amenity_name,'-'),
        ]);
        return $amenity;
    }
}