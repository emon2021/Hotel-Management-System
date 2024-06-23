<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomCategoryRequest;
use App\Models\RoomCategory;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    /**
     * This is for Rooms Management.
     */

     // rooms.category.create
     public function create()
     {
        return view("admin.content.room_management.categories.create");
     }
     // rooms.category.store
     public function store(RoomCategoryRequest $request)
     {
        $request->validated();
        RoomCategory::create([
            "category_name" => $request->category_name,
            "category_slug" => Str::slug($request->category_name,'-'),
        ]);

        return response()->json("Room Category Created Successfully");
     }
}
