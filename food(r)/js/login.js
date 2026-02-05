$(document).ready(function(){
    var input = $('.validate-input .input100');

    $('#btnsubmit').on('click',function(e){
       
        e.preventDefault();
        var check = true;
        
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
      
 
        if (check) {
           if($("#file").val() != "") {
            var frm = document.getElementById("resForm");
            var formData = new FormData(frm);
            var fd = document.getElementById("file").files[0];
            var imgtype = fd.name.split(".").pop().toLowerCase();
            //alert(imgtype);
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
                  title: "Error In Image.",
                  text: "Image size is Large!Plz Select Image Below 2 MB"
                });
            }
            else{
                $.ajax({
                    url: "php/regres.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(dataResult){
                       //var dataResult = JSON.parse(dataResult);
                       if (dataResult == "1") {
                          (async () => {
                              const { value:response } = await Swal.fire({
                                icon: 'success',
                                  title: 'sign up successful',
                              })
                              
                              if (response) {
                                  window.location.replace("index.php");
                              }
                              
                              })()
                       } else{
                          $("#success").hide();
                          $("#err").show();
                          $('#err').html(dataResult);
                       }
                    }
                 });
            }
       
        
        
            }
            else{
                $("#err").show();
                $('#err').html("Plz Select A Image");
            }
        }

        return check;
    });
    $('#btnlogin').on('click',function(){
        var check = true;
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
        var email = $('#email').val();   
        var pass = $('#pass').val();
        if (check) {
           $.ajax({
              url: "php/logincheck.php",
              type: "POST",
              data: {
                 email: email,
                 pass: pass
              },
              success: function(dataResult){
                 if (dataResult == "1") {
                    (async () => {
                        const { value:response } = await Swal.fire({
                          icon: 'success',
                            title: 'login successful',
                        })
                        
                        if (response) {
                            window.location.replace("order.php");
                        }
                        
                        })()
                 } else{
                    $("#error").show();
                    $('#error').html(dataResult);
                 }
              }
           });
        }
        return check;
    });
    $('#btnforgotPass').on('click',function(){
        var check = true;
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }
        var email = $('#email').val();   
        // var pass = $('#pass').val();
        if (check) {
            $(".loader").show();
           $.ajax({
              url: "php/logincheck.php",
              type: "POST",
              data: {email: email},
              success: function(dataResult){
                 if (dataResult == "1") {
                    // $(".loader").hide();
                     Swal.fire({
                            icon: 'success',
                            text: 'Password link Send Successful',
                        })
                 } else{
                    $("#error").show();
                    $('#error').html(dataResult);
                 }
              }
           });
        }
        return check;
    });

    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        
        if($(input).attr('id') == 'moblie') {
            if($(input).val().trim().match(/^\d{10,11}$/) == null) {
                return false;
            }
        }
        if($(input).attr('id') == 'pass2') {
                if($(input).val() != $('#pass').val()) {
                    return false;
                }            
        } 
        if($(input).attr('id') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }    
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
        document.getElementsByClassName("alert-validate::before").content = "dsf";


    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }  
  });