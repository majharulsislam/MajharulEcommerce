<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>
  	@yield('title', 'Laravel Ecommerce Project')
  </title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Alert -->
    <link rel="stylesheet" type="text/css" href="{{ asset('alert/toastr.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('alert/sweetalert.css') }}">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  
</head>
<body>

	<div class="wrapper">
		<!-- Start Nav -->
			@include('partials.navbar')
		<!-- End Nav -->


		<!-- Start sidebar + content -->
	    	@yield('commerce_content')
		<!-- End sidebar + content -->
	</div>


	<!-- Start footer -->
	  <footer class="bg-dark footer_bottom">
	    <p class="text-center text-white" style="padding:15px">&copy; All Right Reserved Majhrul 2.0 Shop | Develop By Majharul</p>
	  </footer>
	<!-- End footer -->


<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  

<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<!-- Alertyfy CSS and JS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
<!-- End Alertyfy js-->



<!-- Alert -->
    <script src="{{ asset('alert/toastr.min.js') }}"></script>
    <script src="{{ asset('alert/sweetalert.min.js') }}"></script>


<!-- Custom js -->
    <script src="{{ asset('js/custom.js') }}"></script>


{{-- Payment method script for payment page --}}
<script type="text/javascript">
      $("#payment_method").change(function(){
        $payment_method = $("#payment_method").val();
        if($payment_method == "cash_in"){
            $('#payment_cash_in').removeClass('hidden');
            $('#payment_bkash').addClass('hidden');
            $('#payment_rocket').addClass('hidden');
            $('#transaction_id').addClass('hidden');
        }
        else if ($payment_method == "bkash"){
            $('#payment_bkash').removeClass('hidden');
            $('#transaction_id').removeClass('hidden');
            $('#payment_cash_in').addClass('hidden');
            $('#payment_rocket').addClass('hidden');
        }
        else if ($payment_method == "rocket"){
            $('#payment_rocket').removeClass('hidden');
            $('#transaction_id').removeClass('hidden');
            $('#payment_cash_in').addClass('hidden');
            $('#payment_bkash').addClass('hidden');
        }
      });
</script>

{{-- Division script for register page --}}
{{-- <script>
    $('#division_id').change(function(){
        var division = $('#division_id').val();

       $('#district_id').html('');
       var option = "";

        // Send an ajax request to server with this division
        $.get( "http://localhost:8000/get-districts/"+division, function( data ){
            data = JSON.parse(data);
            data.forEach(function (element){
                //option = "<option value='"+ element.id +"'>"+ element.name +"</option>"
            });
        });

        $('#district_id').html('<option value="5">5</option>');


    });
</script> --}}

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