<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 12/6/18
 * Time: 7:20 PM
 */

require_once("../../../classes/DBConnect.php");
require_once("../../../classes/Constants.php");
require_once("../../../classes/PrintJson.php");
require_once("../classes/ProductsDetails.php");
//include("../../sessions/session.php");
header("Content-Type: application/json");

$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);

//if (isset($_SESSION['phoneNumber'])) {
$productDetails = new ProductsDetails($dbConnect->getInstance());
$checkVariable = false;

if (isset($_REQUEST['productDetailsArray']) && !empty($_REQUEST['productDetailsArray'])) {
    foreach ($_REQUEST['productDetailsArray'] as $productDetailsArray) {
        $insertProductDetails = $productDetails->insertProductDetails($productDetailsArray[0],
            $productDetailsArray[1], $productDetailsArray[2], $productDetailsArray[3],
            $productDetailsArray[4], $productDetailsArray[5], $productDetailsArray[6],
            $productDetailsArray[7], $productDetailsArray[8], $productDetailsArray[9],
//            $productDetailsArray[10], $productDetailsArray[11], $_SESSION['companyId']);
            $productDetailsArray[10], $productDetailsArray[11], 1);

        if ($insertProductDetails === true) {
            $checkVariable = true;
        } elseif ($insertProductDetails == Constants::STATUS_EXISTS) {
            new PrintJson(Constants::STATUS_FAILED, Constants::STATUS_EXISTS);
        } else {
            $checkVariable = false;
        }
    }

    if ($checkVariable == true) {
        new PrintJson(Constants::STATUS_SUCCESS, "Product successfully added");
    } else {
        new PrintJson(Constants::STATUS_FAILED, "Product not added");
    }
} else {
    new PrintJson(Constants::STATUS_FAILED, "No Data Received");
}
//} else {
//    new PrintJson(Constants::STATUS_FAILED, "Session expired. Please login first");
//}