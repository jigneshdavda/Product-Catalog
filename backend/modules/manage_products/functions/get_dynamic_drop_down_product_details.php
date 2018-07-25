<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 12/6/18
 * Time: 12:22 PM
 */

require_once("../../../../classes/DBConnect.php");
require_once("../../../../classes/Constants.php");
require_once("../../../../classes/PrintJson.php");
require_once("../classes/ProductBoxType.php");
//require_once("../classes/ProductBrand.php");
require_once("../classes/ProductBrandWarranty.php");
require_once("../classes/ProductCategory.php");
require_once("../classes/ProductCondition.php");
require_once("../classes/ProductsDetails.php");
include("../../sessions/session.php");

header("Content-Type: application/json");

$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);

$boxType = new ProductBoxType($dbConnect->getInstance());
$getBoxType = $boxType->getProductBoxType($_SESSION['companyId']);
//$getBoxType = $boxType->getProductBoxType(1);

//$brand = new ProductBrand($dbConnect->getInstance());
//$getBrand = $brand->getProductBrand();

$brandWarranty = new ProductBrandWarranty($dbConnect->getInstance());
$getBrandWarranty = $brandWarranty->getProductBrandWarranty($_SESSION['companyId']);
//$getBrandWarranty = $brandWarranty->getProductBrandWarranty(1);

$category = new ProductCategory($dbConnect->getInstance());
$getCategory = $category->getProductCategory($_SESSION['companyId']);
//$getCategory = $category->getProductCategory(1);

$condition = new ProductCondition($dbConnect->getInstance());
$getCondition = $condition->getProductCondition($_SESSION['companyId']);
//$getCondition = $condition->getProductCondition(1);

//$details = new ProductsDetails($dbConnect->getInstance());
//$getProductDetails = $details->getProductDetails(0, 0, 0);

$data = array();
//$productBrand = array();
$productCondition = array();
$productBoxType = array();
$productBrandWarranty = array();
$productCategory = array();

if ($getCategory == true) {
    while ($row = $getCategory->fetch_assoc()) {
        $temp0[] = ["id" => $row['product_category_id'], "name" => $row['product_category_name']];
    }
    $productCategory["product_category"] = $temp0;
    $data[] = $productCategory;

//    if ($getBrand == true) {
//        while ($row1 = $getBrand->fetch_assoc()) {
//            $temp1[] = ["id" => $row1['product_brand_id'], "name" => $row1['product_brand_name']];
//        }
//        $productBrand["product_brand"] = $temp1;
//        $data[] = $productBrand;

    if ($getCondition == true) {
        while ($row2 = $getCondition->fetch_assoc()) {
            $temp2[] = ["id" => $row2['product_condition_id'], "name" => $row2['product_condition_name']];
        }
        $productCondition["product_condition"] = $temp2;
        $data[] = $productCondition;

        if ($getBoxType == true) {
            while ($row3 = $getBoxType->fetch_assoc()) {
                $temp3[] = ["id" => $row3['product_box_type_id'], "name" => $row3['product_box_type_name']];
            }
            $productBoxType["product_box_type"] = $temp3;
            $data[] = $productBoxType;

            if ($getBrandWarranty == true) {
                while ($row4 = $getBrandWarranty->fetch_assoc()) {
                    $temp4[] = ["id" => $row4['product_brand_warranty_id'], "name" => $row4['product_brand_warranty_type']];
                }
                $productBrandWarranty["product_brand_warranty"] = $temp4;
                $data[] = $productBrandWarranty;

                new PrintJson(Constants::STATUS_SUCCESS, $data);

            } else {
                new PrintJson(Constants::STATUS_FAILED, "No brand warranty found");
//                echo Constants::STATUS_FAILED . " to fetch brand warranty";
            }
        } else {
            new PrintJson(Constants::STATUS_FAILED, "No box type found");
//            echo Constants::STATUS_FAILED . " to fetch box type";
        }
    } else {
        new PrintJson(Constants::STATUS_FAILED, "No condition found");
//        echo Constants::STATUS_FAILED . " to fetch condition";
    }
//    } else {
//        new PrintJson(Constants::STATUS_FAILED, "No brand found");
////    echo Constants::STATUS_FAILED . " to fetch brand";
//    }
} else {
    new PrintJson(Constants::STATUS_FAILED, "No category found");
//    echo Constants::STATUS_FAILED . " to fetch category";
}
