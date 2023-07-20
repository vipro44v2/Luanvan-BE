@extends('master')
@section('content')
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">Danh sách nhân viên</h6>
                        <a class="btn btn-primary m-2" href="/staff/addstaffform">Thêm nhân viên</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên đầy đủ</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Số CCCD</th>
                                    <th scope="col">Số điện thoại</th>
                                    <th scope="col">Chức vụ</th>
                                    <th scope="col">Phân quyền</th>
                                </tr>
                            </thead>
                            <tbody id="list_staff">
                                @if($staff)
                                @foreach ($staff as $key => $item ) 
                                <tr><td>{{$item->staff_id}}</td>                         
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->id_card_number}}</td>
                                <td>{{$item->phone_number}}</td>
                                <td>{{$item->role}}</td>
                                <td><a href="{{url('/staff/updateStaffForm',$item->staff_id)}}" class="btn btn-sm btn-warning m-2">Phân quyền</a></td>
                                 </tr>                            
                                
                                @endforeach
                            @else
                                <td colspan="8">Không có nhân viên</td>
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
    <a href="/director/list" class="nav-item nav-link"><i class="fa fa-sharp fa-solid fa-user-secret me-2"></i>Đạo diễn</a>
    @if(Session::get('staff')['role_id']==0)
    <a href="/staff/list" class="nav-item nav-link active"><i class="fa fa-user me-2"></i>Nhân viên</a> 
    @endif 
    @endif
@stop