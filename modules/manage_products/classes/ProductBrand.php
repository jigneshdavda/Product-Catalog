<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 9/6/18
 * Time: 11:09 PM
 */

class ProductBrand
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getProductBrand($product_category_id, $companyId)
    {
        if ($product_category_id > 0 && $companyId > 0) {
            $sql = "SELECT * FROM `product_brand` WHERE product_brand_category_id = '" . $product_category_id . "' AND company_id = '" . $companyId . "'";
        } elseif ($product_category_id == 0 && $companyId > 0) {
            $sql = "SELECT * FROM `product_brand` WHERE company_id = '" . $companyId . "'";
        } elseif ($product_category_id > 0 && $companyId == 0) {
            $sql = "SELECT * FROM `product_brand` WHERE product_brand_category_id = '" . $product_category_id . "'";

        } else {
            $sql = "SELECT * FROM `product_brand`";
        }
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insertProductBrand($product_brand_name, $product_brand_category_id, $company_id)
    {
        $productBrandName = $this->connection->real_escape_string($product_brand_name);
        $productBrandCategoryId = $this->connection->real_escape_string($product_brand_category_id);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "SELECT * FROM `product_brand` WHERE  product_brand_name ='" . $productBrandName . "' AND company_id ='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows == 0) {
            $insert_sql = "INSERT INTO `product_brand`(`product_brand_name`, `product_brand_category_id`, `company_id`) VALUES ('" . $productBrandName . "','" . $productBrandCategoryId . "','" . $companyId . "')";
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

    public function updateProductBrand($product_brand_id, $product_brand_name, $company_id)
    {
        $productBrandId = $this->connection->real_escape_string($product_brand_id);
        $productBrandName = $this->connection->real_escape_string($product_brand_name);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "UPDATE `product_brand` SET `product_brand_name`='" . $productBrandName . "' WHERE `product_brand_type_id`='" . $productBrandId . "' AND `company_id`='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result === true) {
            return true;
        } elseif ($result === false) {
            return false;
        } else {
            return Constants::STATUS_EXISTS;
        }
    }

    public function deleteProductBrand($product_brand_id, $company_id)
    {
        $productBrandId = $this->connection->real_escape_string($product_brand_id);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "DELETE FROM `product_brand` WHERE product_brand_id = '" . $productBrandId . "' AND company_id = '" . $companyId . "'";
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