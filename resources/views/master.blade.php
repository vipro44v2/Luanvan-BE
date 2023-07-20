<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <script src="https://kit.fontawesome.com/3f035324f9.js" crossorigin="anonymous"></script>
    <script src="{{asset('ckeditor/ckeditor.js')}}"></script>
    <script> CKEDITOR.replace('story');
            CKEDITOR.replace('description');           
    </script>
    <title>My cinema</title>
</head>
<body>
    <div class="container">
        
         <!-- Spinner Start -->
         {{-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> --}}
        <!-- Spinner End -->
        <div class="sidebar pe-6 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>MY CINEMA</h3>
                   
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle me-lg-2" src="{{Session::get('staff')['avatar']}}" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{Session::get('staff')['name']}}</h6>
                        <span>{{Session::get('staff')['role']}}</span>
                    </div>
                </div>
                <div class="navbar-nav w-100" id="nav-bar">
                    @yield('navbar')
                </div>                 
            </nav>
        </div>
         <!-- Content Start -->
         <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                
                
                <div class="navbar-nav align-items-center ms-auto">  
                    @if(Session::get('staff'))
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="{{Session::get('staff')['avatar']}}" alt="" style="width: 40px; height: 40px;">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end .bg-secondary.bg-gradient border-0 rounded-0 rounded-bottom m-0">
                            <a href="/info/getinfo/{{Session::get('staff')['id']}}" class="dropdown-item">Thông tin bản thân</a>
                            <a href="/logout" class="dropdown-item">Đăng xuất</a>
                        </div>
                    </div>
                    @endif
                </div>
            </nav>
            <!-- Navbar End -->         
            @yield('content')
            {{-- <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End --> --}}
        </div>
        <!-- Content End -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
   
    <script>
        url='http://localhost:8000/';    
        $.get(url+'api/theater/getall',function(res){
            if(res.status_code===200){
                let theater=res.data;
                let list =''
                theater.forEach(function(item){
                    $('#nav-bar').append('<div class="nav-item dropdown"><a href="#" class="nav-link dropdown-toggle" id="theater'+item.id+'" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>'+item.theater_name+'</a><div class="dropdown-menu navbar-menu bg-transparent border-0"><a href="/room/list/'+item.id+'" class="nav-item nav-link">Phòng chiếu</a><a href="/calendar/list/'+item.id+'" class="nav-item nav-link"></i>Lịch chiếu</a></a><a href="/bill/list/'+item.id+'" class="nav-item nav-link"></i>Danh sách hoá đơn</a></a><a href="/ticket/buyTicket/'+item.id+'" class="nav-item nav-link"></i>Bán vé</a></div></div>')
                });
                var theaterActive='theater'+document.getElementById("theater").value;
                var element=document.getElementById(theaterActive);
                element.classList.add("active");
            }}
            )     
        
          
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>


</html>