@extends('master')
@section('content')
<div class="col-sm-12 col-xl-15">
    <div class=".bg-secondary.bg-gradient rounded h-100 p-4">
        <h6 class="mb-4">{{$title}}</h6>
        <form action="{{url('/movie/editMovie',$movie->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="title" id="floatingInput" value="{{$movie->title}}">
            <label for="floatingInput">Tiêu đề</label>
            
            @error('title')
                <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" name="description" placeholder="Leave a comment here"
                id="floatingTextarea" style="height: 150px;">{{$movie->description}}</textarea>
            <label for="floatingTextarea">Mô tả</label>
            @error('description')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>

        <div class=" mb-3">
            <label for="duration">Thời lượng phim :</label>
            <input type="number" name="duration" value="{{$movie->duration}}">
            @error('duration')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
       
        <div class="mb-3">
            <label for="age_limit">Giới hạn độ tuổi :</label>
            <input type="number" name="age_limit" id="" value="{{$movie->age_limit}}">
            @error('age_limit')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date_release">Ngày khởi chiếu :</label>
            <input type="date" name="date_release" id="" value="{{$movie->release_date}}">
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
        <div class="mb-6">
            <label for="trailer">Trailer :</label>
            <input type="text" name="trailer" id="" value="{{$movie->trailer}}">
            @error('trailer')
            <span style="color:red;">{{$message}}</span>
            @enderror
        </div>
        <br>
        <div class="form-floating mb-3">           
            <select class="form-select" id="list-country" name="country" 
                aria-label="Floating label select example">
                @forEach($country as $item)
                    <option value="{{$item->id}}">{{$item->country_name}}</option>
                @endforEach
            </select>
            <label for="floatingSelect">Chọn quốc gia</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="list-director" name="director"
                aria-label="Floating label select example">
                @forEach($director as $item)
                <option value="{{$item->id}}">{{$item->full_name}}</option>
                @endforEach
            </select>
            <label for="floatingSelect">Đạo diễn</label>
        </div>

        <div class="form-floating mb-3">
            <select class="form-select" id="list-status" name="movie_status"
                aria-label="Floating label select example">
                @forEach($movie_status as $item)
                <option value="{{$item->id}}">{{$item->status}}</option>
                @endforEach
            </select>
            <label for="floatingSelect">Trạng thái</label>
        </div>
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Thể loại phim</h6>
            @if($listgenre)
            @foreach ($listgenre as $key => $item ) 
            {{$checked=""}}     
                @forEach($genres as $item1)
                    @if($item->id==$item1->id)
                       <input type="hidden" value="{{$checked="checked"}}">
                    @endif
                @endforEach                    
                <div class="form-check">
                <input class="form-check-input" name="{{$item->id}}" {{$checked}} type="checkbox"  value="{{$item->genre_name}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{$item->genre_name}}
                </label>
                </div>
            @endforeach
            @endif
        </div>
        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Cập nhật phim</button>                     
    </form>
    <input type="hidden" id ="movie_country" value="{{$movie->country_id}}">
    <input type="hidden" id ="movie_director" value="{{$movie->director_id}}">
    <input type="hidden" id ="movie_status_id" value="{{$movie->movie_status_id}}">
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
            var country_id=document.getElementById("movie_country").value;
            var director_id=document.getElementById("movie_director").value;
            var movie_status_id=document.getElementById("movie_status_id").value;
            $("#list-country").val(country_id);
            $("#list-director").val(director_id);
            $("#list-status").val(movie_status_id);
</script>
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