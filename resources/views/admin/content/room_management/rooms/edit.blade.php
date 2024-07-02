<div class="modal-body">
    
    <form action="{{ route('room.update') }}" id="roomUpdate" method="post">
        @csrf
        <div class="input-group mb-3">
            <input type="hidden" value="{{ $room->id }}" id="up_id" name="up_id">
            <input type="text" value="{{ $room->room_title }}" name="room_title"
                class="form-control room_title "  placeholder="Room Title">
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
                    <option value="{{ $category->id }}"@if($room->category_id == $category->id) selected @endif>{{ $category->category_name }}</option>
                @endforeach
            </select>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="hidden" value="" id="up_id" name="id">
            <input type="text" value="{{ $room->room_rent }}" name="room_rent"
                class="form-control room_rent "  placeholder="Room Rent">
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