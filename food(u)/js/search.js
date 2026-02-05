var header = document.getElementById("mytab");
var btns = header.getElementsByClassName("demo1");
for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active1");
        current[0].className = current[0].className.replace(" active1", "");
        this.className += " active1";
    });
}
$(document).ready(function(){

    $("#btnclear").click(function(){
        $("#searchinput").val('');
        $.ajax({
          type: "GET",
          url: "php/serchres.php?allres=1",
          dataType: "html",
          success: function(response) {  
              $(".loadres").html(response);
              $(".loaditem").html(response);
          }
        });
      });
    $("#searchinput").keyup(function(){
      if($("#searchinput").val() != ""){
        $.ajax({
          type: "GET",
          url: "php/serchres.php?resname="+$("#searchinput").val(),
          dataType: "html",
          success: function(response) {  
              $(".loadres").html(response);
          }
        });
        $.ajax({
          type: "GET",
          url: "php/serchres.php?itemname="+$("#searchinput").val(),
          dataType: "html",
          success: function(response) {  
              $(".loaditem").html(response);
          }
        });
      }
      else{
        $(".loaditem").html("");
        $.ajax({
          type: "GET",
          url: "php/serchres.php?allres=1",
          dataType: "html",
          success: function(response) {  
              $(".loadres").html(response);
          }
        });
      }
       
    })
  
});
function resto(id) {
  location.href = "resto.php?rid=" + id;
}
