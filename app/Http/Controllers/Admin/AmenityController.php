<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomAmenity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AmenityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $amenities = RoomAmenity::all();
            return DataTables::of($amenities)
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="javascript:void(0)"  data-id="'.$row->id.'" class="btn btn-primary edit" data-bs-target="#editModal" data-bs-toggle="modal" >
                <i class="fas fa-edit"></i>
              </a>
              <a href="'.route('amenity.index',$row->id).'" id="delete_data" class="btn btn-danger">
              <i class="fas fa-trash"></i>
            </a>';
                    return $actionbtn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.content.room_management.amenities.index');
    }
}
