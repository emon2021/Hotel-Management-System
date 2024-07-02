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
}