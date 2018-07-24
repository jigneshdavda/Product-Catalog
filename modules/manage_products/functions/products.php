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

//session_start();

//if (isset($_SESSION['phoneNumber'])) {

$productCategory = new ProductCategory($dbConnect->getInstance());
$productBrand = new ProductBrand($dbConnect->getInstance());
$productDetails = new ProductsDetails($dbConnect->getInstance());

//Get categories
$getProductCategory = $productCategory->getProductCategory(0);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="../../../Resources/landing_page/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../../Resources/landing_page/assets/img/favicon.png">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Product Catalog | Products</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>

    <link href="../../../Resources/landing_page/bootstrap3/css/bootstrap.css" rel="stylesheet"/>
    <link href="../../../Resources/landing_page/assets/css/gsdk.css" rel="stylesheet"/>
    <link href="../../../Resources/landing_page/assets/css/demo.css" rel="stylesheet"/>

    <!--     Font Awesome     -->
    <link href="../../../Resources/landing_page/bootstrap3/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
</head>
<body>
<div id="navbar-full">
    <div class="container">
        <nav class="navbar navbar-ct-blue navbar-transparent navbar-fixed-top" role="navigation">

            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="http://creative-tim.com">
                        <div class="logo-container">
                            <div class="logo">
                                <img src="../../../Resources/landing_page/book-open-solid.svg">
                            </div>
                            <div class="brand">
                                Product Catalog
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="btn btn-round btn-default">Login</a></li>
                    </ul>

                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div><!--  end container-->

    <div class='blurred-container'>
        <div class="motto">
            <div>PRODUCT Catalog</div>
        </div>
        <div class="img-src"
             style="background-image: url('../../../Resources/landing_page/assets/img/cover_4.jpg')"></div>
        <div class='img-src blur'
             style="background-image: url('../../../Resources/landing_page/assets/img/cover_4_blur.jpg')"></div>
    </div>

</div>


<div class="main">


    <div class="container tim-container">
        <div class="tim-title">
            <h3>Products</h3>
        </div>
        <div class="">


<!--            <div id="acordeon">-->
<!--                <div class="panel-group" id="accordion">-->
<!--                    <div class="panel panel-default">-->
<!--                        <div class="alert alert-info">-->
<!--                            <h4 class="panel-title">-->
<!--                                <a data-target="#collapseOne" href="#collapseOne" data-toggle="gsdk-collapse">-->
<!--                                    GSDK Collapsible Item 1-->
<!--                                </a>-->
<!--                            </h4>-->
<!--                        </div>-->
<!--                        <div id="collapseOne" class="panel-collapse collapse">-->
<!--                            <div class="panel-body">-->
<!--                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad-->
<!--                                squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck-->
<!--                                quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it-->
<!--                                squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica,-->
<!--                                craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur-->
<!--                                butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth-->
<!--                                nesciunt you probably haven't heard of them accusamus labore sustainable VHS.-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->


            <?php
            if ($getProductCategory != false) {
            while ($rowCategory = $getProductCategory->fetch_assoc()) {

            echo '<div class="row">
                <div class="col-xs-12">
                    <div class="box box-default collapsed-box">';

            $productCategoryId = $rowCategory['product_category_id'];


            echo "<div class=\"box-header with-border\">
                            <h1 class=\"box-title alert alert-info\">" . $rowCategory['product_category_name'] . "</h1></div>
            <div class=\"box-body\">";



//            echo "<div class=\"box-header with-border\">
//<div class=\"box-tools pull-right\">
//                <button type=\"button\" class=\"btn btn-box-tool\" data-widget=\"collapse\"><i class=\"fa fa-minus\"></i>
//                </button>
//              </div>
//                            <h3 class=\"box-title\">" . $rowCategory['product_category_name'] . "</h3></div>
//
//            <div class=\"box-body\">";

            //Get brand with its respective categories
            $getProductBrand = $productBrand->getProductBrand($productCategoryId, 0);
            if ($getProductBrand != false) {
            $i = 1;
            while ($rowBrand = $getProductBrand->fetch_assoc()) {
            $productBrandId = $rowBrand['product_brand_id'];
            echo "<div class='fa-border with-border border' style=' padding: 10px; border-width: thick'><h4>" . $rowBrand['product_brand_name'] . "</h4>";

            //Get products with its respective brand and categories
            $getProductDetails = $productDetails->getProductDetails($productCategoryId, $productBrandId, 0, 0);
            if ($getProductDetails != false) {
            ?>

            <div class="table-container1">
                <table class="table table-bordered" id="mainTable">
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
                    echo "</table></div></div><br>";
                    //                    echo "<br>";
                    } else {
                        echo "<h5>No Products Available</h5></div><br>";
                    }
                    }
                    echo "</div>";
                    } else {
                        echo "<h5>No Brand under this category</h5>";
                    }
                    echo '</div>
    </div>
</div>';


                    }
                    } else {
                        echo "<h5>No Category Available</h5>";
                    }

                    //} else {
                    //    new PrintJson(Constants::STATUS_FAILED, "Session expired. Please login first");
                    //}
                    ?>
            </div>
        </div>
    </div>
    <div class="space"></div>
</div>


    <!-- end main -->


    <div class="parallax-pro">
        <div class="img-src"
             style="background-image: url('http://get-shit-done-pro.herokuapp.com/assets/img/bg6.jpg');"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-md-12 text-center">
                    <h1 class="hello text-center">
                        <a href="http://gsdk.creative-tim.com">Product Catalog</a>
                        <small>
                            <ul class="list-unstyled">
                                <li><span class="fa fa-phone"></span>&nbsp;&nbsp;+91-9619337636</li>
                                <li><span class="fa fa-globe"></span>&nbsp;&nbsp;www.productcatalog.com</li>
                                <li><span class="fa fa-envelope"></span>&nbsp;&nbsp;productcatalog@gmail.com</li>
                                <li>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <h2><span class="fa fa-instagram"></span></h2>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <h2><span class="fa fa-facebook-square"></span></h2>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <h2><span class="fa fa-twitter-square"></span></h2>
                                        </div>
                                        <div class="col-md-3 col-sm-3 col-xs-3">
                                            <h2><span class="fa fa-linkedin-square"></span></h2>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </small>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="credits">
                        Copyrights&nbsp;@&nbsp;All rights reserved&nbsp;|&nbsp;<a href="#"><h5>Product Catalog</h5></a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

<script src="../../../Resources/landing_page/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="../../../Resources/landing_page/assets/js/jquery-ui-1.10.4.custom.min.js" type="text/javascript"></script>

<script src="../../../Resources/landing_page/bootstrap3/js/bootstrap.js" type="text/javascript"></script>
<script src="../../../Resources/landing_page/assets/js/gsdk-bootstrapswitch.js"></script>
<script src="../../../Resources/landing_page/assets/js/get-shit-done.js"></script>
<script src="../../../Resources/landing_page/assets/js/custom.js"></script>
<!-- DataTables -->
<script src="../../../Resources/AdminLTE-2.4.2/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../../Resources/AdminLTE-2.4.2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../../../Resources/AdminLTE-2.4.2/dist/js/adminlte.min.js"></script>


</html>