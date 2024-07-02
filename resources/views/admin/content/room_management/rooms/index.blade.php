@extends('layouts.admin')

@section('admin_content')
@push('css')
        {{-- ---------next and previous button custom css--------- --}}
        <style>
            .paginate_button {
                background: #0069d9;
                color: white;
                padding: 10px;
                margin: 0.40rem;
                border-radius: 0.25rem;
            }
        </style>
        {{-- ---Yajra DataTable css link---- --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css"
            integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
       
    @endpush
    @push('title')
        <title>Admin|HMS|Rooms</title>
    @endpush
    <div class="container float-end" style="float:right;width:82%">
        <div class="row">
            <div class="col-md-6 float-start">
                <h3>Rooms</h3>
            </div>
            <div class="col-md-6 float-end">
                <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">+  &nbsp;&nbsp; Add  </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Room List Here...</h3>
                    </div>
                    <div class="card-body">

                        <table id="yTable" class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Featured</th>
                                    <th>Rent</th>
                                    <th>Action</th>
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
                        <h5 class="modal-title" id="exampleModalLabel">Add Rooms</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('room.store') }}" id="roomStore" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                   
                                    <input type="text" name="room_title"
                                        class="form-control cat_name "  placeholder="Room Title">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                   
                                    <select name="cat_id" class="form-control" id="">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-bars"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                   
                                    <input type="number" name="room_rent" placeholder="Room Rent" class="form-control">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-credit-card"></span>
                                        </div>
                                    </div>
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
        </div>
    </div>

    <form action="" method="post" id="delete">
        @csrf
        @method('DELETE')
    </form>


@endsection

<!----------Page specific scripts ---------->
@push('scripts')

{{-- ------Yajra DataTable js script link------- --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Include DataTables JS -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<!-- Include DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>


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
                    "url": "{{ route('room.index') }}",
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
                        data: 'room_title',
                        name: 'room_title'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id',
                    },
                    {
                        data: 'featured',
                        name: 'featured',
                    },
                    {
                        data: 'room_rent',
                        name: 'room_rent',
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
        //  romm store ajax request
          $('body').on('submit', '#roomStore', function(e) {
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
                     $('#roomStore')[0].reset();
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

        //   //  amenity edit ajax request
        //   $('body').on('click', '.edit', function(e) {
        //       e.preventDefault();
        //       let get_id = $(this).data('id');
        //       $.ajax({
        //           url:"{{ route('amenity.edit') }}",
        //           type:'GET',
        //           data:{
        //               id:get_id
        //           },
        //           success:function(response){
        //              $('.amenity_name').val(response.amenity_name);
        //              $("#up_id").val(response.id);
        //           },
        //           error:function(xhr,status,failed){
        //               let errors = xhr.responseJSON.errors;
        //               $.each(errors, function(key, value){
        //                  toastr.error(value[0]);
        //               });
        //           },
        //       });
        //   });

        //    amenity update ajax request
        //   $('body').on('submit', '#amenityUpdate', function(e) {
        //       e.preventDefault();
        //       let get_route = $(this).attr('action');
        //       let form_data = new FormData($(this)[0]);
        //       $.ajax({
        //           url:get_route,
        //           type:'POST',
        //           data:form_data,
        //           processData: false,
        //           contentType: false,
        //           success:function(response){
        //              toastr.success(response.success);
        //              // reload table using yajra datatable
        //              yTable.ajax.reload();
        //             $('.btn-close').trigger('click');
        //           },
        //           error:function(xhr,status,failed){
        //               let errors = xhr.responseJSON.errors;
        //               $.each(errors, function(key, value){
        //                  toastr.error(value[0]);
        //               });
        //           },
        //       });
        //   });

        //   //    amenity delete ajax request
        //   $('body').on('click', '#delete_data', function(e) {
        //       e.preventDefault();
        //       let get_route = $(this).attr('href');
        //       let set_route = $('#delete').attr('action', get_route);
        //       $('#delete').submit();     
        //   });
        //   // handle form for deleting
        //   $('#delete').submit(function(event){
        //       event.preventDefault();
        //       let get_route = $(this).attr('action');
        //       let form_data = new FormData($(this)[0]);
        //       $.ajax({
        //           url:get_route,
        //           type:'post',
        //           data:form_data,
        //           processData: false,
        //           contentType: false,
        //           success:function(response){
        //              toastr.success(response.success);
        //              // reloading table
        //              yTable.ajax.reload();
        //           },
        //           error:function(xhr,status,failed){
        //               let errors = xhr.responseJSON.errors;
        //               $.each(errors, function(key, value){
        //                  toastr.error(value[0]);
        //               });
        //           },
        //       });
        //   });

        //   //    change amenity status
        //   $('body').on('click', '.amenityStatus', function(e) {
        //       e.preventDefault();
        //       let get_id = $(this).data('id');
        //       $.ajax({
        //           url:"{{ route('amenity.status') }}",
        //           type:'GET',
        //           data:{
        //               id:get_id,
        //           },
        //           success:function(response){
        //              toastr.success(response.success);
        //              // reload table using yajra datatable
        //              yTable.ajax.reload();
        //           },
        //           error:function(xhr,status,failed){
        //               let errors = xhr.responseJSON.errors;
        //               $.each(errors, function(key, value){
        //                  toastr.error(value[0]);
        //               });
        //           },
        //       });
        //   });
    });
</script>
@endpush