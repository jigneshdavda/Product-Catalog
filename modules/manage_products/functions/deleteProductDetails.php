<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 18/6/18
 * Time: 6:35 PM
 */

require_once("../../../classes/DBConnect.php");
require_once("../../../classes/Constants.php");
require_once("../../../classes/PrintJson.php");
require_once("../classes/ProductBrand.php");
require_once("../classes/ProductCategory.php");
require_once("../classes/ProductsDetails.php");
include("../../sessions/session.php");

$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);
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
            <h1>Delete Product Details</h1>
            <ol class="breadcrumb">
                <li><a href="../../login/functions/dashboard.php"><i class="fa fa-home"></i> Home</a></li>
                <li class="active"><i class="fa fa-trash"></i> Delete Product Details</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">


            <?php

            $productCategory = new ProductCategory($dbConnect->getInstance());
            $productBrand = new ProductBrand($dbConnect->getInstance());
            $productDetails = new ProductsDetails($dbConnect->getInstance());

            //Get categories
            $getProductCategory = $productCategory->getProductCategory($_SESSION['companyId']);
            //$getProductCategory = $productCategory->getProductCategory(1);
            if ($getProductCategory != false) {
            while ($rowCategory = $getProductCategory->fetch_assoc()) {


            echo '<div class="row">
                <div class="col-xs-12">
                    <div class="box box-default collapsed-box">';


            $productCategoryId = $rowCategory['product_category_id'];
            echo "<div class=\"box-header with-border\">
<div class=\"box-tools pull-right\">
                <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-plus\"></i>
                </button>
              </div>
                            <h2 class=\"box-title\">" . $rowCategory['product_category_name'] . "</h2></div>
                            
            <div class=\"box-body\">";

            //Get brand with its respective categories
            $getProductBrand = $productBrand->getProductBrand($productCategoryId, $_SESSION['companyId']);
            //$getProductBrand = $productBrand->getProductBrand($productCategoryId, 1);
            if ($getProductBrand != false) {
            $i = 1;
            while ($rowBrand = $getProductBrand->fetch_assoc()) {
            $productBrandId = $rowBrand['product_brand_id'];
            echo "<div class='fa-border with-border border' style=' padding: 10px; border-width: thick'><h4>" . $rowBrand['product_brand_name'] . "</h4>";

            //Get products with its respective brand and categories
            $getProductDetails = $productDetails->getProductDetails($productCategoryId, $productBrandId, 0, $_SESSION['companyId']);
            //$getProductDetails = $productDetails->getProductDetails($productCategoryId, $productBrandId, 0, 1);
            if ($getProductDetails != false) {
            ?>


            <div class="table-container1">
                <table class="table table-bordered table-stripped" id="deleteProductDetails" border="4">
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
                        echo "<input type='hidden' id='productDetailsId' value='" . $productDetailsId . "'>";
                        echo "<td><button class='btn btn-flat btn-danger' type='submit' class='deleteProduct'><i class='fa fa-trash'></i> Delete Product</button></td>";
                        echo "</tr>";

                        if ($j == ($numRows - 1)) {
                            $i = 1;
                        } else {
                            $i++;
                        }

                        $j++;
                    }
                    echo "</table></div></div><br>";
                    } else {
                        echo "<label>No Products Available</label></div><br>";
                    }
                    }
                    } else {
                        echo "<label>No Brand under this category</label>";
                    }

                    echo '</div>
    </div>
</div>
</div>';


                    }
                    } else {
                        echo "<label>No Category Available</label>";
                    }

                    ?>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $(".deleteProduct").on("click", function (e) {
                                e.preventDefault();
                                var deleteProductId = $(this).closest("tr").find("#productDetailsId").val();

//                console.log(deleteProductId);

                                if (deleteProductId > 0) {

                                    if (confirm("Are you sure?")) {
                                        $.ajax({
                                            url: "delete_pd.php",
                                            type: "POST",
                                            data: {
                                                deleteProductDetailsId: deleteProductId
                                            },
                                            dataType: "json",
                                            success: function (json) {
                                                if (json.status === "success") {
                                                    alert(json.message);
                                                    window.location.reload(true);
                                                } else {
                                                    alert(json.message);
                                                }
                                            }
                                        });
                                    } else {
                                        return false;
                                    }
                                } else {
                                    alert("Invalid product id");
                                }
                            });
                        });
                    </script>


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
