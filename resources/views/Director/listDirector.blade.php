@extends('master')
@section('content')
    <!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
            
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">{{$title}}</h6>
                       <a class="btn btn-primary m-2" href="/director/addDirectorForm">Thêm đạo diễn</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên đầy đủ</th>
                                    <th scope="col">Giới tính</th>
                                    <th scope="col">Quốc tịch</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col" colspan="2">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="list_actors">  
                                @if($directors)
                                    @foreach ($directors as $key => $item )
                                    <tr><th scope="row">{{$item->id}}</th>
                                    <td>{{$item->full_name}}</td>
                                    <td>{{$item->gender}}</td>
                                    <td>{{$item->country_name}}</td>
                                    <td><img src="{{$item->image}}" style="width: 100px;height:75px" alt="" srcset=""></td>
                                    <td><a href="{{url('/director/editDirectorForm',$item->id)}}" class="btn btn-sm btn-success m-2">Chi tiết</a></td>
                                    <td><a href="{{url('/director/deleteDirector',$item->id)}}" class="btn btn-sm btn-danger m-2">Xoá</a></td></tr>
                                    @endforeach
                                @else
                                    <td colspan="8">Không có đạo diễn</td>
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
    <a href="/director/list" class="nav-item nav-link active"><i class="fa fa-sharp fa-solid fa-user-secret me-2"></i>Đạo diễn</a>
    @if(Session::get('staff')['role_id']==0)
    <a href="/staff/list" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Nhân viên</a> 
    @endif 
    @endif
@stop