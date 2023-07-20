@extends('master')
@section('content')
      <!--Form Start-->
            
      <div class="col-sm-12 col-xl-15">
        <div class=".bg-secondary.bg-gradient rounded h-100 p-4">
            <input type="hidden" id="theater" value="{{$theater->id}}"> 
            <h3 class="mb-4">Chi tiết hoá đơn</h3>
            <h5 class="mb-4">Số lượng vé: {{$quantity}}</h5>
            @forEach($listticket as $item)
            <hr>
            <div>
                <div class="container ticket_info">
                    <div class="row">
                      <div class="col">
                        <h6>{{$item->title}}</h6>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col">
                          Ngày chiếu: {{$item->date}}
                        </div>
                        <div class="col">
                          Giờ chiếu: {{$item->time_start}}
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                          Phòng: {{$item->room_name}}
                        </div>
                        <div class="col">
                          Ghế: {{$item->seat_name}}
                        </div>
                      </div>

                      <div class="row">
                        <div class="col">
                          Loại vé: {{$item->type}}
                        </div>
                        <div class="col">
                          Giá vé: {{$item->prices}}
                        </div>
                      </div>
                </div>

            </div>
            @endforEach
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