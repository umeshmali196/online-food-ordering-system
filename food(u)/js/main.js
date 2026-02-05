$(document).ready(function(){
   $("#alerterror").hide();
   $("#loginerr").hide();
   $('#loginerr').hide();
   $("#alerterror2").hide();
   $("#signuperr").hide();
   $('#signuperr').hide();
});
const Toast = Swal.mixin({
   toast: true,
   position: 'bottom-end',
   showConfirmButton: true,
   // timer: 65000,
   // timerProgressBar: true,
   // onOpen: (toast) => {
   //   toast.addEventListener('mouseenter', Swal.stopTimer)
   //   toast.addEventListener('mouseleave', Swal.resumeTimer)
   // }
 })
 // Pusher.logToConsole = true;
 
 var pusher = new Pusher('7e8468813b5c9a27343c', {
   cluster: 'ap2',
   forceTLS: true
 });
 
 var channel = pusher.subscribe('user-channel');
 channel.bind('user-event', function(data) {
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
         Toast.fire({
           icon: 'info',
           action: 'ok',
           title: data['message']
         })
         $(".swal2-popup.swal2-toast").css('background-color', '#333');
         $(".swal2-title").css('color', '#fff');
         // $(".swal2-timer-progress-bar").css('background-color', 'rgb(247, 154, 154)');
         $(".swal2-actions").show();
         $(".swal2-confirm").show();
         $(".swal2-styled").css('background-color', '#333')
         $(".swal2-styled").css('color', '#fff')
         $(".swal2-confirm").html('&#x2716;')

      }
     //  console.log(data);
     }
   });  
 });
     
function signup(){
  var form = $('#regform');
  var formData = $(form).serialize();
  
  $.ajax({
    url: "php/reg.php",
    type: "POST",
    data: formData,
    
    success: function(dataResult){
       if (dataResult == "1") {
          window.location.reload();
       } else{
        $("#alerterror2").show();
        $("#signuperr").show();
        $('#signuperr').html(dataResult);
       }
    }
 });
}
function login(){
  var form = $('#loginform');
  var formData = $(form).serialize();
  $.ajax({
    url: "php/logincheck.php",
    type: "POST",
    data: formData,
    
    success: function(dataResult){
       if (dataResult == "1") {
          window.location.reload();
       } else{
          $("#alerterror").show();
          $("#loginerr").show();
          $('#loginerr').html(dataResult);
       }
      console.log(dataResult);
    }
 });
}
