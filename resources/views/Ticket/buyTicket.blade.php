@extends('master')
@section('content')
    <!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
            
                    <div class="bg-light rounded h-100 p-4">
                        <form action="/ticket/createTicket" method="POST">
                            @csrf
                        <h6 class="mb-4"></h6>
                        <div class="row g-4">
                                <input type="hidden" id="theater"  value="{{$theater->id}}">                      
                                <div class="col-sm-12 col-xl-3">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="movie_select" name="movie_select" onchange="chooseMovie()"
                                            aria-label="Floating label select example">
                                            @if($movie)
                                            @foreach($movie as $item)
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                            @endforeach
                                            @endif                                          
                                        </select>                        
                                        <label for="room_select">Chọn phim</label>
                                        </div>
                                        </div>
                                        <div class="col-sm-12 col-xl-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="calendar_select" name="calendar_select" onchange="chooseCalendar()"
                                                    aria-label="Floating label select example">   
                                                    @if($calendar)
                                                    @foreach($calendar as $item)
                                                    <option value="{{$item->id}}">{{$item->date}}</option>
                                                    @endforeach
                                                    @endif                                       
                                                </select>                        
                                                <label for="room_select">Chọn ngày chiếu</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-xl-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="schedule_select" name="schedule_select" onchange="chooseSchedule()"
                                                    aria-label="Floating label select example">
                                                    @if($schedule)
                                                    @foreach($schedule as $item)
                                                    <option value="{{$item->id}}">{{$item->time_start}}</option>
                                                    @endforeach
                                                    @endif                                       
                                                </select>                        
                                                <label for="room_select">Chọn giờ chiếu</label>
                                            </div>
                                        </div>
                            </div>
                            
                       <div id="list_seat" class="room">                       
                       </div><br>                       
                       <div class="quantity">
                        <p>Số lượng vé: </p><input disabled type="number" id="seat_quantity" value="0">
                        <input type="hidden" name="quantity" id="seat_quantity1" value="0">
                       </div>
                       <div class="quantity">
                        <p>Vé trẻ em: </p><input type="number" id="children_quantity" name="children_quantity" min="0" max="5">
                       </div>                       
                       <div id="listSeatChoose">                        
                       </div>
                       <button type="submit" class="btn btn-primary m-2">Mua vé</button> 
                       </form>
                    </div>
                </div>
       
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    url='http://localhost:8000/';    
    var theater_id=document.getElementById("theater").value;
    var schedule=document.getElementById("schedule_select");
    var scheduleValue=schedule.options[schedule.selectedIndex].value;
    var calendar=document.getElementById("calendar_select");
    var calendarValue=calendar.options[calendar.selectedIndex].value;
    var movie=document.getElementById("movie_select");
    var movieValue=movie.options[movie.selectedIndex].value;
    function chooseSchedule(){
        calendarValue=calendar.options[calendar.selectedIndex].value;
        scheduleValue=schedule.options[schedule.selectedIndex].value;
        $.get(url+"api/room/getListSeat/calendar_id="+calendarValue+"&schedule_id="+scheduleValue+"",function(res){
            if(res.status_code==200){               
                let seat=res.data
                let list=''
                seat.forEach(function(item){
                    if(item.status==true)                   
                    list+='<div class="seat" id="seat'+item.id+'" onclick="chooseSeat('+item.id+');"><p>'+item.name+'</p></div>'
                    else
                    list+='<div style="background-color:red;color:white""  class="seat"><p>'+item.name+'</p></div>'
                })
                $('#list_seat').html(list);
            }})
    }    
    function chooseCalendar(){
        calendarValue=calendar.options[calendar.selectedIndex].value;
        $.get(url+"api/calendar/gettime/theater_id="+theater_id+"&calendar_id="+calendarValue+"",function(res){
            let schedule=res.data
            let list=""
            schedule.forEach(function(item){
                list+="<option value="+item.id+">"+item.time_start+"</option>"
            })
            $('#schedule_select').html(list);
            chooseSchedule();
        })
    }      
    function chooseMovie(){
        movieValue=movie.options[movie.selectedIndex].value;
        $.get(url+"api/calendar/getcalendar/movie_id="+movieValue+"&theater_id="+theater_id+"",function(res){
            let calendar=res.data
            let list=""
            calendar.forEach(function(item){
                list+="<option value="+item.id+">"+item.date+"</option>"
            })
            $('#calendar_select').html(list);
        })
        chooseCalendar();
        chooseSchedule();
    }  
    $.get(url+"api/room/getListSeat/calendar_id="+calendarValue+"&schedule_id="+scheduleValue+"",function(res){
            if(res.status_code==200){               
                let seat=res.data
                let list=''
                seat.forEach(function(item){
                    if(item.status==true)                   
                    list+='<div class="seat" id="seat'+item.id+'" onclick="chooseSeat('+item.id+');"><p>'+item.name+'</p></div>'
                    else
                    list+='<div style="background-color:red;color:white""  class="seat"><p>'+item.name+'</p></div>'
                })
                $('#list_seat').html(list);
    }})
    function chooseSeat(id){
        var seat=document.getElementById("seat"+id)
        var children_quantity=document.getElementById("children_quantity")
        list=""
        if($('#seat'+id).hasClass("seat_is_choose"))
        {
            seat.classList.remove("seat_is_choose")
            document.getElementById("seat_quantity").value= document.getElementById("seat_quantity").value-1
            children_quantity.max= document.getElementById("seat_quantity").value
            document.getElementById("seat_quantity1").value=document.getElementById("seat_quantity").value
            element = document.getElementById(id);
            element.remove();
        }
        else{
            seat.classList.add("seat_is_choose")
            document.getElementById("seat_quantity").value=parseInt(document.getElementById("seat_quantity").value)+parseInt(1)
            children_quantity.max= document.getElementById("seat_quantity").value
            document.getElementById("seat_quantity1").value=document.getElementById("seat_quantity").value
            list+='<input type="hidden" id="'+id+'" value="'+id+'" name="'+id+'">'
        }
        $('#listSeatChoose').append(list)
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