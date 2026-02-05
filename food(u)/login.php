<div class="modal fade right" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="loginmodal"
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
                <h4 class="text-dark font-weight-bold">LOGIN</h4>
                <h6 class="font-weight-bold " style="color: #fc8019;"><a data-toggle="modal" data-target="#singupmodal"
                        data-dismiss="modal" aria-label="Close"><u>OR SIGN UP</u></a></h6>
            </div>
            <div class="modal-body">

                <form method="post" id="loginform">
                    <div class="md-form">
                        <input type="email" id="email" name="email" class="form-control myinput">
                        <label for="email">Email</label>
                    </div>
                    <div class="md-form">
                        <input type="password" id="pass" name="pass" class="form-control myinput">
                        <label for="pass">Password</label>
                    </div>

               
                <div class="justify-content-center">
                    <button type="button" class="btn text-white font-weight-bold w-100 mt-3"
                        style="background-color: #fc8019;" onclick="login()">LOGIN</button>
                </div>
                    <div class="alert alert-danger mt-5 " role="alert" id="alerterror" style="display: none">
                            <strong id="loginerr" style="display: none" class="text-lowercase"></strong>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>