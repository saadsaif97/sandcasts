<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="keywords" content="">

      <title>TheSaaS — Single blog post</title>

      <!-- Styles -->
      <link href="{{ asset('front/css/page.min.css')}}" rel="stylesheet">
      <link href="{{ asset('front/css/style.css')}}" rel="stylesheet">

      <!-- Favicons -->
      <link rel="apple-touch-icon" href="{{ asset('front/img/apple-touch-icon.png')}}">
      <link rel="icon" href="{{ asset('front/img/favicon.png')}}">
   </head>

   <body>


      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
         <div class="container">

            <div class="navbar-left">
               <button class="navbar-toggler" type="button">&#9776;</button>
               <a class="navbar-brand" href="{{ route('home') }}">
                  <img class="logo-dark" src="{{ asset('front/img/logo-dark.png')}}" alt="logo">
                  <img class="logo-light" src="{{ asset('front/img/logo-light.png')}}" alt="logo">
               </a>
            </div>

            <section class="navbar-mobile justify-content-lg-end">

               <ul class="nav nav-navbar">

                  @guest
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="modal" data-target="#loginModal"
                        style="cursor: pointer;">Login</a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('register') }}" style="cursor: pointer;">Register</a>
                  </li>
                  @else

                  <li class="nav-item">
                     <a class="nav-link">Hey {{ auth()->user()->name }}</a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                     </a>
                  </li>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                  </form>
                  @endguest
               </ul>
            </section>


         </div>
      </nav><!-- /.navbar -->

      <div id="app">

         @yield('header')

         <!-- Main Content -->
         <main class="main-content">
            @yield('content')
         </main>

         @guest
         <vue-login></vue-login>
         @endguest

      </div>

      <!-- Footer -->
      <footer class="footer">
         <div class="container">
            <div class="row gap-y align-items-center">

               <div class="col-6 col-lg-3">
                  <a href="../index.html"><img src="{{ asset('front/img/logo-dark.png')}}" alt="logo"></a>
               </div>

               <div class="col-6 col-lg-3 text-right order-lg-last">
                  <div class="social">
                     <a class="social-facebook" href="https://www.facebook.com/thethemeio"><i
                           class="fa fa-facebook"></i></a>
                     <a class="social-twitter" href="https://twitter.com/thethemeio"><i class="fa fa-twitter"></i></a>
                     <a class="social-instagram" href="https://www.instagram.com/thethemeio/"><i
                           class="fa fa-instagram"></i></a>
                     <a class="social-dribbble" href="https://dribbble.com/thethemeio"><i
                           class="fa fa-dribbble"></i></a>
                  </div>
               </div>

               <div class="col-lg-6">
                  <div class="nav nav-bold nav-uppercase nav-trim justify-content-lg-center">
                     <a class="nav-link" href="../uikit/index.html">Elements</a>
                     <a class="nav-link" href="../block/index.html">Blocks</a>
                     <a class="nav-link" href="../page/about-1.html">About</a>
                     <a class="nav-link" href="../blog/grid.html">Blog</a>
                     <a class="nav-link" href="../page/contact-1.html">Contact</a>
                  </div>
               </div>

            </div>
         </div>
      </footer><!-- /.footer -->


      <!-- Scripts -->
      <script src="{{ asset('front/js/page.min.js')}}"></script>
      <script src="{{ asset('front/js/script.js')}}"></script>
      <script src="{{ asset('js/app.js') }}"> </script>

   </body>

</html>
