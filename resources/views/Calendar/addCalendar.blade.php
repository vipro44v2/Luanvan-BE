@extends('master');
@section('content')
      <!--Form Start-->
            
      <div class="col-sm-12 col-xl-15">
        <div class=".bg-secondary.bg-gradient rounded h-95 p-4">
            <h6 class="mb-4">{{$title}}</h6>
            <form action="/calendar/addCalendar/{{$theater->id}}" method="POST" enctype="multipart/form-data">
                @csrf
            {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
            <input type="hidden" name="theater" id="theater" value="{{$theater->id}}"> 
           
            

            <div class=" mb-3">
                <label for="movie">Chọn phim :</label>
               <select name="movie" id="">
                @forEach($movies as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
                @endforeach
               </select>            
            </div>              
            <div class=" mb-3">
                <label for="room">Chọn phòng :</label>
               <select name="room" id="list-room">
                @forEach($rooms as $item)
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
               </select>            
            </div>   
            <div class="mb-3">
                <label for="date">Chọn ngày :</label>
                <input type="date" name="date" id="date" onchange="selectedTime()">
                @error('birthday')
                <span style="color:red;">{{$message}}</span>
                @enderror
            </div>  
            <div id="list-time">
            @foreach ($schedules as $key => $item )
            <div class="form-check" >
            <input class="form-check-input" name="{{$item->id}}" type="checkbox" value="{{$item->time_start}}" id="{{$item->id}}">
            <label class="form-check-label" for="flexCheckDefault">
                {{$item->time_start}}
            </label>
             </div>
            @endforeach 
            </div>        
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Thêm lịch</button>                     
        </form>
        </div>
    </div>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    function selectedTime(){
        var date=document.getElementById('date').value;
        var room=document.getElementById("list-room");
        var roomSelect=room.options[room.selectedIndex].value;
        $.get(url+'api/room/getalltime/room_id='+roomSelect+'&date='+date+'',function(res){
            if(res.status_code==200){               
                let time=res.data
                let flag=true
                let list=''
                time.forEach(function(item){
                    if(item.status==true)
                    list+='<div class="form-check" ><input class="form-check-input" name="'+item.id+'" type="checkbox" value="'+item.time_start+'" id="'+item.id+'"><label class="form-check-label" for="flexCheckDefault">'+item.time_start+'</label></div>'
                    else
                    {
                    movie = ""
                    $.get(url+"api/room/getmoviebyroom/schedule_id="+item.id+"&room_id="+roomSelect+"&date="+date+"",function(res1){
                        if(res1.status_code==200){
                        movie=res1.data[0].title  
                    }
                    })
                    console.log(movie);
                    list+='<div class="form-check" ><input class="form-check-input" disabled name="'+item.id+'" type="checkbox" value="'+item.time_start+'" id="'+item.id+'"><label class="form-check-label" for="flexCheckDefault">'+item.time_start+'</label></div>'
                    }
                });
                $('#list-time').html(list)
            }
        })
    }
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