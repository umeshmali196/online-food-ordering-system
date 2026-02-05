$(document).ready(function() {
 
  $("#loginerr").hide();
  $("#signuperr").hide();
  $("#alerterror").hide();
  $("#alerterror2").hide();

  $(".card").hover(
    function() {
      $(this)
        .addClass("shadow-lg")
        .css("cursor", "pointer");
    },
    function() {
      $(this).removeClass("shadow-lg");
    }
  );
  $(".card").hover(
    function() {
      $(this)
        .addClass("shadow-lg")
        .css("cursor", "pointer");
    },
    function() {
      $(this).removeClass("shadow-lg");
    }
  );
  $('.carousel').carousel({
    interval: 2000
  })

});

