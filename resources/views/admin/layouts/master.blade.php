<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('backend/css') }}/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('backend/css') }}/ionicons.css">
    <link rel="stylesheet" href="{{ asset('backend/css') }}/flag-icon.min.css">
    <link rel="stylesheet" href="{{ asset('backend/css') }}/vendor.bundle.base.css">
    <link rel="stylesheet" href="{{ asset('backend/css') }}/vendor.bundle.addons.css">
    <!-- endinject -->

     <!-- Alert -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/alert/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/alert/sweetalert.css') }}">

    {{-- DataTables --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.min.css') }}">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend/css') }}/style.css">

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend/css') }}/demostyle.css">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="{{ asset('backend/img/logo') }}/favicon.ico" />
  </head>
  <body>

  <!-- Navbar -->
    @include('admin.partials.navbar')
  <!-- End Navbar -->

<div class="container-fluid page-body-wrapper">

<!-- Sidebar -->
  @include('admin.partials.side')
<!-- End sidebar -->

<div class="main-panel">
  <div class="content-wrapper">

<!-- Start admin content -->
    @yield('admin_content')
<!-- End admin content -->

  </div>
<!-- End content wrapper -->

<!-- footer -->
    <footer class="footer">
      <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates</a> from Bootstrapdash.com</span>
      </div>
    </footer>

  </div>
<!-- End main panel -->


    <!-- plugins:js -->
    <script src="{{ asset('backend/js') }}/vendor.bundle.base.js"></script>
    <script src="{{ asset('backend/js') }}/vendor.bundle.addons.js"></script>
    <!-- endinject -->

    {{-- DataTables --}}
    <script src="{{ asset('js/dataTables.min.js') }}"></script>

    <!-- Alert -->
    <script src="{{ asset('backend/alert/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/alert/sweetalert.min.js') }}"></script>

    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('backend/js') }}/off-canvas.js"></script>
    <!-- <script src="{{ asset('backend/js') }}/misc.js"></script> -->
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('backend/js') }}/dashboard.js"></script>
    <!-- End custom js for this page-->
    <script src="{{ asset('backend/js') }}/jquery.cookie.js" type="text/javascript"></script>


<script>
  $(document).ready( function () {
    $('#dataTable').DataTable();
  });
</script>


<!-- Taoster alert -->
<script>
 @if(Session::has('messege'))
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
        case 'info':
             toastr.info("{{ Session::get('messege') }}");
             break;
        case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;
        case 'warning':
           toastr.warning("{{ Session::get('messege') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
      }
    @endif
</script>

<!-- delete alert -->
  <script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
         var link = $(this).attr("href");
         swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          cancelButtonClass: "btn-info",
          confirmButtonText: "Yes, delete it!",
          cancelButtonText: "No, cancel!",
          closeOnConfirm: false,
          closeOnCancel: false,
        },
        function(isConfirm) {
          if (isConfirm) {
            swal("Deleted!", "Your imaginary file has been deleted.", "success");
            window.location.href = link;
          } else {
            swal("Cancelled", "Your imaginary file is safe !", "error");
          }
        });
       });
  </script>

  </body>
</html>