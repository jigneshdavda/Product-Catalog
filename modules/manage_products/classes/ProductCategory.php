<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 9/6/18
 * Time: 11:09 PM
 */

class ProductCategory
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getProductCategory($companyId)
    {
        if ($companyId > 0) {
            $sql = "SELECT * FROM `product_category` WHERE company_id = '" . $companyId . "'";
        } else {
            $sql = "SELECT * FROM `product_category`";
        }
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insertProductCategory($product_category_name, $company_id)
    {
        $productCategoryName = $this->connection->real_escape_string($product_category_name);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "SELECT * FROM `product_category` WHERE  product_category_name ='" . $productCategoryName . "' AND company_id ='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows == 0) {
            $insert_sql = "INSERT INTO `product_category`(`product_category_name`, `company_id`) VALUES ('" . $productCategoryName . "','" . $companyId . "'))";
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

    public function updateProductCategory($product_category_id, $product_category_name, $company_id)
    {
        $productCategoryId = $this->connection->real_escape_string($product_category_id);
        $productCategoryName = $this->connection->real_escape_string($product_category_name);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "UPDATE `product_category` SET `product_category_name`='" . $productCategoryName . "' WHERE `product_category_id`='" . $productCategoryId . "' AND `company_id`='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result === true) {
            return true;
        } elseif ($result === false) {
            return false;
        } else {
            return Constants::STATUS_EXISTS;
        }
    }

    public function deleteProductCategory($product_category_id, $company_id)
    {
        $productCategoryId = $this->connection->real_escape_string($product_category_id);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "DELETE FROM `product_category` WHERE product_category_id = '" . $productCategoryId . "' AND company_id = '" . $companyId . "'";
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