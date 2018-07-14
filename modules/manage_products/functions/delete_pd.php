<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 19/6/18
 * Time: 1:48 PM
 */

require_once("../../../classes/DBConnect.php");
require_once("../../../classes/Constants.php");
require_once("../../../classes/PrintJson.php");
require_once("../classes/ProductsDetails.php");
include("../../sessions/session.php");

$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);

if (isset($_REQUEST['deleteProductDetailsId']) && !empty(trim($_REQUEST['deleteProductDetailsId']))) {
    $productDetails = new ProductsDetails($dbConnect->getInstance());
    $deleteProductDetails = $productDetails->deleteProductDetails($_REQUEST['deleteProductDetailsId'], $_SESSION['companyId']);
//    $deleteProductDetails = $productDetails->deleteProductDetails($_REQUEST['deleteProductDetailsId'], 1);

    if ($deleteProductDetails === true) {
        new PrintJson(Constants::STATUS_SUCCESS, "Successfully deleted");
    } else {
        new PrintJson(Constants::STATUS_FAILED, "Failed to delete");
    }

} else {
//    echo "Empty or null values received";
    new PrintJson(Constants::STATUS_FAILED, "Empty or null values received");
}