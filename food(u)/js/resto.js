$(document).ready(function () {
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }
    loaditem(decodeURIComponent($.urlParam('rid')));
    $(".btnmenu").click(function(){
        $(".btnmenu").removeClass("menuselected");
        $(this).addClass("menuselected");
    });
    $(".searchinput").keyup(function(){
      $.ajax({
        type: "GET",
        url: "php/serchres.php?itemrid="+decodeURIComponent($.urlParam('rid'))+"&serachitem="+$(".searchinput").val(),
        dataType: "html",
        success: function(response) {  
                   $("#items").html(response);
        }
      })
    })
  
});
function loaditem(rid, mid) {
    if(mid == null){
        $.ajax({
            type: "GET",
            url: "php/load_items.php?rid=" + rid,
            dataType: "html",
            success: function(response) {
              $("#items").html(response);
            }
          });
    }
    if(mid != null && rid != null){
        $.ajax({
            type: "GET",
            url: "php/load_items.php?mid=" + mid + "&rid=" + rid,
            dataType: "html",
            success: function(response) {
              $("#items").html(response);
            }
          });
    }
 
}
function countcartitems(){
    
  $.ajax({
      type: "GET",
      url: "php/addtocart.php?itemcount=1",
      dataType: "html",
      success: function(response) {
        $("#cartcounter").html(response);
        // console.log(response);
      }
    });
}
function addtocart(id,resid,mid,action){
  if(action == "addqty"){
    $.ajax({
      type: "GET",
      url: "php/addtocart.php?addqty=" + id,
      dataType: "html",
      success: function(response) {
        if(mid == 0){
          loaditem(resid);
        }else{
          loaditem(resid,mid);
        }
        if(response.substring(0, 5) == "noqty"){
          Swal.fire({
            icon: 'error',
            text: 'No More Quantity in Restaurants',
            timer: 1200
          })
        }
      }
    });
  }
  else if(action == "subqty"){
    $.ajax({
      type: "GET",
      url: "php/addtocart.php?subqty=" + id,
      dataType: "html",
      success: function(response) {
         //console.log(response );

        countcartitems();
        if(mid == 0){
          loaditem(resid);
        }else{
          loaditem(resid,mid);
        }
      }
    });
  }
  else{
    $.ajax({
      type: "GET",
      url: "php/addtocart.php?add=1&id=" + id,
      dataType: "html",
      success: function(response) {
        // console.log(response);

         if(response == "res0"){
          Swal.fire({
            position: 'center',
            title: 'Items already in cart',
            text: 'Your cart contains items from other restaurant. Would you like to reset your cart for adding items from this restaurant?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#000',
            cancelButtonBorderColor:'#60b246',
            confirmButtonColor: '#60b246',
            confirmButtonText: 'Yes, Add it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                type: "GET",
                url: "php/addtocart.php?add=1&cres=1&id=" + id,
                dataType: "html",
                success: function(response) {    
                  $("#cartcounter").html(response);
                    loaditem(resid,mid); 
                }
              });
              
            }
          })
        }else{
          $("#cartcounter").html(response);
          loaditem(resid,mid);
        }
      }
      });
  }
  
}
function fav(resid,msg){
  if(msg == "set")
  {
    $.ajax({
      type: "GET",
      url: "php/reg.php?setfavrid="+resid,
      dataType: "html",
      success: function(response) {
       if(response == "1"){
        location.reload();
       }
       else{
         console.log(response);
       }
       console.log(response);

      }
    });
  }
  if(msg == "unset"){
    //alert(resid);
    $.ajax({
      type: "GET",
      url: "php/reg.php?unsetfavrid="+resid,
      dataType: "html",
      success: function(response) {
       if(response == "1"){
        location.reload();
       }
      }
    });
  }
  
}

