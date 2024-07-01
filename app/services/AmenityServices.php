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

    //  amenity deleting
    public static function amenityDestroy($id)
    {
        $amenity = RoomAmenity::find($id);
        $amenity->delete();
        return $amenity;
    }
    //  amenity status update
    public static function amenityStatusUpdate($request)
    {
        //dd($request->id);
        $amenity = RoomAmenity::findOrFail($request->id);
        //dd($amenity);
        if ($amenity->amenity_status == 1) {
            $amenity->amenity_status = 0;
            $amenity->save();
        } else {
            $amenity->amenity_status = 1;
            $amenity->save();
        }
        return $amenity;
    }
}