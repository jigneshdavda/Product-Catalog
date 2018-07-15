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
<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="../../../Resources/jquery-3.2.1.js"></script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add Product Details | Product Catalog</title>
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../Resources/AdminLTE-2.4.2/dist/css/skins/_all-skins.min.css">
    <!-- DataTables -->
    <link rel="stylesheet"
          href="../../../Resources/AdminLTE-2.4.2/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

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
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>P</b>C</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Product </b>CATALOG</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="../../../Resources/AdminLTE-2.4.2/dist/img/user2-160x160.jpg"
                                 class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs">Alexander Pierce</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="../../../Resources/AdminLTE-2.4.2/dist/img/user2-160x160.jpg"
                                     class="img-circle" alt="User Image">

                                <p>
                                    Product Ca
                                    <small>Member since Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="../../login/functions/logout.php" type="button"
                                       class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="../../../Resources/AdminLTE-2.4.2/dist/img/user2-160x160.jpg" class="img-circle"
                         alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Alexander Pierce</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <li>
                    <a href="../../login/functions/dashboard.php">
                        <i class="fa fa-home"></i> <span>Home</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <li>
                    <a href="addProductDetails.php">
                        <i class="fa fa-trash"></i> <span>Add Product Details</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <li>
                    <a href="updateProductDetails.php">
                        <i class="fa fa-pencil"></i> <span>Update Product Details</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <li>
                    <a href="deleteProductDetails.php">
                        <i class="fa fa-pencil"></i> <span>Delete Product Details</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-gears"></i> <span>Settings</span>
                        <span class="pull-right-container"></span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Edit Product Detail</h1>
            <ol class="breadcrumb">
                <li><a href="../../login/functions/dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="updateProductDetails.php"><i class="fa fa-pencil"></i> Update Product Details</a></li>
                <li class="active"><i class="fa fa-pencil"></i> Edit Product Detail</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">


                            <form>
                                <div class="table-container1">
                                    <table class="table table-bordered table-stripped" id="updateProductDetails"
                                           border="4">
                                        <thead>
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
                                        </thead>

                                        <?php
                                        $i = 1;

                                        while ($array = $getProductDetails->fetch_assoc()) {
                                            echo "<h4>Category :</h4><label>" . $array['product_category_name'] . "</label>";
                                            echo "<h4>Brand :</h4><label>" . $array['product_brand_name'] . "</label>";

                                            echo "<tr>";
                                            echo "<td>" . $i . "</td>";
                                            echo "<input type='hidden' id='productDetailsId' value='" . $_REQUEST['productDetailsId'] . "'>";
                                            echo "<td><input class='form-control' style='width: auto' type='text' id='productModelName' value='" . $array['product_details_model_name'] . "'></td>";
                                            echo "<td><input class='form-control' style='width: auto' type='text' id='productModelColor' value='" . $array['product_details_model_color'] . "'></td>";

//            echo "<td>" . $array['product_condition_name'] . "</td>";
//            echo "<td>" . $array['product_box_type_name'] . "</td>";
//            echo "<td>" . $array['product_brand_warranty_name'] . "</td>";

                                            echo "<td>
                <select class='form-control select2' style='width: auto' class='productCondition' id='productCondition' name='productCondition" . $i . "'>
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
                <select class='productBoxType form-control select2' style='width: auto' id='productBoxType' name='productBoxType" . $i . "'>
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
                <select class='productBrandWarranty form-control select2' style='width: auto' id='productBrandWarranty' name='productBrandWarranty" . $i . "'>
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

                                            echo "<td><input class='form-control' style='width: auto;' type='text' id='productWarrantyExpiry' value='" . $array['product_details_warranty_expiry'] . "'></td>";
                                            echo "<td><textarea class='form-control' style='width: auto;' id='productComment'>" . $array['product_details_model_comments'] . "</textarea></td>";
                                            echo "<td><input class='form-control' style='width: auto;' type='number' id='productQuantity' value='" . $array['product_details_model_quantity'] . "'></td>";
                                            echo "<td><input class='form-control' style='width: auto;' type='number' id='productMFGPrice' value='" . $array['product_details_mfg_price'] . "'></td>";
                                            echo "<td><input class='form-control' style='width: auto;' type='number' id='productCompanyPrice' value='" . $array['product_details_company_price'] . "'></td>";
                                            echo "</tr>";
                                            $i++;
                                        }
                                        } else {
                                            echo "<label>Unable to fetch product details</label>";
                                        }
                                        } else {
                                            echo "<label>Empty or null values received</label>";
                                        }
                                        ?>
                                    </table>
                                </div>
                                <button class='btn btn-flat btn-success' type='submit' id='updateProduct'><i
                                            class="fa fa-save"></i> Save Details
                                </button>
                            </form>

                            <script type="text/javascript">
                                $(document).ready(function () {
                                    $("#updateProduct").on("click", function (e) {
                                        e.preventDefault();

                                        var updateProductDetails = [];
                                        var productDetailsId, productModelName, productModelColor, productCondition,
                                            productBoxType,
                                            productBrandWarranty, productWarrantyExpiry, productComment,
                                            productQuantity,
                                            productMFGPrice,
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../../Resources/AdminLTE-2.4.2/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../../Resources/AdminLTE-2.4.2/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="../../../Resources/AdminLTE-2.4.2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../../Resources/AdminLTE-2.4.2/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../../Resources/AdminLTE-2.4.2/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../../Resources/AdminLTE-2.4.2/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="../../../Resources/AdminLTE-2.4.2/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../Resources/AdminLTE-2.4.2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

</body>
</html>
