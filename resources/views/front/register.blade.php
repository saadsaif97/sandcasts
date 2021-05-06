<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="keywords" content="">

      <title>TheSaaS — Register</title>

      <!-- Styles -->
      <link href="{{ asset('front/css/page.min.css') }}" rel="stylesheet">
      <link href="{{ asset('front/css/style.css') }}" rel="stylesheet">

      <!-- Favicons -->
      <link rel="apple-touch-icon" href="{{ asset('front/img/apple-touch-icon.png') }}">
      <link rel="icon" href="{{ asset('front/img/favicon.png') }}">
   </head>

   <body class="layout-centered bg-img"
      style="background-image: url('https://source.unsplash.com/1600x900/?nature,water')">


      <!-- Main Content -->
      <main class="main-content">

         <div class="bg-white rounded shadow-7 w-400 mw-100 p-6">
            <h5 class="mb-7">Create an account</h5>


            <form action="/register" method="POST">
               @csrf
               <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Your Name" value="{{ old('name') }}">
                  <p class="text-danger">@error('name') {{ $message }} @enderror</p>
               </div>

               <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Email Address"
                     value="{{ old('email') }}">
                  <p class="text-danger">@error('email') {{ $message }} @enderror</p>
               </div>

               <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                  <p class="text-danger">@error('password') {{ $message }} @enderror</p>
               </div>

               <div class="form-group">
                  <input type="password" class="form-control" name="password_confirmation"
                     placeholder="Password (confirm)">
               </div>

               <div class="form-group py-3">
                  <div class="custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input">
                     <label class="custom-control-label">I agree to the <a class="ml-1" href="terms.html">terms of
                           service</a></label>
                  </div>
               </div>

               <div class="form-group">
                  <button class="btn btn-block btn-primary" type="submit">Register</button>
               </div>
            </form>

            <div class="divider">Or Register With</div>
            <div class="text-center">
               <a class="btn btn-circle btn-sm btn-facebook mr-2" href="#"><i class="fa fa-facebook"></i></a>
               <a class="btn btn-circle btn-sm btn-google mr-2" href="#"><i class="fa fa-google"></i></a>
               <a class="btn btn-circle btn-sm btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
            </div>

            <hr class="w-30">

            <p class="text-center text-muted small-2">Already a member? <a href="{{ route('login') }}">Login here</a>
            </p>
         </div>

      </main><!-- /.main-content -->


      <!-- Scripts -->
      <script src="{{ asset('front/js/page.min.js') }}"></script>
      <script src="{{ asset('front/js/script.js') }}"></script>

   </body>

</html>
