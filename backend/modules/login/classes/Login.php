<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 9/11/17
 * Time: 11:51 PM
 */

//require_once("../../../classes/Constants.php");

class Login
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function checkLogin($phone, $passwd)
    {
        $sql = "SELECT * FROM `company_details` WHERE company_phone = '" . $phone . "' AND company_password = '" . $passwd . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function createSession($company_id, $phone)
    {
        session_start();
        $_SESSION['companyId'] = $company_id;
        $_SESSION['phone'] = $phone;
    }
}