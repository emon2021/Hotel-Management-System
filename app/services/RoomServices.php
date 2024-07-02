<?php
namespace App\Services;

use App\Models\Room;
use Yajra\DataTables\DataTables;


class RoomServices
{
    //  room store
    public static function roomStore($request)
    {
        $request->validated();
        Room::create([
            'category_id' => $request->cat_id,
            'room_title' => $request->room_title,
            'room_rent' => $request->room_rent,
        ]);
    }

    //  room featured changed
    public static function roomStatus($request)
    {
        $featured = Room::findOrFail($request->id);
        if($featured->featured == 1)
        {
            $featured->update([
                'featured' => 0,
            ]);
        }else{
            $featured->update([
                'featured' => 1,
            ]);
        }
        return $featured;
    }
   
}