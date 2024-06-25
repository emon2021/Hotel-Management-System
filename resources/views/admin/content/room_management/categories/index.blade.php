@extends('layouts.admin')

@section('admin_content')
    @push('title')
        <title>Admin|HMS|Rooms|Categories</title>
    @endpush
    <div class="container float-end" style="float:right;width:82%">
        <div class="row overflow-hidden">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <table class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th >SL</th>
                        <th >Category Name</th>
                        <th >Category Status</th>
                        <th >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roomCats as $roomCat)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-----special types of variable for blade file in the loops---->
                            <td>{{ $roomCat->category_name }}</td>
                            <td>
                                @if($roomCat->status == 1)
                                    <a href="" class="btn btn-success">Active</a>
                                @else
                                    <a href="" class="btn btn-danger">Inactive</a>
                                @endif
                            <td>
                                <a href="" class="btn btn-info">
                                    <i class="fas fa-edit"></i>
                                </a> 
                                <a href="" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection