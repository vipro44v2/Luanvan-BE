@extends('master');
@section('content')
      <!--Form Start-->
            
      <div class="col-sm-12 col-xl-15">
        <div class=".bg-secondary.bg-gradient rounded h-100 p-4">
            <h6 class="mb-4">{{$title}}</h6>
            <form action="/calendar/editCalendar/theater_id={{$theater->id}}&calendar_id={{$calendar->id}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
            <input type="hidden" name="theater" id="theater" value="{{$theater->id}}"> 
            <div class="mb-3">
                <label for="date">Chọn ngày :</label>
                <input type="date" name="date" id="" value="{{$calendar->date}}">
                @error('birthday')
                <span style="color:red;">{{$message}}</span>
                @enderror
            </div>  
            

            <div class=" mb-3">
                <label for="movie">Chọn phim :</label>
               <select name="movie" id="list_movie">
                @forEach($movies as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
                @endforeach
               </select>            
            </div>  
            
            <div class=" mb-3">
                <label for="room">Chọn phòng :</label>
               <select name="room" id="list_room">
                @forEach($rooms as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
               </select>            
            </div>   
            @foreach ($schedules as $key => $item ) 
            {{$checked=""}}     
                @forEach($time as $item1)
                    @if($item->id==$item1->id)
                       <input type="hidden" value="{{$checked="checked"}}">
                    @endif
                @endforEach                    
                <div class="form-check">
                <input class="form-check-input" name="{{$item->id}}" {{$checked}} type="checkbox"  value="{{$item->time_start}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    {{$item->time_start}}
                </label>
                </div>
            @endforeach        
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Cập nhật lịch</button>                     
        </form>
        <input type="hidden" id="movie_id" value="{{$calendar->movie_id}}">
        <input type="hidden" id="room_id" value="{{$room[0]->room_id}}">
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
            var movie=document.getElementById("movie_id").value;
            var room=document.getElementById("room_id").value;           
            $("#list_movie").val(movie);
            $("#list_room").val(room);
</script>
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