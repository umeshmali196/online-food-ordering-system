<div class="modal fade right" id="singupmodal" tabindex="-1" role="dialog" aria-labelledby="singupmodal"
    aria-hidden="true">

    <div class="modal-dialog modal-full-height modal-right" role="document">


        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button " class="close" data-dismiss="modal" aria-label="Close"
                    class="font-weight-bold text-dark d-inline">
                    <span aria-hidden="true">&times;</span>
                </button><br>
            </div>
            <div class="mt-3 ml-3 ">
                <h4 class="text-dark font-weight-bold">SING UP</h4>
                <h6 class="font-weight-bold " style="color: #fc8019;">
                    <a data-toggle="modal" data-target="#loginmodal" data-dismiss="modal"
                        aria-label="Close"><u>LOGIN</u></a></h6>
            </div>
            <div class="modal-body">
                <form  id="regform" method="post" autocomplete="off">
                    <div class="md-form">
                        <input type="text" id="name" name="name" class="form-control myinput">
                        <label for="name">Name</label>
                    </div>
                    <div class="md-form">
                        <input type="number" id="moblie" name="moblie" class="form-control myinput">
                        <label for="moblie">Mobile</label>
                    </div>
                    <div class="md-form">
                        <input type="email" id="regemail" name="email" class="form-control myinput">
                        <label for="regemail">Email</label>
                    </div>
                    <div class="md-form">
                        <input type="password" id="regpass" name="pass" class="form-control myinput">
                        <label for="regpass">password</label>
                    </div>

                    <div class="justify-content-center md-form">
                        <button type="button" class="btn text-white font-weight-bold w-100 mt-3"
                            style="background-color: #fc8019;" onclick="signup()">SIGN UP</button>
                    </div>
                    <div class="alert alert-danger mt-3 " role="alert" id="alerterror2" style="display: none;">
                            <strong id="signuperr" class="text-capitalize"></strong>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
</style>
