<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 19/6/18
 * Time: 1:02 PM
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

if (isset($_REQUEST['updateProductDetails'])) {
    $productDetails = new ProductsDetails($dbConnect->getInstance());

    foreach ($_REQUEST['updateProductDetails'] as $updateDetails) {
        $updateProductDetails = $productDetails->updateProductDetails($updateDetails[0],
            $updateDetails[1], $updateDetails[2], $updateDetails[3], $updateDetails[4],
            $updateDetails[5], $updateDetails[6], $updateDetails[7], $updateDetails[8],
            $updateDetails[9], $updateDetails[10], $_SESSION['companyId']);

        if ($updateProductDetails === true) {
            new PrintJson(Constants::STATUS_SUCCESS, "Successfully updated");
        } else {
            new PrintJson(Constants::STATUS_FAILED, "Failed to update");
        }
    }

} else {
//    echo "Empty or null values received";
    new PrintJson(Constants::STATUS_FAILED, "Empty or null values received");
}