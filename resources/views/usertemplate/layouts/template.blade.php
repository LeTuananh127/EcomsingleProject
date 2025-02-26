@php
   $categories = App\Models\Category::latest()->get(); 
@endphp

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>TuanAnhMobile </title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.min.css') }}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">
      <!-- fevicon -->
      <link rel="icon" href="{{ asset('home/images/fevicon.png') }}" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{ asset('home/css/jquery.mCustomScrollbar.min.css') }}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
      <!-- font awesome -->
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--  -->
      <!-- owl stylesheets -->
      <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('home/css/owl.carousel.min.css') }}">
      <link rel="stylesoeet" href="{{ asset('home/css/owl.theme.default.min.css') }}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>
      <!-- banner bg main start -->
      <div class="banner_bg_main">
         <!-- header top section start -->
         <div class="container">
            <div class="header_section_top">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="custom_menu">
                        <ul>
                           <li><a href="#">Best Sellers</a></li>
                           <li><a href="">Gift Ideas</a></li>
                           <li><a href="{{route('newrelease')}}">New Releases</a></li>
                           <li><a href="{{route('todaysdeal')}}">Today's Deals</a></li>
                           <li><a href="{{route('customerservice')}}">Customer Service</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header top section start -->
         <!-- logo section start -->
         
         <!-- logo section end -->
         <!-- header section start -->
         <div class="header_section">
            <div class="container">
               <h1 class="text-center text-light" style="margin-top:25px; font-weight:bold; color:white "><a style="color:white; font-weight: 800; font-size:32px " href="{{ route('Home') }}">TuanAnhMobile</a></h1>
               <div class="containt_main">
                  <div id="mySidenav" class="sidenav">
                     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                     <a href="{{ route('Home') }}">Home</a>

                     @foreach ($categories as $category)
                        <a href="{{ route('category', [$category->id, $category->slug]) }}">{{ $category->category_name }}
                        </a>
                     @endforeach

                  </div>
                  <div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category 
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('Home') }}">All Product</a>
                        @foreach ( $categories as $category )
                        
                        <a class="dropdown-item" href="{{ route('category', [$category->id, $category->slug]) }}">{{ $category-> category_name }}</a>
                           
                        @endforeach
                        
                     </div>
                  </div>
                  <div class="main">
                     <!-- Another variation with a button -->
                     <form action="{{ route('search') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="query" class="form-control" placeholder="Search for products..." required>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit" style="background-color: #f26522; border-color:#f26522 ">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    
                  </div>
                  <div class="header_box">
                     <div class="login_menu">
                        <ul>
                           <li><a href="{{ route ('addtocart') }}">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                              <span class="padding_10">Cart</span></a>
                           </li>
                        </ul>
                           <div class="dropdown">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  {{ Auth::check() ? Auth::user()->name : 'Guest' }}
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  @if(Auth::check())
                                      <a class="dropdown-item" href="{{ route('profile.edit') }}">Your Profile</a>
                                      <a class="dropdown-item" href="{{ route('userprofile') }}">Your Orders</a>
                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                          Logout
                                      </a>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                                  @else
                                      <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                      <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                  @endif
                              </div>
                          </div>  
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- header section end -->
   
      </div>
      <!-- banner bg main end -->
      
      <!-- Common Part start -->
      <div class="container py-5" style="margin-top:180px;">
         @yield('main-content')
      </div>
      <!-- End Common Part  -->




      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="footer_logo"><a href="index.html"><h1 class="text-light" style=" font-weight: 800; font-size:32px">TuanAnhMobile</h1></a></div>
            <div class="input_bt">
            </div>
            <div class="footer_menu">
               <ul>
                  <li><a href="#">Best Sellers</a></li>
                  <li><a href="">Gift Ideas</a></li>
                  <li><a href="{{route('newrelease')}}">New Releases</a></li>
                  <li><a href="{{route('todaysdeal')}}">Today's Deals</a></li>
                  <li><a href="{{route('customerservice')}}">Customer Service</a></li>
               </ul>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">© 2020 All Rights Reserved. Design by Tuan Anh <a href="https://html.design"></a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="{{ asset('home/js/popper.min.js') }}"></script>
      <script src="{{ asset('home/js/jquery.min.js') }}"></script>
      <script src="{{ asset('home/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('home/js/jquery-3.0.0.min.js') }}"></script>
      <script src="{{ asset('home/js/plugin.js') }}"></script>
      <!-- sidebar -->
      <script src="{{ asset('home/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
      <script src="{{ asset('home/js/custom.js') }}"></script>
      <script>
         function openNav() {
           document.getElementById("mySidenav").style.width = "250px";
         }
         
         function closeNav() {
           document.getElementById("mySidenav").style.width = "0";
         }
      </script>
   </body>
</html>