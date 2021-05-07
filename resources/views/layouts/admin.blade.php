<!DOCTYPE html>
<html lang="en">

   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <title>Dashboard - SB Admin</title>
      <link href="{{ asset('admin/css/styles.css') }}" rel="stylesheet" />
      <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
         crossorigin="anonymous" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"
         crossorigin="anonymous"></script>
   </head>

   <body class="sb-nav-fixed">

      @include('inc.admin.top-nav')

      <div id="layoutSidenav">

         @include('inc.admin.side-menu')

         <div id="layoutSidenav_content">
            <main>
               <div class="container-fluid">

                  <div class="mt-4"> @include('inc.admin.flash-messages') </div>

                  @yield('content')

               </div>
            </main>

            @include('inc.admin.footer')

         </div>
      </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"
         integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
         crossorigin="anonymous"></script>
      <script src="{{ asset('admin/js/scripts.js') }}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('admin/assets/demo/chart-area-demo.js') }}"></script>
      <script src="{{ asset('admin/assets/demo/chart-bar-demo.js') }}"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
      <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
      <script src="{{ asset('admin/assets/demo/datatables-demo.js') }}"></script>
      // to auto fadeout the alert message
      <script>
         document.addEventListener('DOMContentLoaded', () => {
            $(".alert").fadeTo(4000, 1).fadeOut(1000, 0);
         })
      </script>
   </body>

</html>
