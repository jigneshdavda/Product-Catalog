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
    <html>
    <head>
        <title>Login | Product Catalog</title>
        <script type="text/javascript" src="../../../Resources/jquery-3.2.1.js"></script>
    </head>
    <body>
    <form>
        <input type="number" id="phoneNumber" placeholder="Enter Phone Number" required><br>
        <input type="password" id="password" placeholder="Enter Password" required><br>
        <button type="submit" id="loginCompany">Log in</button>
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

    </body>
    </html>
    <?php
}
?>
