@extends('layouts.admin')

@section('admin_content')
    @push('title')
        <title>Admin|HMS|Rooms|Categories</title>
    @endpush
    <div class="container float-end" style="float:right;width:82%">
        <div class="row overflow-hidden">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <table id="y_table" class="table table-striped text-center">
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

            </div>

        </div>
    </div>
@endsection

<!----------Page specific scripts ---------->
@push('scripts')
<script>
    $(document).ready(function() {
        //  start ajax syntax with a function()
        $(function() {
            //  getting the original table and replace it with yajra DataTable({json data});
            yTable = $('#y_table').DataTable({
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
          
    });
</script>
@endpush