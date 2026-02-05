
$(document).ready(function(){
  $('input[type="checkbox"]').click(function(){
      if($(this).is(":checked")){
          $.ajax({
              type: "GET",
              url: "php/out_of_stock_item.php?resaction=1",
              dataType: "html",
              success: function(response) {
                  if(response == "1"){
                    //location.reload();
                    $("#res_state").html("ON");
                  }else{
                    console.log(response);
                  }
              }
          });
          
      }
      else if($(this).is(":not(:checked)")){
          $.ajax({
              type: "GET",
              url: "php/out_of_stock_item.php?resaction=0",
              dataType: "html",
              success: function(response) {
                if(response == "1"){
                  $("#res_state").html("OFF");
                  //location.reload();
                }else{
                  console.log(response);
                }
              }
          });
      }
  });
});

function logout() {
    $.ajax({
        //create an ajax request to display.php
        type: "POST",
        url: "php/logout.php",
        dataType: "html", //expect html to be returned
        success: function (response) {
         if(response == "1")
         {
            (async () => {
                const {
                  value: response
                } = await Swal.fire({
                  icon: 'success',
                  title: 'Logout successfull',
                })
          
          
                window.location.replace("index.php");
          
          
              })()
         }
        }
      });
    
}

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: true,
  
})
// Pusher.logToConsole = true;

var pusher = new Pusher('7e8468813b5c9a27343c', {
  cluster: 'ap2',
  forceTLS: true
});

var channel = pusher.subscribe('my-channel');
channel.bind('my-event', function(data) {
  $.ajax({
    type: "POST",
    url: "php/notification.php",
    dataType: "html",
    data:{
      id:data['id'],
      msg:data['message']
    }, 
    success: function (response) {
     if(response == "1"){
        
        $.ajax({
          type: "POST",
          url: "php/notification.php",
          dataType: "html",
          success: function (response) {
            $("#notification-dropdown").html(response);
          }
        })
        Toast.fire({
          icon: 'success',
          title: data['message']
        })
        $(".swal2-styled").css('background-color', '#fff')
        $(".swal2-styled").css('color', '#333')
        $(".swal2-confirm").html('&#x2716;')
        // loadorder(1);
        

     }
    //  console.log(data);
    }
  });  
});
    