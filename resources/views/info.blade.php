@extends('master')
@section('content')
    <!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
            <h2 class="mb-4">Thông tin cá nhân</h2>
            <form action="/info/updateInfo/{{$staff->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if((session('changePasswordSuccess')))
                <span style="color:blue;">{{session('changePasswordSuccess')}}</span><br>
                 @endif
                @if($staff->img_avatar)
                <img src="{{$staff->img_avatar}}" class="rounded-circle" style="width: 150px;height: 130px;"  alt="Avatar" /><br>
                @else
                <img src="https://static2.yan.vn/YanNews/2167221/202102/facebook-cap-nhat-avatar-doi-voi-tai-khoan-khong-su-dung-anh-dai-dien-e4abd14d.jpg" class="rounded-circle" style="width: 150px;"  alt="Avatar" /><br>
                @endif
                <input type="file" name="avatar" id="">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="name" id="floatingInput" value="{{$staff->name}}">
                    <label for="floatingInput">Tên</label>
                    @error('name')
                        <span style="color:red;">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="email" id="floatingInput" value="{{$staff->email}}">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="id_card_number" id="floatingInput" value="{{$staff->id_card_number}}">
                    <label for="floatingInput">Số CCCD</label>
                    @error('id_card_number')
                    <span style="color:red;">{{$message}}</span>
                @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="phone_number" id="floatingInput" value="{{$staff->phone_number}}">
                    <label for="floatingInput">Số điện thoại</label>
                    @error('phone_number')
                    <span style="color:red;">{{$message}}</span>
                @enderror
                </div>
                <a class="btn btn-primary m-2" href="/info/changePasswordForm/{{$staff->id}}">Đổi mật khẩu</a><br>
                <button type="submit" class="btn btn-primary py-3 w-50 mb-4">Cập nhật thông tin</button>                    
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
