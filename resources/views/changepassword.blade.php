@extends('master')
@section('content')
    <!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
            <h2 class="mb-4">Đổi mật khẩu</h2>
            <form action={{url('/info/changePassword',$staff->id)}} method="POST" enctype="multipart/form-data">
                @csrf
                @if($staff->img_avatar)
                <img src="{{$staff->img_avatar}}" class="rounded-circle" style="width: 150px;height: 130px;"  alt="Avatar" /><br>
                @else
                <img src="https://static2.yan.vn/YanNews/2167221/202102/facebook-cap-nhat-avatar-doi-voi-tai-khoan-khong-su-dung-anh-dai-dien-e4abd14d.jpg" class="rounded-circle" style="width: 150px;"  alt="Avatar" /><br>
                @endif
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="floatingInput" value="{{old('password')}}">
                    <label for="floatingInput">Mật khẩu cũ</label>
                    @if((session('passwordfalse')))
                        <span style="color:red;">{{session('passwordfalse')}}</span>
                    @endif
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="new_password" id="floatingInput" value="{{old('new_password')}}">
                    <label for="floatingInput">Nhập mật khẩu mới</label>
                    @error('new_password')
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
                <button type="submit" class="btn btn-primary py-3 w-50 mb-4">Đổi mật khẩu</button>                    
            </form>                 
        </div>
    </div>       
</div>
<!-- Blank End -->
@stop

@section('navbar')
    <a href="/home" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Trang chủ</a>                  
    @if(Session::get('staff')['role_id']==1||Session::get('staff')['role_id']==0)
    <a href="/movie/list" class="nav-item nav-link"><i class="fa fa-film me-2"></i>Phim</a>
    <a href="/actor/list" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-user-secret fa me-2"></i>Diễn viên</a>
    <a href="/director/list" class="nav-item nav-link"><i class="fa fa-sharp fa-solid fa-user-secret me-2"></i>Đạo diễn</a>
    @if(Session::get('staff')['role_id']==0)
    <a href="/staff/list" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Nhân viên</a> 
    @endif 
    @endif 
@stop
