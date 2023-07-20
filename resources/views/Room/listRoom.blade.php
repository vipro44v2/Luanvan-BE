@extends('master')
@section('content')
    <!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
            
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4"></h6>
                        <div class="row g-4">
                                <input type="hidden" id="theater" value="{{$theater->id}}">                      
                                <div class="col-sm-12 col-xl-3">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="room_select"
                                            aria-label="Floating label select example">
                                            @if($room)
                                            @foreach($room as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                       @endif                                          
                                        </select>                        
                                        <label for="room_select">Chọn phòng</label>
                                        </div>
                                        </div>
                                        <div class="col-sm-12 col-xl-3">
                                            <div class="mb-3">
                                                <label for="date">Chọn ngày :</label>
                                                <input type="date" name="date" id="date" value="{{$date}}">                                                
                                            </div>  
                                        </div>
                                        <div class="col-sm-12 col-xl-3">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="schedule_select"
                                                    aria-label="Floating label select example"> 
                                                    @if($time)
                                                    @foreach($time as $item)
                                                    <option value="{{$item->id}}">{{$item->time_start}}</option>
                                                    @endforeach
                                                    @endif                                          
                                                </select>                        
                                                <label for="room_select">Chọn giờ</label>
                                                </div>
                                                </div>
                                
                            </div>
                            <a class="btn btn-primary m-2" onclick="chooseRoom();" id="btn_xemphong">Xem phòng</a>
                            <a class="btn btn-primary m-2" href="/room/addRoomForm/{{$theater->id}}">Thêm phòng</a>
                       <div id="list_seat" class="room">                       
                       </div>
                       <div id="movie_by_room">                                                   
                       </div>
                    </div>
                </div>
       
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
            url='http://localhost:8000/'; 
            var schedule=document.getElementById("schedule_select");
            var scheduleValue=schedule.options[schedule.selectedIndex].value;
            var date=document.getElementById('date').value;
            var selectBox = document.getElementById("room_select");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            $.get(url+"api/room/getSeat/"+selectedValue+";"+scheduleValue+";"+date+"",function(res){
            if(res.status_code==200){               
                let seat=res.data
                let list=''
                seat.forEach(function(item){
                    if(item.status==true)                   
                    list+='<div class="seat"><p>'+item.name+'</p></div>'
                    else
                    list+='<div style="background-color:red;color:white"" class="seat"><p>'+item.name+'</p></div>'
                });
                $.get(url+"api/room/getmoviebyroom/schedule_id="+scheduleValue+"&room_id="+selectedValue+"&date="+date+"",function(res1){
                    if(res1.status_code==200){
                        let movie=res1.data[0].title
                        movieByRoom='<div>Phim chiếu :'+movie+'</div>'
                        $('#movie_by_room').html(movieByRoom)
                    }
                    else{
                        movieByRoom='<div>Không có phim chiếu giờ này</div>'
                        $('#movie_by_room').html(movieByRoom)
                    }
                })
                $('#list_seat').html(list) 
            }})
            function chooseRoom() {
            var schedule=document.getElementById("schedule_select");
            var scheduleValue=schedule.options[schedule.selectedIndex].value;
            var date=document.getElementById('date').value;
            var selectBox = document.getElementById("room_select");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            $.get(url+"api/room/getSeat/"+selectedValue+";"+scheduleValue+";"+date+"",function(res){
            if(res.status_code==200){               
                let seat=res.data
                let list=''
                seat.forEach(function(item){
                    if(item.status==true)                   
                    list+='<div class="seat"><p>'+item.name+'</p></div>'
                    else
                    list+='<div style="background-color:red;color:white"" class="seat"><p>'+item.name+'</p></div>'
                });
                $.get(url+"api/room/getmoviebyroom/schedule_id="+scheduleValue+"&room_id="+selectedValue+"&date="+date+"",function(res1){
                    if(res1.status_code==200){
                        let movie=res1.data[0].title
                        movieByRoom='<div>Phim chiếu :'+movie+'</div>'
                        $('#movie_by_room').html(movieByRoom)
                    }
                    else{
                        movieByRoom='<div>Không có phim chiếu giờ này</div>'
                        $('#movie_by_room').html(movieByRoom)
                    }
                })
                $('#list_seat').html(list)                
            }
            })
            }
                  
</script>
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