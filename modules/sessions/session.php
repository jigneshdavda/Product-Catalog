<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 19/6/18
 * Time: 5:27 PM
 */

session_start();

if (!isset($_SESSION['phone']) || !isset($_SESSION['companyId'])
    || empty(trim($_SESSION['phone'])) || empty(trim($_SESSION['companyId']))) {
    echo "<script>alert('Please login first!');window.location.replace('../../login/functions/login.php');</script>";
} else {
    $companyId = $_SESSION['companyId'];
    $phoneNumber = $_SESSION['phone'];
}