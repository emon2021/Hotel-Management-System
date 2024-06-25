<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomCategoryRequest;
use App\Http\Requests\RoomCategoryUpdateRequest;
use App\services\RoomServices;
use Illuminate\Http\Request;

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
     // rooms.category.edit
     public function edit(Request $request)  
     {

        $data = RoomServices::roomCatEdit($request);
        return response()->json($data);
     }
     // rooms.category.update
     public function update(RoomCategoryUpdateRequest $request)  
     {

        $data = RoomServices::roomCatUpdate($request);
        return response()->json([
            'message' => 'Room Category Updated Successfully',
            'data' => $data->category_name
        ]);
     }
     // rooms.category.destroy
     public function destroy($id)  
     {
        RoomServices::roomCatDestroy($id);
        return response()->json("Room Category Deleted Successfully");
     }
}
