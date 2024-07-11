<?php
namespace App\Services;

use App\Models\Room;
use App\Models\RoomCategory;
use Yajra\DataTables\DataTables;


class RoomServices
{
    public static $data;
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

    //  room.edit
    public static function roomEdit($request)
    {
        self::$data['categories'] = RoomCategory::all();
        self::$data['room'] = Room::select('id','category_id','room_title','room_rent')->where('id',$request->id)->first();
        return self::$data;
    }

    //  room.update 
    public static function roomUpdate($request)
    {
        $room = Room::findOrFail($request->up_id);
        $room->update([
            'room_title' => $request->room_title,
            'category_id' => $request->cat_id,
            'room_rent' => $request->room_rent,
        ]);
        return $room;
    }

    //  room.delete
    public static function roomDestroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return $room;
    }
   
}