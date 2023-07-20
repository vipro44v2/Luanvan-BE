@extends('master')
@section('content')
    <!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
            
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">{{$title}}</h6>
                       <a class="btn btn-primary m-2" href="/calendar/addCalendarForm/{{$theater->id}}">Thêm lịch</a>
                       <input type="hidden" id="theater" value="{{$theater->id}}">  
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ngày chiếu</th>
                                    <th scope="col">Phim chiếu</th>
                                    <th scope="col">Phòng chiếu</th>
                                    <th scope="col" colspan="3">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="list_movies">  
                                @if($calendar)
                                    @foreach ($calendar as $key => $item )
                                    <tr><th scope="row">{{$item->id}}
                                        <input type="hidden" name="calendar{{$item->id}}" value="{{$item->id}}">
                                    </th>
                                    <td>{{$item->date}}</td>
                                    <td>{{$item->movie}}</td>
                                    <td>{{$item->room_name}}</td>
                                    {{-- <td>{{$item->room}}</td> --}}
                                    <td></td>
                                    <td><a href="/calendar/editCalendarForm/theater_id={{$theater->id}}&id={{$item->id}}" class="btn btn-sm btn-success m-2">Detail</a></td>
                                    <td><a href="/calendar/deleteCalendar/theater_id={{$theater->id}}&id={{$item->id}}" class="btn btn-sm btn-danger m-2">Delete</a></td></tr>
                                    @endforeach
                                @else
                                    <td colspan="8">Không có lịch</td>
                                @endif
                            </tbody>
                        </table>
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
