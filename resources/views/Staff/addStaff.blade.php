@extends('master');
@section('content')
      <!--Form Start-->
            
      <div class="col-sm-12 col-xl-15">
        <div class=".bg-secondary.bg-gradient rounded h-100 p-4">
            <h6 class="mb-4">Thêm nhân viên</h6>
            <form action="/staff/addStaff" method="POST" enctype="multipart/form-data">
                @csrf
            {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="floatingInput" value="{{old('name')}}">
                <label for="floatingInput">Tên đầy đủ</label>
                @error('name')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="id_card_number" id="floatingInput" value="{{old('id_card_number')}}">
                <label for="floatingInput">Số CCCD</label>
                @error('id_card_number')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="phone_number" id="floatingInput" value="{{old('phone_number')}}">
                <label for="floatingInput">Số điện thoại</label>
                @error('phone_number')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="username" id="floatingInput" value="{{old('username')}}">
                <label for="floatingInput">Tên đăng nhập</label>
                @error('username')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="floatingInput" value="{{old('password')}}">
                <label for="floatingInput">Mật khẩu</label>
                @error('password')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password_confirmation" id="floatingInput" value="{{old('password_confirmation')}}">
                <label for="floatingInput">Nhập lại mật khẩu</label>
                @error('password_confirmation')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" id="list-director" name="role"
                    aria-label="Floating label select example">
                    @forEach($role as $item)
                    <option value="{{$item->id}}">{{$item->role}}</option>
                    @endforEach
                </select>
                <label for="floatingSelect">Vai trò</label>
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Thêm nhân viên</button>                     
        </form>

        </div>
    </div>
@stop
@section('navbar')
    <a href="/home" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Trang chủ</a>                  
    @if(Session::get('staff')['role_id']==1||Session::get('staff')['role_id']==0)
    <a href="/movie/list" class="nav-item nav-link"><i class="fa fa-film me-2"></i>Phim</a>
    <a href="/actor/list" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-user-secret fa me-2"></i>Diễn viên</a>
    <a href="/director/list" class="nav-item nav-link"><i class="fa fa-sharp fa-solid fa-user-secret me-2"></i>Đạo diễn</a>
    @if(Session::get('staff')['role_id']==0)
    <a href="/staff/list" class="nav-item nav-link active"><i class="fa fa-user me-2"></i>Nhân viên</a> 
    @endif 
    @endif
@stop