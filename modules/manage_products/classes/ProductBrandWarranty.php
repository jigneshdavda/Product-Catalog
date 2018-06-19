<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 9/6/18
 * Time: 11:09 PM
 */

class ProductBrandWarranty
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getProductBrandWarranty($companyId)
    {
        $sql = "SELECT * FROM `product_brand_warranty` WHERE company_id = '" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insertProductBrandWarranty($product_brand_warranty_type, $company_id)
    {
        $productBrandWarrantyType = $this->connection->real_escape_string($product_brand_warranty_type);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "SELECT * FROM `product_brand_warranty` WHERE  product_brand_warranty_type_name ='" . $productBrandWarrantyType . "' AND company_id ='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows == 0) {
            $insert_sql = "INSERT INTO `product_brand_warranty`(`product_brand_warranty_type_name`, `company_id`) VALUES ('" . $productBrandWarrantyType . "','" . $companyId . "'))";
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

    public function updateProductBrandWarranty($product_brand_warranty_id, $product_brand_warranty_type, $company_id)
    {
        $productBrandWarrantyId = $this->connection->real_escape_string($product_brand_warranty_id);
        $productBrandWarrantyType = $this->connection->real_escape_string($product_brand_warranty_type);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "UPDATE `product_brand_warranty` SET `product_brand_warranty_type_name`='" . $productBrandWarrantyType . "' WHERE `product_brand_warranty_type_id`='" . $productBrandWarrantyId . "' AND `company_id`='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result === true) {
            return true;
        } elseif ($result === false) {
            return false;
        } else {
            return Constants::STATUS_EXISTS;
        }
    }

    public function deleteProductBrandWarranty($product_brand_warranty_id, $company_id)
    {
        $productBrandWarrantyId = $this->connection->real_escape_string($product_brand_warranty_id);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "DELETE FROM `product_brand_warranty` WHERE product_brand_warranty_id = '" . $productBrandWarrantyId . "' AND company_id = '" . $companyId . "'";
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