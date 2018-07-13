<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 10/11/17
 * Time: 8:09 PM
 */

session_start();

//if (!isset($_SESSION['companyId']) || !isset($_SESSION['phone'])
//    || empty(trim($_SESSION['companyId'])) || empty(trim($_SESSION['phone']))) {
//    echo "<script>alert('Please login first!');window.location.replace('login.php');</script>";
//} else {
////    echo $_SESSION['companyId'] . "<br>";
////    echo $_SESSION['phone'];
//    ?>
    <html>
    <head>
        <title>Dashboard | Product Catalog</title>
    </head>
    <body>
    <a href="../../manage_products/functions/addProductDetails.php" type="button">Add Products Details</a>
    <br>
    <a href="../../manage_products/functions/deleteProductDetails.php" type="button">Delete Products Details</a>
    <br>
    <a href="../../manage_products/functions/updateProductDetails.php" type="button">Update Products Details</a>
    <br><br>
    <a href="logout.php" type="button">Log out</a>
    </body>
    </html>
<!--    --><?php
//}
//?>