@extends('layouts.admin')

@section('admin_content')
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

{{-- <script>
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

          //    change amenity status
          $('body').on('click', '.amenityStatus', function(e) {
              e.preventDefault();
              let get_id = $(this).data('id');
              $.ajax({
                  url:"{{ route('amenity.status') }}",
                  type:'GET',
                  data:{
                      id:get_id,
                  },
                  success:function(response){
                     toastr.success(response.success);
                     // reload table using yajra datatable
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
</script> --}}
@endpush