<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 9/6/18
 * Time: 11:10 PM
 */

class ProductCondition
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getProductCondition($companyId)
    {
        $sql = "SELECT * FROM `product_condition` WHERE company_id = '" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insertProductCondition($product_condition_name, $company_id)
    {
        $productConditionName = $this->connection->real_escape_string($product_condition_name);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "SELECT * FROM `product_condition` WHERE  product_condition_name ='" . $productConditionName . "' AND company_id ='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows == 0) {
            $insert_sql = "INSERT INTO `product_condition`(`product_condition_name`, `company_id`) VALUES ('" . $productConditionName . "','" . $companyId . "'))";
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

    public function updateProductCondition($product_condition_id, $product_condition_name, $company_id)
    {
        $productConditionId = $this->connection->real_escape_string($product_condition_id);
        $productConditionName = $this->connection->real_escape_string($product_condition_name);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "UPDATE `product_condition` SET `product_condition_name`='" . $productConditionName . "' WHERE `product_condition_id`='" . $productConditionId . "' AND `company_id`='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result === true) {
            return true;
        } elseif ($result === false) {
            return false;
        } else {
            return Constants::STATUS_EXISTS;
        }
    }

    public function deleteProductCondition($product_condition_id, $company_id)
    {
        $productConditionId = $this->connection->real_escape_string($product_condition_id);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "DELETE FROM `product_condition` WHERE product_condition_id = '" . $productConditionId . "' AND company_id = '" . $companyId . "'";
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