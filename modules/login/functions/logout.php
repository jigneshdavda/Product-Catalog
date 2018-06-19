<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 10/11/17
 * Time: 8:52 PM
 */
session_start();
unset($_SESSION['companyId']);
unset($_SESSION['phone']);
session_destroy();
header('Location:login.php');