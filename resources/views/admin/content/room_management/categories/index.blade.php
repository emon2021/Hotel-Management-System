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
                            
                                <h3 class="table-caption text-center bg-dark text-light p-2">Room Categories</h3>
                            
                        </tr>
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
                            <td class="cat_name">{{ $roomCat->category_name }}</td>
                            <td>
                                @if($roomCat->category_status == 1)
                                    <a href="{{ route("admin.rooms.category.status",$roomCat->id) }}" class="statusUpdate btn btn-success">Active</a>
                                @else
                                    <a href="{{ route("admin.rooms.category.status",$roomCat->id) }}"  class="statusUpdate btn btn-danger">Inactive</a>
                                @endif
                            <td>
                                <a href="#" id="edit" data-id="{{ $roomCat->id }}" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-edit"></i>
                                </a> 
                                <a href="{{ route("admin.rooms.category.destroy",$roomCat->id) }}" class="delete btn btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{-- edit room category modal --}}
  
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Room Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.rooms.category.update') }}" id="roomsCat" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="hidden" id="id" name="id">
                                    <input type="text" name="category_name"
                                        class="form-control cat_name @error('category_name') is-invalid @enderror"  placeholder="Category Name">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('category_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row" style="padding-bottom:1rem">
                                    <!-- /.col -->
                                    <div class="col-8"></div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block" style="width: 8.7rem; margin-right:0.2rem">UPDATE</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                
                <form action="" method="post" id="delete">
                    @csrf
                    @method('DELETE')
                </form>

            </div>

        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        //  getting edit data
        $('body').on('click','#edit',function(e){
            e.preventDefault();
            let get_id = $(this).data('id');
            $.ajax({
                url:"{{ route('admin.rooms.category.edit') }}",
                type:'GET',
                data:{
                    id:get_id
                },
                success:function(response){
                   $('.cat_name').val(response.category_name);
                   $("#id").val(response.id);
                },
                error:function(xhr,status,failed){
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value){
                       toastr.error(value[0]);
                    });
                },
            });
        });

        //  updating data
        $('body').on('submit','#roomsCat',function(e){
            e.preventDefault();
            let get_route = $(this).attr('action');
            let form_data = new FormData($(this)[0]);
            $.ajax({
                url:get_route,
                type:'POST',
                data:form_data,
                processData: false,
                contentType: false,
                success:function(response){
                   toastr.success(response.message);
                   $('#roomsCat')[0].reset();
                   
                   // reloading table
                   window.location.reload();
                   
                },
                error:function(xhr,status,failed){
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value){
                       toastr.error(value[0]);
                    });
                },
            });
        });

        //  deleting data
        $('body').on('click','.delete',function(e){
            e.preventDefault();
            let get_route = $(this).attr('href');
            let set_route = $('#delete').attr('action',get_route);
            $('#delete').submit();

            $(this).parent().parent().remove();
            
        });

        $('#delete').submit(function(event){
            event.preventDefault();
            let get_route = $(this).attr('action');
            let form_data = new FormData($(this)[0]);
            $.ajax({
                url:get_route,
                type:'post',
                data:form_data,
                async: false,
                contentType: false,
                processData: false,
                success:function(response){
                   toastr.success(response);
                   // reloading table
                },
                error:function(xhr,status,failed){
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value){
                       toastr.error(value[0]);
                    });
                },
            });
        });

        //  status updating
        $('body').on('click','.statusUpdate',function(e){
            e.preventDefault();
            let get_route = $(this).attr('href');
            $.ajax({
                url: get_route,
                type: 'get',
                success: function (response) {
                    toastr.success(response);
                    // reloading table
                    window.location.reload();
                },
                error: function (xhr, status, failed) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        toastr.error(value[0]);
                    });
                },
            });
        });
        
    });
</script>
@endpush