$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
});


// A $( document ).ready() block.
/*$( document ).ready(function() {
    $("#checkbox").click(function(event ){
      event.preventDefault();
      var aurl = $(this).attr('href');
      $.ajax({url: aurl, success: function(result){
        //$("#div1").html(result);
      }});
    });
});*/