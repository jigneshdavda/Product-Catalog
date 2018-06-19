<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 12/6/18
 * Time: 11:06 PM
 */

require_once("../../../classes/DBConnect.php");
require_once("../../../classes/Constants.php");
require_once("../../../classes/PrintJson.php");
require_once("../classes/ProductBrand.php");
require_once("../classes/ProductCategory.php");
require_once("../classes/ProductsDetails.php");

$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);

session_start();

//if (isset($_SESSION['phoneNumber'])) {

$productCategory = new ProductCategory($dbConnect->getInstance());
$productBrand = new ProductBrand($dbConnect->getInstance());
$productDetails = new ProductsDetails($dbConnect->getInstance());

//Get categories
$getProductCategory = $productCategory->getProductCategory(0);
if ($getProductCategory != false) {
while ($rowCategory = $getProductCategory->fetch_assoc()) {
$productCategoryId = $rowCategory['product_category_id'];
echo "<b>" . $rowCategory['product_category_name'] . "</b><br>";

//Get brand with its respective categories
$getProductBrand = $productBrand->getProductBrand($productCategoryId, 0);
if ($getProductBrand != false) {
$i = 1;
while ($rowBrand = $getProductBrand->fetch_assoc()) {
$productBrandId = $rowBrand['product_brand_id'];
echo "<br><b>-></b>" . $rowBrand['product_brand_name'] . "<br>";

//Get products with its respective brand and categories
$getProductDetails = $productDetails->getProductDetails($productCategoryId, $productBrandId, 0, 0);
if ($getProductDetails != false) {
?>

<html>
<head>
    <title>Products | Product Catalog</title>
</head>
<body>
<table id="mainTable" border="4">
    <tr>
        <th>Sr No.</th>
        <th>Model and Storage</th>
        <th>Model Color</th>
        <th>Condition</th>
        <th>Box</th>
        <th>Brand Warranty</th>
        <th>Warranty Expiry</th>
        <th>Comments/Additional Details</th>
        <th>Quantity</th>
        <th>MFG. Price</th>
        <th>Company Price</th>
    </tr>

    <?php
    $numRows = $getProductDetails->num_rows;
    $j = 0;
    while ($rowProduct = $getProductDetails->fetch_assoc()) {
        $productDetailsId = $rowProduct['product_details_id'];

        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . $rowProduct['product_details_model_name'] . "</td>";
        echo "<td>" . $rowProduct['product_details_model_color'] . "</td>";
        echo "<td>" . $rowProduct['product_condition_name'] . "</td>";
        echo "<td>" . $rowProduct['product_box_type_name'] . "</td>";
        echo "<td>" . $rowProduct['product_brand_warranty_name'] . "</td>";
        echo "<td>" . $rowProduct['product_details_warranty_expiry'] . "</td>";
        echo "<td>" . $rowProduct['product_details_model_comments'] . "</td>";
        echo "<td>" . $rowProduct['product_details_model_quantity'] . "</td>";
        echo "<td>" . $rowProduct['product_details_mfg_price'] . "</td>";
        echo "<td>" . $rowProduct['product_details_company_price'] . "</td>";
        echo "</tr>";

        if ($j == ($numRows - 1)) {
            $i = 1;
        } else {
            $i++;
        }

        $j++;
    }
    echo "</table>";
    echo "<br>";
    } else {
        echo "No Product";
    }
    }
    echo "<br>";
    } else {
        echo "No Brand under this category";
    }
    }
    } else {
        echo "No category found";
    }

    //} else {
    //    new PrintJson(Constants::STATUS_FAILED, "Session expired. Please login first");
    //}
    ?>
</body>
</html>
