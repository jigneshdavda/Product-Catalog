<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 10/11/17
 * Time: 7:53 PM
 */

require_once("../../../classes/DBConnect.php");
require_once("../../../classes/Constants.php");
require_once("../../../classes/PrintJson.php");
require_once("../classes/Login.php");
require_once("../classes/Register.php");

$dbConnect = new DBConnect(Constants::SERVER_NAME,
    Constants::DB_USERNAME,
    Constants::DB_PASSWORD,
    Constants::DB_NAME);

if (isset($_REQUEST['phoneNumber']) && !empty(trim($_REQUEST['phoneNumber']))
    && isset($_REQUEST['password']) && !empty(trim($_REQUEST['password']))) {

    $login = new Login($dbConnect->getInstance());

    $phone = $_REQUEST['phoneNumber'];
    $passwd = $_REQUEST['password'];

    $checkLogin = $login->checkLogin($phone, $passwd);

    if ($checkLogin == true) {
        $companyId = 0;
        $register = new Register($dbConnect->getInstance());
        $companyId = $register->getCompanyDetails($phone, 0);
        if ($companyId > 0 && $companyId != null) {
            $login->createSession($companyId, $phone);
//            echo "<script>window.location.replace('dashboard.php');</script>";
            new PrintJson(Constants::STATUS_SUCCESS, "Successful Login");
        } else {
            new PrintJson(Constants::STATUS_FAILED, "Company not found");
        }
    } else {
//        echo Constants::STATUS_FAILED . " login";
        new PrintJson(Constants::STATUS_FAILED, "Invalid Login credentials");
    }
} else {
    new PrintJson(Constants::STATUS_FAILED, "Empty or null values received");
}