@extends('master');
@section('content')
      <!--Form Start-->
            
      <div class="col-sm-12 col-xl-15">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">{{$title}}</h6>
            <form action="/room/addRoom/{{$theater->id}}" method="POST" enctype="multipart/form-data">
                @csrf
            {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
           
            <input type="hidden" name="theater" id="theater" value="{{$theater->id}}"> 
             
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" id="floatingInput">
                <label for="floatingInput">Tên phòng</label>               
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" name="slot" id="floatingInput">
                <label for="floatingInput">Số lượng ghế (Max:34)</label>               
            </div>
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Thêm phòng</button>                     
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
    <a href="/staff/list" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Nhân viên</a> 
    @endif 
    @endif
@stop