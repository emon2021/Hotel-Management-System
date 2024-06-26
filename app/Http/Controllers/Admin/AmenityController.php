<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AmenityRequest;
use App\Http\Requests\AmenityUpdateRequest;
use App\Models\RoomAmenity;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Services\AmenityServices;

class AmenityController extends Controller
{
    //  fetching all amenities from database
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $amenities = RoomAmenity::all();
            return DataTables::of($amenities)
                ->addColumn('action', function ($row) {
                    $actionbtn = '<a href="javascript:void(0)"  data-id="'.$row->id.'" class="btn btn-primary edit" data-bs-target="#editModal" data-bs-toggle="modal" >
                <i class="fas fa-edit"></i>
              </a>
              <a href="'.route('amenity.destroy',$row->id).'" id="delete_data" class="btn btn-danger">
              <i class="fas fa-trash"></i>
            </a>';
                    return $actionbtn;
                })
                ->editColumn('amenity_status', function ($row) {
                    if ($row->amenity_status == 1) {
                        return '<span class="amenityStatus btn btn-success" data-id = "'.$row->id.'" >Active</span>';
                    } else {
                        return '<span class="amenityStatus btn btn-warning" data-id = "'.$row->id.'" >Inactive</span>';
                    }
                })
                ->rawColumns(['action','amenity_status'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.content.room_management.amenities.index');
    }

    //  amenity storing
    public function store(AmenityRequest $request)
    {
        $request->validated();
        AmenityServices::amenityStore($request);
        return response()->json(['success' => 'Amenity Created Successfully.']);
    }

    //  amenity editing
    public function edit(Request $request)
    {
        $amenity = RoomAmenity::find($request->id);
        return response()->json([
            'amenity_name' => $amenity->amenity_name,
            'id' => $amenity->id
        ]);
    }
    
    //  amenity updating
    public function update(AmenityUpdateRequest $request)
    {
        $request->validated();
        AmenityServices::amenityUpdate($request);
        return response()->json(['success' => 'Amenity Updated Successfully.']);
    }

    //  amenity deleting
    public function destroy($id)
    {
        AmenityServices::amenityDestroy($id);
        return response()->json(['success' => 'Amenity Deleted Successfully.']);
    }
    //  amenity status changing
    public function statusUpdate(Request $request)
    {
        AmenityServices::amenityStatusUpdate($request);
        return response()->json(['success' => 'Amenity Status Changed Successfully.']);
    }
}
