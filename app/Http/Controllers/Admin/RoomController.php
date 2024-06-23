<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     public function store()
     {
        
     }
}
