<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 9/6/18
 * Time: 11:08 PM
 */

class ProductBoxType
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getProductBoxType($companyId)
    {
        $sql = "SELECT * FROM `product_box_type` WHERE company_id = '" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insertProductBoxType($product_box_type_name, $company_id)
    {
        $productBoxTypeName = $this->connection->real_escape_string($product_box_type_name);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "SELECT * FROM `product_box_type` WHERE  product_box_type_name ='" . $productBoxTypeName . "' AND company_id ='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows == 0) {
            $insert_sql = "INSERT INTO `product_box_type`(`product_box_type_name`, `company_id`) VALUES ('" . $productBoxTypeName . "','" . $companyId . "'))";
            $insert = $this->connection->query($insert_sql);
            if ($insert === true) {
                return true;
            } else {
                return false;
            }
        } else {
            $message = Constants::STATUS_EXISTS;
            return $message;
        }
    }

    public function updateProductBoxType($product_box_type_id, $product_box_type_name, $company_id)
    {
        $productBoxTypeId = $this->connection->real_escape_string($product_box_type_id);
        $productBoxTypeName = $this->connection->real_escape_string($product_box_type_name);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "UPDATE `product_box_type` SET `product_box_type_name`='" . $productBoxTypeName . "' WHERE `product_box_type_type_id`='" . $productBoxTypeId . "' AND `company_id`='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result === true) {
            return true;
        } elseif ($result === false) {
            return false;
        } else {
            return Constants::STATUS_EXISTS;
        }
    }

    public function deleteProductBoxType($product_box_type_id, $company_id)
    {
        $productBoxTypeId = $this->connection->real_escape_string($product_box_type_id);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "DELETE FROM `product_box_type` WHERE product_box_type_id = '" . $productBoxTypeId . "' AND company_id = '" . $companyId . "'";
        $result = $this->connection->query($sql);


        if ($result === true) {
            return true;
        } elseif ($result === false) {
            return false;
        } else {
            return Constants::STATUS_EXISTS;
        }
    }
}