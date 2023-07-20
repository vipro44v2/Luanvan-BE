@extends('master')
@section('content')
    <!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-white rounded  justify-content-center mx-0">
        <div class="col-md-12 text-center">
            <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>MY CINEMA</h3>   
            <div class="container-fluid pt-4 px-4">
            <div class="row g-4">
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Số lượng vé bán trong ngày</p>
                        <h6 class="mb-0">{{$quantity}}</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-5">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Tổng doanh thu trong ngày</p>
                        <h6 class="mb-0">{{$total}}</h6>
                    </div>
                </div>
            </div>
            </div>
            <div class="row g-4">
            <div class="col-sm-12 col-xl-10">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Thống kê doanh thu</h6>
                    </div>
                    <canvas id="worldwide-sales"></canvas>
                </div>
            </div>
            </div>
            </div>
        </div>
    </div>       
</div>
<script
src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    (function ($) {
    var ctx1 = $("#worldwide-sales").get(0).getContext("2d");
    var myChart1 = new Chart(ctx1, {
        type: "bar",
        data: {
            labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7"],
            datasets: [{
                    label: "Doanh thu",
                    data: [100000000, 70000000, 80000000, 80000000, 150000000, 75000000, 65000000],
                    backgroundColor: "rgba(0, 156, 255, .7)"
                }
            ]
            },
        options: {
            responsive: true
        }
    });
})(jQuery);

</script>
<!-- Blank End -->
@stop

@section('navbar')
    <a href="/home" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Trang chủ</a>
    @if(Session::get('staff')['role_id']==1||Session::get('staff')['role_id']==0)
    <a href="/movie/list" class="nav-item nav-link"><i class="fa fa-film me-2"></i>Phim</a>
    <a href="/actor/list" class="nav-item nav-link"><i class="fa-sharp fa-solid fa-user-secret fa me-2"></i>Diễn viên</a>
    <a href="/director/list" class="nav-item nav-link"><i class="fa fa-sharp fa-solid fa-user-secret me-2"></i>Đạo diễn</a>
    @if(Session::get('staff')['role_id']==0)
    <a href="/staff/list" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Nhân viên</a> 
    @endif 
    @endif 
@stop