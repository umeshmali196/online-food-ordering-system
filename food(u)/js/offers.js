$(document).ready(function(){
    var n = "COPY CODE<i class='far fa-copy p-2'></i>";
    var m = "COPIED<i class='fas fa-copy p-2'></i>";

    $(".btncopy").click(function(){
        //$(".btncopy").text(n);
        $(".btncopy").html(n);
        $(this).html(m)
        $(this).find("i").addClass("fas fa-copy");

        //alert("hii");
      });
  
});
// js for copy code text
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    //$temp.val($(element).text()).select();
    $temp.val(element).select();

    document.execCommand("copy");
    $temp.remove();
}
