@extends('master');
@section('content')
      <!--Form Start-->
            
      <div class="col-sm-12 col-xl-15">
        <div class=".bg-secondary.bg-gradient rounded h-100 p-4">
            <h6 class="mb-4">Thêm đạo diễn</h6>
            <form action="/director/editDirector/{{$director->id}}" method="POST" enctype="multipart/form-data">
                @csrf
            {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="full_name" id="floatingInput" value="{{$director->full_name}}">
                <label for="floatingInput">Tên đầy đủ</label>
                @error('title')
                    <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            

            <div class=" mb-3">
                <label for="gender">Giới tính :</label>
               <select name="gender" id="gender">
                <option value="1">Nam</option>
                <option value="0">Nữ</option>
               </select>            
            </div>

            <div class="mb-3">
                <label for="birthday">Ngày sinh :</label>
                <input type="date" name="birthday" id="" value="{{$director->birthday}}">
                @error('birthday')
                <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="image">Image :</label>
                <input type="file" name="image" id="">
                @error('Image')
                <span style="color:red;">{{$message}}</span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="list-country" name="nationality"
                    aria-label="Floating label select example">
                    @forEach($nationality as $item)
                    <option value="{{$item->id}}">{{$item->country_name}}</option>
                    @endforEach
                </select>
                <label for="floatingSelect">Quốc tịch</label>
            </div>            
            <div class="form-floating mb-3">
                <textarea class="form-control" name="story" placeholder="Leave a comment here"
                    id="story" style="height: 150px;">{{$director->story}}</textarea>
                <label for="floatingTextarea">Tiểu sử</label>
                @error('story')
                <span style="color:red;">{{$message}}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Cập nhật đạo diễn</button>                     
        </form>
        <input type="hidden" id="director_gender" value="{{$director->gender}}">
        <input type="hidden" id ="nationality" value="{{$director->nationality}}">
        </div>
    </div>
    <script>
        var gender=document.getElementById("director_gender").value;
        var nationality=document.getElementById("nationality").value;           
        $("#gender").val(gender);
        $("#list-country").val(nationality);
</script>
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