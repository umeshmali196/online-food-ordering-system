$(document).ready(function() {
 // $('[data-toggle="tooltip"]').tooltip();
  loadpage(1);
  $(".btnpage").click(function() {
    $(".btnpage").removeClass("myactive");
    $(this).addClass("myactive");
    $.ajax({
      type: "GET",
      url: "php/load_feedback.php?page=" + $(this).val(),
      dataType: "html",
      success: function(response) {
        $("#target-content").html(response);
      }
    });
  });
});
function loadpage(id) {
  $.ajax({
    type: "GET",
    url: "php/load_feedback.php?page=" + id,
    dataType: "html", 
    success: function(response) {
      $("#target-content").html(response);
    
    }
  });
}
