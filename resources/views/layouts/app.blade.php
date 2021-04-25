<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300&display=swap" rel="stylesheet">

    <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Thiqa-az') }}</title>

    <!-- Scripts -->
 

   
</head>
<body >
    <div id="app">

        <nav class="navbar navbar-expand-md" style="background-color:#0473c0;" >
            <div class="container">

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="\upload\logo.png" alt="" >
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">
                        <div style="padding-top: 12px">
                            <form class="navbar-form " action="{{ url('search') }}" style="width: 550px">
                                <div class="form-group">
                                  <input type="text" class="form-control" name="input" placeholder="عن ماذا تبحث">
                                </div>
                            </form>
                        </div>
                    </ul>
                    
                    <!-- Right Side Of Navbar -->
      
                </div>
            </div>
        </nav> 
            
    </div>


        
            <div id="demo" class="carousel slide mb-5 shadow" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                  <li data-target="#demo" data-slide-to="0" class="active">
                    
                  </li>
                  <li data-target="#demo" data-slide-to="1">
                    
                  </li>
                  <li data-target="#demo" data-slide-to="2">
                    
                  </li>
                </ul>
              
                <!-- The slideshow -->
                
                <div class="carousel-inner">
                  <div class="carousel-item active slide1" >
                  </div>
                  <div class="carousel-item slide2" >
                  </div>
                  <div class="carousel-item slide3" >
                  </div>
                </div>
  
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
              
              </div>
              

                <main class="container">
                    @yield('content')
                </main>


                <footer class="site-footer  mt-5 ">
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <p class="text-justify">
                              {{$settings->about_us}}
                          </p>
                        </div>
                        <div class="col-xs-6 col-md-3">
                          <h6>تواصل معنا</h6>
                          <ul class="footer-links">
                            <li>{{$settings->address}}</li>
                            <li>{{$settings->phone}}</li>
                            <li>{{$settings->email}}</li>
                            <hr>                           
                            <li><a href="http://scanfcode.com/category/java-programming-language/"><img  style ="width:50px"src="\upload\facebook.png" alt=""></a>
                            <a href="http://scanfcode.com/category/java-programming-language/"><img style ="width:50px" src="\upload\twitter.png" alt=""></a>
                          </li>

                
                          </ul>
                        </div>
                
                        <div class="col-xs-6 col-md-3">
                          <h6>حمل التطبيق</h6>
                          <ul class="footer-links">
                            <li><a href="http://scanfcode.com/about/"><img src="\upload\google-play.png" alt=""></a></li>
                            <li><a href="http://scanfcode.com/about/"><img src="\upload\app-store.png" alt=""></a></li>
                            <li><a href="http://scanfcode.com/about/"><img src="\upload\app-gallery.png" alt=""></a></li>
                          </ul>
                        </div>
                      </div>
                      <hr>
                
                    </div>
                    <div class="container">
                      <div class="row">
                        <div class="col-md-8 col-sm-6 col-xs-12">
                          <p class="copyright-text">جميع الحقوق محفوظة لصالح شركة  
                          <a href="#">الثقة التجارية</a>.
                          </p>
                        </div>
                
                      </div>
                    </div>
                  </footer> 
             </div>




             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
        $('#navbarDropdown').mouseenter(function() {
          $('.dropdown-menu').slideToggle(300, "linear");
        });
        
        $('.dropdown-menu').mouseleave(function() {
          $(this).slideToggle(300, "linear");
        });
      });
</script>
    

        </body>
</html>


