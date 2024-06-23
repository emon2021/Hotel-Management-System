@extends("layouts.admin")
@section("admin_content")
    @push("title")\
        <title>Admin|HMS|Rooms|Categories</title>
    @endpush
    <div class="register-box m-auto pt-5 pb-5" style="max-width: 550px;width:100%">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h4" style="text-transform: uppercase">Add Rooms Category</a>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.rooms.category.store') }}" id="roomsCat" method="post">
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
                    <div class="row" style="padding-bottom:1rem">
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