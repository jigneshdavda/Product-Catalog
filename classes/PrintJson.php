<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 17/5/18
 * Time: 11:59 AM
 */

class PrintJson
{
    function __construct($status, $message)
    {
        $json = array();
        $json["status"] = $status;
        $json["message"] = $message;

        echo json_encode($json);
    }
}