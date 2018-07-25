<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 16/6/18
 * Time: 10:18 AM
 */

require_once("../../../../classes/DBConnect.php");
require_once("../../../../classes/Constants.php");
require_once("../../../../classes/PrintJson.php");
require_once("../classes/ProductBrand.php");
//require_once("../classes/ProductCategory.php");
include("../../sessions/session.php");

header("Content-Type: application/json");


$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);

if (isset($_REQUEST['categoryId']) && !empty(trim($_REQUEST['categoryId']))) {
    $brandName = new ProductBrand($dbConnect->getInstance());
    $getBrandName = $brandName->getProductBrand($_REQUEST['categoryId'], $_SESSION['companyId']);
//    $getBrandName = $brandName->getProductBrand($_REQUEST['categoryId'], 1);

    $data = array();
    $productBrand = array();

    if ($getBrandName != false) {
        while ($array = $getBrandName->fetch_assoc()) {
            $productBrand[] = ["id" => $array['product_brand_id'], "name" => $array['product_brand_name']];
        }
        $data["product_brand"] = $productBrand;
        new PrintJson(Constants::STATUS_SUCCESS, $data);
    } else {
        new PrintJson(Constants::STATUS_FAILED, "No data found");
    }

} else {
    new PrintJson(Constants::STATUS_FAILED, "Empty or null parameters");
}