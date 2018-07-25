<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 18/6/18
 * Time: 6:49 PM
 */

require_once("../../../classes/DBConnect.php");
require_once("../../../classes/Constants.php");
require_once("../../../classes/PrintJson.php");
require_once("../classes/ProductBoxType.php");
require_once("../classes/ProductBrand.php");
require_once("../classes/ProductBrandWarranty.php");
require_once("../classes/ProductCategory.php");
require_once("../classes/ProductCondition.php");
require_once("../classes/ProductsDetails.php");
include("../../sessions/session.php");

$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);

if (isset($_REQUEST['productDetailsId']) && !empty(trim($_REQUEST['productDetailsId']))) {
$productDetails = new ProductsDetails($dbConnect->getInstance());
$getProductDetails = $productDetails->getProductDetails(0, 0, $_REQUEST['productDetailsId'], $_SESSION['companyId']);
//$getProductDetails = $productDetails->getProductDetails(0, 0, $_REQUEST['productDetailsId'], 1);

$boxType = new ProductBoxType($dbConnect->getInstance());
$getBoxType = $boxType->getProductBoxType($_SESSION['companyId']);
//$getBoxType = $boxType->getProductBoxType(1);

$brandWarranty = new ProductBrandWarranty($dbConnect->getInstance());
$getBrandWarranty = $brandWarranty->getProductBrandWarranty($_SESSION['companyId']);
//$getBrandWarranty = $brandWarranty->getProductBrandWarranty(1);

$condition = new ProductCondition($dbConnect->getInstance());
$getCondition = $condition->getProductCondition($_SESSION['companyId']);
//$getCondition = $condition->getProductCondition(1);
if ($getProductDetails != false) {
?>
<html>
<head>
    <title>Update Product | Product Catalog</title>
    <script type="text/javascript" src="../../../Resources/jquery-3.2.1.js"></script>
</head>
<body>
<form>
    <table id="updateProductDetails" border="4">
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
        $i = 1;

        while ($array = $getProductDetails->fetch_assoc()) {
            echo "<b>Category:</b> " . $array['product_category_name'] . "<br><br>";
            echo "<b>Brand:</b> " . $array['product_brand_name'] . "<br><br>";

            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<input type='hidden' id='productDetailsId' value='" . $_REQUEST['productDetailsId'] . "'>";
            echo "<td><input type='text' id='productModelName' value='" . $array['product_details_model_name'] . "'></td>";
            echo "<td><input type='text' id='productModelColor' value='" . $array['product_details_model_color'] . "'></td>";

//            echo "<td>" . $array['product_condition_name'] . "</td>";
//            echo "<td>" . $array['product_box_type_name'] . "</td>";
//            echo "<td>" . $array['product_brand_warranty_name'] . "</td>";

            echo "<td>
                <select class='productCondition' id='productCondition' name='productCondition" . $i . "'>
                    <option value='-2' selected disabled>Select Condition</option>";
            if ($getCondition == true) {
                while ($row0 = $getCondition->fetch_assoc()) {
                    if ($array['product_condition_name'] == $row0['product_condition_name']) {
                        echo "<option value = '" . $row0['product_condition_id'] . "' selected>" . $row0['product_condition_name'] . "</option>";

                    } else {
                        echo "<option value = '" . $row0['product_condition_id'] . "'>" . $row0['product_condition_name'] . "</option>";
                    }
                }
            } else {
                echo Constants::STATUS_FAILED . " to fetch condition";
            }
            echo "</select></td>";

            echo "<td>
                <select class='productBoxType' id='productBoxType' name='productBoxType" . $i . "'>
                    <option value='-3' selected disabled>Select Box Type</option>";
            if ($getBoxType == true) {
                while ($row1 = $getBoxType->fetch_assoc()) {
                    if ($array['product_box_type_name'] == $row1['product_box_type_name']) {
                        echo "<option value = '" . $row1['product_box_type_id'] . "' selected>" . $row1['product_box_type_name'] . "</option>";
                    } else {
                        echo "<option value = '" . $row1['product_box_type_id'] . "'>" . $row1['product_box_type_name'] . "</option>";
                    }
                }
            } else {
                echo Constants::STATUS_FAILED . " to fetch box type";
            }
            echo "</select></td>";

            echo "<td>
                <select class='productBrandWarranty' id='productBrandWarranty' name='productBrandWarranty" . $i . "'>
                    <option value='-4' selected disabled>Select Brand Warranty</option>";
            if ($getBrandWarranty == true) {
                while ($row2 = $getBrandWarranty->fetch_assoc()) {
                    if ($array['product_brand_warranty_type'] == $row2['product_brand_warranty_type']) {
                        echo "<option value = '" . $row2['product_brand_warranty_id'] . "' selected>" . $row2['product_brand_warranty_type'] . "</option>";
                    } else {
                        echo "<option value = '" . $row2['product_brand_warranty_id'] . "'>" . $row2['product_brand_warranty_type'] . "</option>";
                    }
                }
            } else {
                echo Constants::STATUS_FAILED . " to fetch brand warranty";
            }
            echo "</select></td>";

            echo "<td><input type='text' id='productWarrantyExpiry' value='" . $array['product_details_warranty_expiry'] . "'></td>";
            echo "<td><textarea id='productComment'>" . $array['product_details_model_comments'] . "</textarea></td>";
            echo "<td><input type='number' id='productQuantity' value='" . $array['product_details_model_quantity'] . "'></td>";
            echo "<td><input type='number' id='productMFGPrice' value='" . $array['product_details_mfg_price'] . "'></td>";
            echo "<td><input type='number' id='productCompanyPrice' value='" . $array['product_details_company_price'] . "'></td>";
            echo "</tr>";
            $i++;
        }
        } else {
            echo "Unable to fetch product details";
        }
        } else {
            echo "Empty or null values received";
        }
        ?>
    </table>
    <button type='submit' id='updateProduct'>Update Details</button>
</form>

<script type="text/javascript">
    $(document).ready(function () {
        $("#updateProduct").on("click", function (e) {
            e.preventDefault();

            var updateProductDetails = [];
            var productDetailsId, productModelName, productModelColor, productCondition, productBoxType,
                productBrandWarranty, productWarrantyExpiry, productComment, productQuantity, productMFGPrice,
                productCompanyPrice;

            productDetailsId = $("#productDetailsId").val();
            productModelName = $("#productModelName").val();
            productModelColor = $("#productModelColor").val();
            productCondition = $("#productCondition").find("option:selected").val();
            productBoxType = $("#productBoxType").find("option:selected").val();
            productBrandWarranty = $("#productBrandWarranty").find("option:selected").val();
            productWarrantyExpiry = $("#productWarrantyExpiry").val();
            productComment = $("#productComment").val();
            productQuantity = $("#productQuantity").val();
            productMFGPrice = $("#productMFGPrice").val();
            productCompanyPrice = $("#productCompanyPrice").val();

            updateProductDetails.push([productDetailsId, productModelName, productModelColor,
                productCondition, productBoxType, productBrandWarranty, productWarrantyExpiry,
                productComment, productQuantity, productMFGPrice, productCompanyPrice]);

            if (productDetailsId === "" || productModelName === "" || productModelColor === "" ||
                productCondition === "" || productBoxType === "" || productBrandWarranty === "" || productWarrantyExpiry === "" ||
                productComment === "" || productQuantity === "" || productMFGPrice === "" || productCompanyPrice === "") {
                alert("Enter all values");
                updateProductDetails = [];
            } else {
                $.ajax({
                    url: "update_pd.php",
                    type: "POST",
                    data: {
                        updateProductDetails: updateProductDetails
                    },
                    dataType: "json",
                    success:
                        function (json) {
                            if (json.status === "success") {
                                alert(json.message);
                                window.location.href = "updateProductDetails.php";
                            } else if (json.status === "already_exists") {
                                alert(json.message);
                                updateProductDetails = [];

//                                    console.log(arrayAddToDB);
                            } else if (json.status === "failed") {
                                alert(json.message);
                                updateProductDetails = [];

//                                    console.log(arrayAddToDB);
                            } else {
                                alert("Undefined error. Please contact developer");
                            }
                        }
                });
            }

        });
    });

</script>

</body>
</html>