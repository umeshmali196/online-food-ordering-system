$(document).ready(function() {
  $("#btnapply").click(function(){
    var code= $("#txtcode").val();
    checkPromocode(code);
  });
});

function countcartitems() {
  $.ajax({
    type: "GET",
    url: "php/addtocart.php?itemcount=1",
    dataType: "html",
    success: function(response) {
      $("#cartcounter").html(response);
    }
  });
}
function addtocart(id) {
  $.ajax({
    type: "GET",
    url: "php/addtocart.php?add=1&id=" + id,
    dataType: "html",
    success: function(response) {
      if (response == "0") {
        Swal.fire({
          position: "center",
          icon: "error",
          title: "Item Already In Cart",
          showConfirmButton: false,
          timer: 1200
        });
      } else if (response == "res0") {
        Swal.fire({
          position: "center",
          title: "Items already in cart",
          text:
            "Your cart contains items from other restaurant. Would you like to reset your cart for adding items from this restaurant?",
          icon: "warning",
          showCancelButton: true,
          cancelButtonColor: "#000",
          cancelButtonBorderColor: "#60b246",
          confirmButtonColor: "#60b246",
          confirmButtonText: "Yes, Add it!"
        }).then(result => {
          if (result.value) {
            $.ajax({
              type: "GET",
              url: "php/addtocart.php?add=1&cres=1&id=" + id,
              dataType: "html",
              success: function(response) {
                Swal.fire({
                  position: "center",
                  icon: "success",
                  title: "Item Added To Cart",
                  showConfirmButton: false,
                  timer: 1200
                });
                $("#cartcounter").html(response);
              }
            });
          }
        });
      } else {
        Swal.fire({
          position: "center",
          icon: "success",
          title: "Item Added To Cart",
          showConfirmButton: false,
          timer: 1200
        });
        $("#cartcounter").html(response);
      }
    }
  });
}
function setAddress(aid) {
  $("#addHead1").hide();

  $.ajax({
    type: "GET",
    url: "php/reg.php?setAddSession=" + aid,
    dataType: "html",
    success: function(response) {
      location.reload();

      $("#setAddrow").hide();
      $("#addHead1").hide();
      $("#seletedAddrow").show();
    }
  });
}
function unsetaddress() {
  $.ajax({
    type: "GET",
    url: "php/reg.php?unsetAddSession=1",
    dataType: "html",
    success: function(response) {
      location.reload();
      $("#seletedAddrow").hide();
      $("#setAddrow").show();
    }
  });
}
function checkPromocode(promocode){
  $.ajax({
    type: "GET",
    url: "php/addtocart.php?setpromocode="+promocode,
    dataType: "html",
    success: function(response) {
      if(response == "1"){
        location.reload();
      }
      else if(response == "minAmountErr"){
        Swal.fire({
          position: "center",
          icon: "error",
          title: "",
          text: "Your Cart Total Is Less For This Offer"
        });
      }
      else if(response == "newUserErr"){
        Swal.fire({
          position: "center",
          icon: "error",
          title: "",
          text: "This Offer is Only For New User "
        });
      }
      else if(response == "loginErr"){
        Swal.fire({
          position: "center",
          icon: "error",
          title: "Login First To Use This Offer",
        });
      }
      else if(response == "TimeErr"){
        Swal.fire({
          position: "center",
          icon: "error",
          title: "Offer is Expire",
        });
      }
      else if(response == "invlidCodeErr"){
        $("#offerErr").show();
       $("#offerErr").html("ENTER VALID PROMOCODE");
      }
      else{
        console.log(response);
      }
    }
  });
}
function addAddress(e) {
  e.preventDefault();
  $.ajax({
      url: "php/reg.php",
      type: "POST",
      data: $("#addForm").serialize(),
      success: function(response) {
          if (response == "1") {
              Swal.fire(
                  'Good job!',
                  'Address Added Sucessfully!',
                  'success'
              ).then((result) => {
                  if (result.value) {
                      location.reload();
                  }
              })
          } else {
              console.log(response);
          }
      }
  });

}
