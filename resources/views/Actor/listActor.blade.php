@extends('master')
@section('content')
    <!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
            
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">{{$title}}</h6>
                       <a class="btn btn-primary m-2" href="/actor/addActorForm">Thêm diễn viên</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Story</th>
                                    <th scope="col">Natinality</th>
                                    <th scope="col">Image</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="list_actors">  
                                @if($actors)
                                    @foreach ($actors as $key => $item )
                                    <tr><th scope="row">{{$item->id}}</th>
                                    <td>{{$item->full_name}}</td>
                                    <td>{{$item->gender}}</td>
                                    <td>{{$item->story}}</td>
                                    <td>{{$item->nationality}}</td>
                                    <td>{{$item->image}}</td>
                                    <td><a href="{{url('/actor/editActorForm',$item->id)}}" class="btn btn-sm btn-success m-2">Chi tiết</a></td>
                                    <td><a href="{{url('/actor/deleteActor',$item->id)}}" class="btn btn-sm btn-danger m-2">Xoá</a></td></tr>
                                    @endforeach
                                @else
                                    <td colspan="8">Không có phim</td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
       
</div>
<!-- Blank End -->
@stop
@section('navbar')
    <a href="#" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Trang chủ</a>                   
    <a href="/movie/list" class="nav-item nav-link"><i class="fa fa-film me-2"></i>Phim</a>
    <a href="/actor/list" class="nav-item nav-link active"><i class="fa-sharp fa-solid fa-user-secret fa me-2"></i>Diễn viên</a>
    <a href="/user/list" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Người dùng</a>
    <a href="#" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
@stop