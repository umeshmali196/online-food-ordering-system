$(document).ready(function() {
  tabanimation();
  selectactive();
  $(".fa-times-circle").hide();
  $(".fa-edit").hide();
  $(".catlists").hover(
    function() {
      $(this)
        .find("i")
        .show();
    },
    function() {
      $(this)
        .find("i")
        .hide();
    }
  );
  
});

function selectactive() {
  var header = document.getElementById("categorylist");
  var btns = header.getElementsByClassName("mdc-list-item");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function(catid) {
      var current = header.getElementsByClassName("myactive");
      if (current.length > 0) {
        current[0].className = current[0].className.replace(" myactive", "");
      }
      this.className += " myactive";
      // $("#catlists").children("i").hide();
    });
  }
}
function tabanimation() {
  $(".panel").width($("#tab-tab1").outerWidth()+20);
  $("ul.nav li:nth-child(1)").on("click", function() {

    $(".panel").width($("#tab-tab1").outerWidth()+20);

    $(".panel").animate(
      {
        left: "0px"
      },
      "slow"
    );
  });
  $("ul.nav li:nth-child(2)").on("click", function() {

    $(".panel").width($("#tab-tab2").outerWidth());
    
    $(".panel").animate(
      {
        left: $("#tab-tab1").outerWidth()+20 + "px"
      },
      "slow"
    );
  });
  $("ul.nav li:nth-child(3)").on("click", function() {

    $(".panel").width($("#tab-tab3").outerWidth());

    $(".panel").animate(
      {
        left: $("#tab-tab1").outerWidth()+$("#tab-tab2").outerWidth()+10 + "px"
      },
      "slow"
    );
  });
}
function loaditem(catid) {
  $("#loadadditem_layout").html("");
  $.ajax({
    type: "GET",
    url: "php/load_item.php?id=" + catid,
    dataType: "html", 
    success: function(response) {
      $("#loaditem").html(response);
      $(".rolldown-list li").each(function() {
        var delay = $(this).index() * 0.25 + "s";
        //console.log($(this).index() * .25);
        //alert(delay);
        $(this).css({
          webkitAnimationDelay: delay,
          //mozAnimationDelay: delay,
          animationDelay: delay
        });
      });
      $(".fa-times-circle").hide();
      $(".itemlist").hover(
        function() {
          $(this)
            .find("i")
            .show();
        },
        function() {
          $(this)
            .find("i")
            .hide();
        }
      );
    }
  });
}
function loadadditem_layout(catid) {
  $.ajax({
    //create an ajax request to display.php
    type: "GET",
    url: "php/load_add_item.php?id=" + catid,
    dataType: "html", //expect html to be returned
    success: function(response) {
      $("#loadadditem_layout").html(response);
    }
  });
}
function load_update_item(itemid) {
  //alert(itemid);
  // var header = document.getElementById("itemlist");
  // var btns = header.getElementsByClassName("mdc-list-item");
  // for (var i = 0; i < btns.length; i++) {
  //   btns[i].addEventListener("click", function() {
  //     var current = header.getElementsByClassName("myactive");
  //     if (current.length > 0) {
  //       current[0].className = current[0].className.replace(" myactive", "");
  //     }
  //     this.className += " myactive";
  //   });
  // }
  $.ajax({
    type: "POST",
    url: "php/load_update_item.php?id=" + itemid,
    dataType: "html", 
    success: function(response) {
      $("#loadadditem_layout").html(response);
    }
  });
}
function insertitem(e) {
  e.preventDefault();

  if (
    $("#name").val() != "" &&
    $("#desc").val() != "" &&
    $("#price").val() != "" &&
    $("#file").val() != ""
  ) {
    var frm = document.getElementById("itemForm");
    var formData = new FormData(frm);
    var fd = document.getElementById("file").files[0];
    var imgtype = fd.name
      .split(".")
      .pop()
      .toLowerCase();
    if (jQuery.inArray(imgtype, ["png", "jpg", "jpeg"]) == -1) {
      Swal.fire({
        icon: "error",
        title: "Error In Image",
        text: "Invalid File Formate!Plz Select Image File"
      });
    } else if (fd.size > 2000000) {
      Swal.fire({
        icon: "error",
        title: "Error In Image",
        text: "Image size is Large!Plz Select Image Below 2 MB"
      });
    } else {
      $.ajax({
        url: "php/crud_item.php",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
          Swal.fire(
            "Item Successfully Saved",
            "Item Is Under Review...",
            "success"
          );
          if(response == "1"){
            Swal.fire({
              icon: "success",
              title: "Item Added successfully",
              showConfirmButton: false,
              allowOutsideClick: false,
              timer: 1500          
            }).then((result) => {
              if (result.dismiss === Swal.DismissReason.timer) {
                loaditem($("#catname").val());
              }
            })
          }else{
            console.log(response);

          }
        }
      });
    }
  } else {
    Swal.fire({
      icon: "error",
      title: "Fill All The Deatils"
    });
  }
}
function updateitemdetail(e) {
  e.preventDefault();
  var frm = document.getElementById("updateitemForm");
  var formData = new FormData(frm);
  var fd = document.getElementById("changefile").files[0];
  if(fd != null){
    var imgtype = fd.name.split(".").pop().toLowerCase();
    if (jQuery.inArray(imgtype, ["png", "jpg", "jpeg"]) == -1) {
      Swal.fire({
        icon: "error",
        title: "Error In Image",
        text: "Invalid File Formate!Plz Select Image File"
      });
    }
    else if (fd.size > 2000000) {
      Swal.fire({
        icon: "error",
        title: "Error In Image",
        text: "Image size is Large!Plz Select Image Below 2 MB"
      });
    }
    else {
      $.ajax({
        url: "php/crud_item.php",
        type: "post",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
          if(response == "1"){
            Swal.fire({
              icon: "success",
              title: "Item Updated Successfully"
            });
            // loaditem($("#catname").val());
            // $("#loadadditem_layout").html("");
            load_update_item(formData.get("id"));
          }else{
            console.log(response);
          }
        }
      });
    }
  } else {
    $.ajax({
      url: "php/crud_item.php",
      type: "post",
      data: formData,
      contentType: false,
      cache: false,
      processData: false,
      success: function(response) {
        if(response == "1"){
          Swal.fire({
            icon: "success",
            title: "Item Updated Successfully"
          });
          //alert(formData.get("id"));
          load_update_item(formData.get("id"));
        }
        else{
          console.log(response);
        }
      }
    });
  }
}
function removeqty(id){
  $.ajax({
      type: "GET",
      url: "php/crud_item.php?remove_qty=" + id,
      dataType: "html", 
      success: function(response) {
          if(response == "1"){
            load_update_item(id);

          }else{
              console.log(response);
          }
      }
  });
}
function deletecategory(cid, cname) {
  $.ajax({
    type: "GET",
    url: "php/category_crud.php?sid=" + cid,
    dataType: "html", //expect html to be returned
    success: function(response) {
      var items = response;
      Swal.fire({
        title: "Are you sure?",
        html:
          "Your Category <b class='badge bg-shadow-orenge text-white font-weight-bold'>" +
          cname +
          "</b> And its <b class='badge bg-shadow-orenge text-white font-weight-bold'>" +
          items +
          " Items</b> Both will Be Delete? ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.value) {
          $.ajax({
            type: "GET",
            url: "php/category_crud.php?did=" + cid,
            dataType: "html", //expect html to be returned
            success: function(response) {}
          });
          Swal.fire(
            "Deleted!",
            "Your Category has been deleted.",
            "success"
          ).then(result => {
            location.reload();
          });
        }
      });
    }
  });
}
function updatecategory(cid, cname) {
  Swal.fire({
    title: "Enter New Category Name",
    input: "text",
    inputValue: cname,
    inputValidator: inputValue => {
      if (inputValue == "") {
        return "Plz Enter Category Name!";
      }
    },
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Update Name"
  }).then(result => {
    if (result.value) {
      $.ajax({
        type: "GET",
        url: "php/category_crud.php?uid=" + cid + "&ucname=" + result.value,
        dataType: "html",
        success: function(response) {}
      });
      Swal.fire(
        "Updated!",
        "Your Category " + result.value + " has been Updated.",
        "success"
      ).then(result => {
        location.reload();
      });
    }
  });
}
function deleteitem(id, name, cid) {
  //alert(cid);
  Swal.fire({
    title: "Are you sure?",
    html:
      "Your Item <b class='badge bg-shadow-orenge text-white font-weight-bold'>" +
      name +
      " </b> will Be Delete? ",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then(result => {
    if (result.value) {
      $.ajax({
        type: "GET",
        url: "php/crud_item.php?delete=" + id,
        dataType: "html", //expect html to be returned
        success: function(response) {
          if(response == "1"){
            Swal.fire("Deleted!", "Your Item has been deleted.", "success").then(
              result => {
                loaditem(cid);
              }
            );
          }else{
            console.log(response);
          }
        }
      });
      
    }
  });
}
function dispfname() {
  $(".custom-file-input").on("change", function() {
    var fileName = $(this)
      .val()
      .split("\\")
      .pop();
    $(this)
      .siblings(".custom-file-label")
      .addClass("selected")
      .html(fileName);
  });
}
function showitemwithtoggle(catid) {
  $.ajax({
    type: "GET",
    url: "php/load_item_toggle.php?id=" + catid,
    dataType: "html", 
    success: function(response) {
      $("#itemswithtoggle").html(response);
    }
  });
}
function showhistory(cid) {
  $.ajax({
    //create an ajax request to display.php
    type: "GET",
    url: "php/load_item_edit_history.php?id=" + cid,
    dataType: "html", //expect html to be returned
    success: function(response) {
      $("#history").html(response);
    }
  });
}
