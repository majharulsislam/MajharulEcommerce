jQuery( document ).ready(function($) {
  "use-strict";

});


// =======> Product Cart Button
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

function addToCard(product_id){
  // standart way niyom-1 when server will stay this project server
  // var url = "{{ url('/') }}";
  //  $.post( url+"/api/cart/store", { 
  //        product_id: product_id
  //     })

  // Niyom-> 2
  $.post( "http://localhost:8000/api/cart/store", {
         product_id: product_id
      })

    .done(function( data ) {
      data = JSON.parse(data);
      if(data.status == 'success'){

      // toast
      alertify.set('notifier','position', 'top-center');
      alertify.success('Item added to cart successfully!! Total items: '+data.totalitems+'To view your carts'+'<a href="http://localhost:8000/cart">Click here</a>');

      // navbar add item
      $('#totalitems').html(data.totalitems);

      }
    });
      
}