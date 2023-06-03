@extends('master')
@section('content')
<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-light rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
                    <div class="bg-light rounded h-100 p-4">
                        <h6 class="mb-4">User Table</h6>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">ID Card</th>
                                    <th scope="col">Phone number</th>
                                    <th scope="col">Create at</th>
                                </tr>
                            </thead>
                            <tbody id="list_user">
                                
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
    <a href="/actor/list" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-user-secret fa me-2"></i>Diễn viên</a>
    <a href="/user/list" class="nav-item nav-link  active"><i class="fa fa-user me-2"></i>Người dùng</a>
    <a href="#" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a>
@stop