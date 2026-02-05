<?php
include "php/database.php";

?>
<html>

<head>
    <title>FOODIFY</title>
    <?php include_once('include/links.php'); ?>
    <link rel="stylesheet" href="css/help.css" />
    <link rel="stylesheet" href="css/navbar.css" />
    <link rel="stylesheet" href="http://static.sasongsmat.nu/fonts/vegetarian.css" />

</head>

<body>
    <?php include_once("include/header.php"); ?>


    <div class="card mainhelpcard">
        <div class="card-header bg-transparent border-light">
            <h2 class="font-weight-bold">Help & Support</h2>
            <h6 class="font-weight-bolder h6">Let's take a step ahead and help you better.</h6>
        </div>
        <div class="card-body p-0">
            <div class="d-flex flex-row">

                <div class="w-25">
                    <div class="vertical-menu" id="vertical-menu">
                        <a href="#termsofuse" class="active pt-3 helpmenu" id="termsofuse" data-toggle="tab" role="tab">Terms of Use</a>
                        <a href="#PrivacyPolicy" class="mt-3 helpmenu" id="PrivacyPolicy" role="tab" data-toggle="tab">PrivacyPolicy</a>
                        <a href="#CancellationsRefunds" class="mt-3 helpmenu" data-toggle="tab" role="tab" data-toggle="tab">Fries</a>
                        <a href="#OntimeAssured" class="mt-3 " data-toggle="tab" role="tab" data-toggle="tab">Breads</a>
                    </div>
                </div>

                <div class="w-75">
                    <div class="tab-content">
                        <div class="tab-pane active" id="termsofuse">
                            <h3>HOME</h3>
                            <p>
                                These terms of use (the "Terms of Use") govern your use of our website www.swiggy.in
                                (the "Website") and our "Swiggy" application for mobile and handheld devices (the
                                "App"). The Website and the App are jointly referred to as the "Services"). Please read
                                these Terms of Use carefully before you download, install or use the Services. If you do
                                not agree to these Terms of Use, you may not install, download or use the Services. By
                                installing, downloading or using the Services, you signify your acceptance to the Terms
                                of Use and Privacy Policy (being hereby incorporated by reference herein) which takes
                                effect on the date on which you download, install or use the Services, and create a
                                legally binding arrangement to abide by the same.
                            </p>   
                        </div>
                        <div class="tab-pane" id="PrivacyPolicy">
                        <h3>HOME</h3>
                            <p>
                                These terms of use (the "Terms of Use") govern your use of our website www.swiggy.in
                                (the "Website") and our "Swiggy" application for mobile and handheld devices (the
                                "App"). The Website and the App are jointly referred to as the "Services"). Please read
                                these Terms of Use carefully before you download, install or use the Services. If you do
                                not agree to these Terms of Use, you may not install, download or use the Services. By
                                installing, downloading or using the Services, you signify your acceptance to the Terms
                                of Use and Privacy Policy (being hereby incorporated by reference herein) which takes
                                effect on the date on which you download, install or use the Services, and create a
                                legally binding arrangement to abide by the same.
                            </p>   
                        </div>
                        <div class="tab-pane" id="PrivacyPolicy">
                        <h3>HOME</h3>
                            <p>
                                These terms of use (the "Terms of Use") govern your use of our website www.swiggy.in
                                (the "Website") and our "Swiggy" application for mobile and handheld devices (the
                                "App"). The Website and the App are jointly referred to as the "Services"). Please read
                                these Terms of Use carefully before you download, install or use the Services. If you do
                                not agree to these Terms of Use, you may not install, download or use the Services. By
                                installing, downloading or using the Services, you signify your acceptance to the Terms
                                of Use and Privacy Policy (being hereby incorporated by reference herein) which takes
                                effect on the date on which you download, install or use the Services, and create a
                                legally binding arrangement to abide by the same.
                            </p>   
                        </div>
                    </div>
                   
                </div>
            </div>

        </div>


    </div>
    </div>


    </div>
    <?php include_once("include/footer.php"); ?>
    <script type="text/javascript">
    var header = document.getElementById("vertical-menu");
    var btns = header.getElementsByClassName("helpmenu");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active1");
            current[0].className = current[0].className.replace(" active1", "");
            this.className += " active1";
        });
    }


    </script>
</body>

</html>