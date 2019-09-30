<!DOCTYPE html>
<html lang="en">

  @include('parts.head')

  @include('parts.loader')

<body id="page-top">

    @include('parts.nav')


  <div id="wrapper">

    @include('parts.sidebar')

    <div id="content-wrapper" style="background-color: #e9ecef">

      <div class="container-fluid" style="background-color: #e9ecef">
        

       @yield('content')
        
      </div>

      <!-- Sticky Footer -->
      @include('parts.footer')

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  @include('parts.modal')

  @include('parts.scripts')

</body>

</html>
