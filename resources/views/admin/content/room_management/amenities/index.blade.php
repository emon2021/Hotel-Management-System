@extends('layouts.admin')

@section('admin_content')
    @push('title')
        <title>Admin|HMS|Rooms|Categories</title>
    @endpush
    <div class="container float-end" style="float:right;width:82%">
        <div class="row overflow-hidden">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <table id="yTable" class="table table-striped text-center">
                    <thead>
                        <tr>
                            
                                <h3 class="table-caption text-center bg-dark text-light p-2">Amenities</h3>
                            
                        </tr>
                        <a href="#" class="btn btn-primary float-end mx-5 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add  &nbsp;&nbsp; +</a>
                    <tr>
                        <th >SL</th>
                        <th >Amenity Name</th>
                        <th >Amenity Status</th>
                        <th >Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                {{-- add amenity modal --}}
  
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Amenity</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('amenity.store') }}" id="amenityStore" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="hidden" id="id" name="id">
                                    <input type="text" name="amenity_name"
                                        class="form-control cat_name @error('amenity_name') is-invalid @enderror"  placeholder="Amenity Name">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                    @error('amenity_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="row" style="padding-bottom:1rem">
                                    <!-- /.col -->
                                    <div class="col-8"></div>
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block" style="width: 8.7rem; margin-right:0.2rem">ADD</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
                {{-- edit amenity modal --}}
  
                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Amenity</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('amenity.update') }}" id="amenityUpdate" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="hidden" value="" id="up_id" name="id">
                                    <input type="text" value="" name="amenity_name"
                                        class="form-control amenity_name "  placeholder="Amenity Name">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
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

            </div>

        </div>
    </div>

    <form action="" method="post" id="delete">
        @csrf
        @method('DELETE')
    </form>


@endsection

<!----------Page specific scripts ---------->
@push('scripts')
<script>
    $(document).ready(function() {
        //  start ajax syntax with a function()
        $(function() {
            //  getting the original table and replace it with yajra DataTable({json data});
            yTable = $('#yTable').DataTable({
                //  default data for all columns
                columnDefs: [{
                    'defaultContent': '-',
                    'targets': '_all'
                }],
                //  it's showing the processing message
                "processing": true,
                //  it's working on serverside
                "serverSide": true,
                "searching": true,
                //  getting the route using ajax and declare request type
                "ajax": {
                    "url": "{{ route('amenity.index') }}",
                    "type": 'GET',
                },
                //  push data to all the table columns
                columns: [
                    //  this first column is defined the auto increment too column
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'amenity_name',
                        name: 'amenity_name'
                    },
                    {
                        data: 'amenity_status',
                        name: 'amenity_status',
                    },
                    //  here added orderable and searchable property to make table orderable and searchable
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ],
                // dom:'Bfrtip',
                // buttons:['csv','pdf'],
            });
        });
        //  here end data pushing using yajra datatables
    });
</script>

<!---------- -/ End of Page specific scripts ---------->

<script>
    $(document).ready(function() {
        //  amenity store ajax request
          $('body').on('submit', '#amenityStore', function(e) {
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
                     toastr.success(response.success);
                     $('#amenityStore')[0].reset();
                     // reload table using yajra datatable
                     yTable.ajax.reload();
                    $('.btn-close').trigger('click');
                  },
                  error:function(xhr,status,failed){
                      let errors = xhr.responseJSON.errors;
                      $.each(errors, function(key, value){
                         toastr.error(value[0]);
                      });
                  },
              });
          });

          //  amenity edit ajax request
          $('body').on('click', '.edit', function(e) {
              e.preventDefault();
              let get_id = $(this).data('id');
              $.ajax({
                  url:"{{ route('amenity.edit') }}",
                  type:'GET',
                  data:{
                      id:get_id
                  },
                  success:function(response){
                     $('.amenity_name').val(response.amenity_name);
                     $("#up_id").val(response.id);
                  },
                  error:function(xhr,status,failed){
                      let errors = xhr.responseJSON.errors;
                      $.each(errors, function(key, value){
                         toastr.error(value[0]);
                      });
                  },
              });
          });

          //  amenity update ajax request
          $('body').on('submit', '#amenityUpdate', function(e) {
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
                     toastr.success(response.success);
                     // reload table using yajra datatable
                     yTable.ajax.reload();
                    $('.btn-close').trigger('click');
                  },
                  error:function(xhr,status,failed){
                      let errors = xhr.responseJSON.errors;
                      $.each(errors, function(key, value){
                         toastr.error(value[0]);
                      });
                  },
              });
          });

          //    amenity delete ajax request
          $('body').on('click', '#delete_data', function(e) {
              e.preventDefault();
              let get_route = $(this).attr('href');
              let set_route = $('#delete').attr('action', get_route);
              $('#delete').submit();     
          });
          // handle form for deleting
          $('#delete').submit(function(event){
              event.preventDefault();
              let get_route = $(this).attr('action');
              let form_data = new FormData($(this)[0]);
              $.ajax({
                  url:get_route,
                  type:'post',
                  data:form_data,
                  processData: false,
                  contentType: false,
                  success:function(response){
                     toastr.success(response.success);
                     // reloading table
                     yTable.ajax.reload();
                  },
                  error:function(xhr,status,failed){
                      let errors = xhr.responseJSON.errors;
                      $.each(errors, function(key, value){
                         toastr.error(value[0]);
                      });
                  },
              });
          });
    });
</script>
@endpush