<?php
namespace App\services;
use App\Models\RoomCategory;
use Illuminate\Support\Str;

class RoomServices
{
    // rooms.category.store
    public static function roomCatStore($request)
    {
        RoomCategory::create([
            "category_name" => $request->category_name,
            "category_slug" => Str::slug($request->category_name,'-'),
        ]);
    }
    // rooms.category.index
    public static function roomCatIndex()
    {
        $roomCat = RoomCategory::select('id','category_name','category_status')->get();
        if(!$roomCat->count() > 0)
        {
            return false;
        }
        return $roomCat;
    }
}