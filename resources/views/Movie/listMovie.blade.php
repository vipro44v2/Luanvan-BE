@extends('master')
@section('content')
    <!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
            
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Danh sách phim</h6>
                       <a class="btn btn-primary m-2" href="/movie/addMovieForm">Thêm phim</a>  
                       <form action="" method="get" class="mb-3">
                            <div class="row">                                
                                <div class="col-3">
                                    <select class="form-control" name="director_id" id="">
                                        <option value="0">Tất cả đạo diễn</option>
                                        @foreach($director as $item)                                       
                                        <option value="{{$item->id}}" {{request()->director==$item->id?'selected':false}} >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <select class="form-control" name="movie_status_id" id="">
                                        <option value="0">Tất cả trạng thái</option>
                                        @foreach($movie_status as $item)                                       
                                        <option value="{{$item->id}}" {{request()->movie_status==$item->id?'selected':false}}>{{$item->status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="search" name="keyword" class="form-control" value="{{request()->keyword}}" placeholder="Nhập từ khoá">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                </div>
                            </div>
                        </form>                     
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tiêu đề phim</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Đạo diễn</th>
                                    <th scope="col">Ngày khởi chiếu</th>
                                    <th scope="col">Poster</th>
                                    <th scope="col" colspan="2">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="list_movies">  
                                @if($movies)
                                    @foreach ($movies as $key => $item )
                                    <tr><th scope="row">{{$item->id}}</th>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->status}}</td>
                                    <td>{{$item->director_name}}</td>
                                    <td>{{$item->release_date}}</td>
                                    <td><img src="{{$item->poster}}" style="width: 100px;height:75px" alt="" srcset=""></td>
                                    <td><a href="{{url('/movie/editMovieForm',$item->id)}}" class="btn btn-sm btn-success m-2">Chi tiết</a></td>
                                    <td><a href="{{url('/movie/deleteMovie',$item->id)}}" class="btn btn-sm btn-danger m-2">Xoá</a></td></tr>
                                    @endforeach
                                @else
                                    <td colspan="8">Không có phim</td>
                                @endif
                            </tbody>                                                        
                        </table>
                        {{$movies->links()}}
                    </div>
                </div>
       
</div>
<!-- Blank End -->
@stop

@section('navbar')
    <a href="/home" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Trang chủ</a>                   
    @if(Session::get('staff')['role_id']==1||Session::get('staff')['role_id']==0)
    <a href="/movie/list" class="nav-item nav-link active"><i class="fa fa-film me-2"></i>Phim</a>
    <a href="/actor/list" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-user-secret fa me-2"></i>Diễn viên</a>
    <a href="/director/list" class="nav-item nav-link"><i class="fa fa-sharp fa-solid fa-user-secret me-2"></i>Đạo diễn</a>
    @if(Session::get('staff')['role_id']==0)
    <a href="/staff/list" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Nhân viên</a> 
    @endif 
    @endif  
@stop
