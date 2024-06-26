<?php
namespace App\Services;

use App\Models\RoomCategory;
use Illuminate\Support\Str;

class RoomCategoryServices
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
    // rooms.category.edit
    public static function roomCatEdit($request)
    {
        $id = $request->id;
        $roomCat = RoomCategory::find($id);
        return $roomCat;
    }
    // rooms.category.update
    public static function roomCatUpdate($request)
    {
        $id = $request->id;
        $roomCat = RoomCategory::find($id);
        $roomCat->update([
            "category_name" => $request->category_name,
            "category_slug" => Str::slug($request->category_name,'-'),
        ]);
        return $roomCat;
    }
    // rooms.category.destroy
    public static function roomCatDestroy($id)
    {
        $roomCat = RoomCategory::findOrFail($id);
        $roomCat->delete();
        return $roomCat;
    }
    // rooms.category.status
    public static function roomCatStatus($id)
    {
        $roomCatStatus = RoomCategory::findOrFail($id);
        if($roomCatStatus->category_status == 1)
        {
            $roomCatStatus->update([
                "category_status" => 2
            ]);
        }else{
            $roomCatStatus->update([
                "category_status" => 1
            ]);
        }
        return $roomCatStatus;
    }
}