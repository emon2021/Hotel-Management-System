@extends('layouts.admin')

@section('admin_content')
    @push('title')
        <title>Admin|Hotel|Management|System</title>
    @endpush

    <div class="register-box m-auto pt-5 pb-5" style="max-width: 550px;width:100%">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h4" style="text-transform: uppercase">Add Food Category</a>
            </div>
            <div class="card-body">

                <form action="{{route('admin.food.category.store')}}" id="foodCat" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="category_name"
                            class="form-control @error('category_name') is-invalid @enderror" placeholder="Category Name">
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
                    <div class=" mb-3">
                        <input type="checkbox" style="width: 1.5rem;height:1.5rem" name="category_status" value="1">
                        <span  style="font-size:1.5rem; margin-left:1rem">Active</span>
                    </div>
                    <div class="row" style="margin-top:-2.2rem;padding-bottom:1rem">
                        <!-- /.col -->
                        <div class="col-8"></div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" style="width: 9.7rem">ADD</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>
        <!-- /.register-box -->
    </div>
    @endsection

@push('scripts')

<script>
    $(document).ready(function() {
        $('body').on('submit','#foodCat',function(e){
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
                   toastr.success(response);
                   $('#foodCat')[0].reset();
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