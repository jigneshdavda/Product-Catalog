<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 18/6/18
 * Time: 12:53 PM
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

if (isset($_REQUEST['companyDetailsArray'])) {
//    isset($_REQUEST['company_name']) && isset($_REQUEST['company_email_id'])
//    && isset($_REQUEST['company_phone_number']) && isset($_REQUEST['company_address_line_1'])
//    && isset($_REQUEST['company_address_line_2']) && isset($_REQUEST['company_country'])
//    && isset($_REQUEST['company_password']) && isset($_REQUEST['company_retype_password']) && !empty(trim())

    $registerCompany = new Register($dbConnect->getInstance());

    foreach ($_REQUEST['companyDetailsArray'] as $companyDetails) {
        if ($companyDetails[6] == $companyDetails[7]) {
            $insertCompanyDetails = $registerCompany->insertCompanyDetails($companyDetails[0],
                $companyDetails[1], $companyDetails[2], $companyDetails[3], $companyDetails[4],
                $companyDetails[5], $companyDetails[6]);

//            echo $insertCompanyDetails;
            if ($insertCompanyDetails === true) {
                //echo "Successfully Registered";
                new PrintJson(Constants::STATUS_SUCCESS, "Successfully Registered");
            } elseif ($insertCompanyDetails == Constants::STATUS_EXISTS) {
                new PrintJson(Constants::STATUS_FAILED, Constants::STATUS_EXISTS);
            } else {
                //echo "Not registered";
                new PrintJson(Constants::STATUS_FAILED, "Not registered");
            }
        } else {
//            echo "Password didn't match";
            new PrintJson(Constants::STATUS_FAILED, "Password didn't match");
        }
    }
} else {
//    echo "Empty or null data received";
    new PrintJson(Constants::STATUS_FAILED, "Empty or null data received");
}