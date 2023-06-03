@extends('master')
@section('content')
<div class="col-sm-12 col-xl-15">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">{{$title}}</h6>
        <form action="{{url('/movie/editMovie',$movie[0]->id)}}" method="POST" id="FormLogin">
            @csrf
        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" id="floatingInput" value="{{$movie[0]->title}}">
            <label for="floatingInput">Tiêu đề</label>
            
            @error('title')
                <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" name="description" placeholder="Leave a comment here"
                id="floatingTextarea" style="height: 150px;">{{$movie[0]->description}}</textarea>
            <label for="floatingTextarea">Mô tả</label>
            @error('description')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>

        <div class=" mb-3">
            <label for="duration">Thời lượng phim :</label>
            <input type="time" name="duration" value="{{$movie[0]->duration}}">
            @error('duration')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
       
        <div class="mb-3">
            <label for="age_limit">Giới hạn độ tuổi :</label>
            <input type="number" name="age_limit" id="" value="{{$movie[0]->age_limit}}">
            @error('age_limit')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date_release">Ngày khởi chiếu :</label>
            <input type="date" name="date_release" id="" value="{{$movie[0]->release_date}}">
            @error('date_release')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="poster">Poster :</label>
            <input type="file" name="poster" id="">
            @error('poster')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="list-country" name="country"
                aria-label="Floating label select example">
            </select>
            <label for="floatingSelect">Chọn quốc gia</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="list-director" name="director"
                aria-label="Floating label select example">
            </select>
            <label for="floatingSelect">Đạo diễn</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="list-status" name="movie_status"
                aria-label="Floating label select example">
            </select>
            <label for="floatingSelect">Trạng thái</label>
        </div>
        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Cập nhật phim</button>                     
    </form>

    </div>
</div>
@stop
@section('navbar')
    <a href="#" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Trang chủ</a>                   
    <a href="/movie/list" class="nav-item nav-link active"><i class="fa fa-film me-2"></i>Phim</a>
    <a href="/actor/list" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-user-secret fa me-2"></i>Diễn viên</a>
    <a href="/user/list" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Người dùng</a>
    <a href="#" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
@stop