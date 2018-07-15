<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 10/11/17
 * Time: 7:46 PM
 */

//include("../../sessions/session.php");
session_start();

if (isset($_SESSION['companyId']) && isset($_SESSION['phone'])
    && !empty(trim($_SESSION['companyId'])) && !empty(trim($_SESSION['phone']))) {
    header('Location: dashboard.php');
} else {
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <script type="text/javascript" src="../../../Resources/jquery-3.2.1.js"></script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sign In | Product Catalog</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet"
              href="../../../Resources/AdminLTE-2.4.2/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet"
              href="../../../Resources/AdminLTE-2.4.2/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="../../../Resources/AdminLTE-2.4.2/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../../../Resources/AdminLTE-2.4.2/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="../../../Resources/AdminLTE-2.4.2/plugins/iCheck/square/blue.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Google Font -->
        <link rel="stylesheet"
              href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
    <body class="hold-transition login-page" >
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Product </b>Catalog</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <h4 class="login-box-msg ">Sign in</h4>


            <form>
                <div class="form-group has-feedback">
                    <input type="number" id="phoneNumber" placeholder="Enter Phone Number" class="form-control"
                           required>
                    <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" id="password" placeholder="Enter Password" class="form-control" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" id="loginCompany" class="btn btn-primary btn-block btn-flat">Sign In
                        </button>
                    </div>
                </div>
                <br>
                <a type="submit" href="register.php">Register</a><br>
                <a type="submit" href="#">Forgot Password?</a>
            </form>

            <script type="text/javascript">
                $(document).ready(function () {
                    $("#loginCompany").on("click", function (e) {
                        e.preventDefault();

                        var phoneNumber = $("#phoneNumber").val();
                        var password = $("#password").val();

                        if (phoneNumber === "" || password === "") {
                            alert("Enter all fields");
                        } else {
                            $.ajax({
                                url: "check_login.php",
                                type: "POST",
                                data: {
                                    phoneNumber: phoneNumber, password: password
                                },
                                dataType: "json",
                                success: function (json) {
                                    if (json.status === "success") {
                                        window.location.replace('dashboard.php');
                                    } else {
                                        alert(json.message);
                                    }
                                }
                            });
                        }
                    });
                });
            </script>

        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="../../../Resources/AdminLTE-2.4.2/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../../../Resources/AdminLTE-2.4.2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../../../Resources/AdminLTE-2.4.2/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
    </body>
    </html>
    <?php
}
?>
