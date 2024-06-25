<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomCategoryRequest;
use App\services\RoomServices;

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

        RoomServices::roomCatStore($request);

        return response()->json("Room Category Created Successfully");
     }
     // rooms.category.index
     public function index()
     {

        $data['roomCats'] = RoomServices::roomCatIndex();

        return view('admin.content.room_management.categories.index',$data);
     }
}
