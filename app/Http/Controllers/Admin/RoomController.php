<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequest;
use App\Http\Requests\RoomUpdateRequest;
use Illuminate\Http\Request;
use App\Services\RoomServices;
use Yajra\DataTables\DataTables;
use App\Models\Room;
use App\Models\RoomCategory;
use Illuminate\Support\Facades\Redis;

class RoomController extends Controller
{
    //  index
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rooms = Room::all();
            return DataTables::of($rooms)
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="javascript:void(0)"  data-id="'.$row->id.'" class="btn btn-primary edit" data-bs-target="#editModal" data-bs-toggle="modal" >
                <i class="fas fa-edit"></i>
              </a>
              <a href="'.route('amenity.destroy',$row->id).'" id="delete_data" class="btn btn-danger">
              <i class="fas fa-trash"></i>
            </a>';
                    return $actionbtn;
                })
                ->editColumn('featured', function ($row) {
                    if ($row->featured == 1) {
                        return '<span class="featured btn btn-success" data-id = "'.$row->id.'" >Active</span>';
                    } else {
                        return '<span class="featured btn btn-warning" data-id = "'.$row->id.'" >Inactive</span>';
                    }
                })
                ->editColumn('category_id',function($row){
                    return $row->category->category_name;
                })
                ->rawColumns(['action','featured','category_id'])
                ->addIndexColumn()
                ->make(true);
        }
        $data['categories'] = RoomCategory::select('id','category_name')->get();
        return view('admin.content.room_management.rooms.index',$data);
    }

    //  store
    public function store(RoomRequest $request)
    {
        $request->validated();
        RoomServices::roomStore($request);
        return response()->json(['success' => 'Room Added Successfully.']);
    }

    //  featured or not
    public function statusUpdate(Request $request)
    {
        RoomServices::roomStatus($request);
        return response()->json(["success" => "Feature Status Changed Successfully"]);
    }

    //  room.edit 
    public function edit(Request $request)
    {
        RoomServices::roomEdit($request);
        $data = RoomServices::$data;
        return view('admin.content.room_management.rooms.edit',$data);
    }

    //  room.update
    public function update(RoomUpdateRequest $request)
    {
        $request->validated();
        RoomServices::roomUpdate($request);
        return response()->json([
            'success' => 'Room Updated Successfully',
        ]);
    }
}
