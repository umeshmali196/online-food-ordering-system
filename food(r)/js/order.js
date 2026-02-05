$(document).ready(function() {
  // $('[data-toggle="tooltip"]').tooltip();
  loadorder(1);
  loadprepraingorder(1);
  loadreadyorder(1);
  loadpastorder(1);
  $(".btnnextconfirm").click(function() {
    $(".btnnextconfirm").removeClass("myactive");
    $(this).addClass("myactive");
    $.ajax({
      type: "GET",
      url: "php/load_new_order.php?page=" + $(this).val(),
      dataType: "html",
      success: function(response) {
        $("#neworder").html(response);
      }
    });
  });
  $(".btnnextpreparing").click(function() {
    $(".btnnextpreparing").removeClass("myactive");
    $(this).addClass("myactive");
    $.ajax({
      type: "GET",
      url: "php/load_preparing_order.php?page=" + $(this).val(),
      dataType: "html",
      success: function(response) {
        $(".loadprepraingorder").html(response);
      }
    });
  });
  $(".btnnextready").click(function() {
    $(".btnnextready").removeClass("myactive");
    $(this).addClass("myactive");
    $.ajax({
      type: "GET",
      url: "php/load_ready_order.php?page=" + $(this).val(),
      dataType: "html",
      success: function(response) {
        $(".loadreadyorder").html(response);
      }
    });
  });
  $(".btnnextpast").click(function() {
    $(".btnnextpast").removeClass("myactive");
    $(this).addClass("myactive");
    $.ajax({
      type: "GET",
      url: "php/load_past_order.php?page=" + $(this).val(),
      dataType: "html",
      success: function(response) {
        $(".loadpastorder").html(response);
      }
    });
  });
  // console.log()
  
});
function loadorder(id) {
  $.ajax({
    type: "GET",
    url: "php/load_new_order.php?page=" + id,
    dataType: "html",
    success: function(response) {
      $("#neworder").html(response);
    }
  });
}
function showorder(oid) {
  $.ajax({
    type: "GET",
    url: "php/show_order_accept.php?id=" + oid,
    dataType: "html",
    success: function(response) {
      $(".showorder").html(response);
    }
  });
}
function loadprepraingorder(id) {
  $.ajax({
    type: "GET",
    url: "php/load_preparing_order.php?page=" + id,
    dataType: "html",
    success: function(response) {
      $(".loadprepraingorder").html(response);
    }
  });
}
function showprepraingorder(oid) {
  $.ajax({
    type: "GET",
    url: "php/show_prepraing_order.php?id=" + oid,
    dataType: "html",
    success: function(response) {
      $(".showprepraingorder").html(response);
    }
  });
}
function loadreadyorder(id) {
  $.ajax({
    type: "GET",
    url: "php/load_ready_order.php?page=" + id,
    dataType: "html",
    success: function(response) {
      $(".loadreadyorder").html(response);
    }
  });
}
function showreadyorder(oid) {
  $.ajax({
    type: "GET",
    url: "php/show_ready_order.php?id=" + oid,
    dataType: "html", 
    success: function(response) {
      $(".showreadyorder").html(response);
    }
  });
}
function loadpastorder(id) {
  $.ajax({
    type: "GET",
    url: "php/load_past_order.php?page=" + id,
    dataType: "html",
    success: function(response) {
      $(".loadpastorder").html(response);
    }
  });
}
function showpastorder(oid) {
  $.ajax({
    type: "GET",
    url: "php/show_past_order.php?id=" + oid,
    dataType: "html", 
    success: function(response) {
      $(".showpastorder").html(response);
    }
  });
}
function preaddtime() {
  var a = parseInt($("#pretime").val());
  var sum = a + 1;
  $("#pretime").val(sum);
}
function presubtime() {
  var a = parseInt($("#pretime").val());
  var sum = a - 1;
  $("#pretime").val(sum);
}
function deladdtime() {
  var a = parseInt($("#deltime").val());
  var sum = a + 1;
  $("#deltime").val(sum);
}
function delsubtime() {
  var a = parseInt($("#deltime").val());
  var sum = a - 1;
  $("#deltime").val(sum);
}
function orderacc(oid) {
 

  $.ajax({
    type: "GET",
    url: "php/manage_order.php?orderaccept=" + oid,
    dataType: "html",
    success: function(response) {
      if (response == "1") {
        Swal.fire({
          icon: "success",
          title: "Order Accepted",
          showConfirmButton: false,
          allowOutsideClick: false,
          timer: 1500          
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            location.reload();
          }
        })
      }
    }
    
  });
  
}
function orderrej(oid) {
  $.ajax({
    type: "GET",
    url: "php/manage_order.php?orderreject=" + oid,
    dataType: "html",
    success: function(response) {
      if (response == "1") {
        Swal.fire({
          icon: "error",
          title: "Order Rejected",
          showConfirmButton: false,
          allowOutsideClick: false,
          timer: 1500          
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            location.reload();
          }
        })

      }else{
        console.log(response);
      }
    }
  });
}
function orderready(oid){
  $.ajax({
    type: "GET",
    url: "php/manage_order.php?orderready=" + oid,
    dataType: "html",
    success: function(response) {
      if (response == "1") {
        Swal.fire({
          icon: "success",
          title: "Order Is ready And Out For Delivery",
          showConfirmButton: false,
          allowOutsideClick: false,
          timer: 1500          
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            location.reload();
          }
        })

      }
    }
  });
}
function orderdeliverd(oid){
  $.ajax({
    type: "GET",
    url: "php/manage_order.php?deliverd=" + oid,
    dataType: "html",
    success: function(response) {
      if (response == "1") {
        Swal.fire({
          icon: "success",
          title: "Order Is Deliverd",
          showConfirmButton: false,
          allowOutsideClick: false,
          timer: 1500          
        }).then((result) => {
          if (result.dismiss === Swal.DismissReason.timer) {
            location.reload();
          }
        })

      }
    }
  });
}

