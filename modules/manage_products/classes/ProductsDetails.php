<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 9/6/18
 * Time: 3:59 PM
 */

class ProductsDetails
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function getProductDetails($product_category_id, $product_brand_id, $product_details_id, $companyId)
    {
        if ($product_category_id > 0 && $product_brand_id > 0 && $product_details_id == 0 && $companyId == 0) {
            $sql = "SELECT product_details_id,product_details_model_name,product_details_model_color,
pc.product_condition_name AS product_condition_name,pbt.product_box_type_name AS product_box_type_name,
pbw.product_brand_warranty_type AS product_brand_warranty_name,product_details_warranty_expiry,
product_details_model_comments,product_details_model_quantity,product_details_mfg_price,
product_details_company_price FROM `product_details` AS pd,`product_box_type` AS pbt,
`product_brand_warranty` AS pbw,`product_condition` AS pc WHERE 
product_details_category = '" . $product_category_id . "' AND 
product_details_brand = '" . $product_brand_id . "' AND 
pd.product_details_condition = pc.product_condition_id AND 
pd.product_details_box_type = pbt.product_box_type_id AND 
pd.product_details_brand_warranty = pbw.product_brand_warranty_id";
        } elseif ($product_category_id == 0 && $product_brand_id == 0 && $product_details_id > 0 && $companyId > 0) {
            $sql = "SELECT * FROM `product_details` AS pd,`product_box_type` AS pbt,
`product_brand_warranty` AS pbw,`product_condition` AS pc, `product_category` AS pCategory, `product_brand` AS pb WHERE 
pd.product_details_category = pCategory.product_category_id AND 
pd.product_details_brand = pb.product_brand_id AND
product_details_id = '" . $product_details_id . "' AND 
pd.product_details_condition = pc.product_condition_id AND 
pd.product_details_box_type = pbt.product_box_type_id AND 
pd.product_details_brand_warranty = pbw.product_brand_warranty_id AND pd.company_id = '" . $companyId . "'";
//            product_details_id,product_details_model_name,product_details_model_color,
//pc.product_condition_name AS product_condition_name,pbt.product_box_type_name AS product_box_type_name,
//pbw.product_brand_warranty_type AS product_brand_warranty_name,product_details_warranty_expiry,
//product_details_model_comments,product_details_model_quantity,product_details_mfg_price,
//product_details_company_price, pCategory.product_category_name AS product_category_name, pb.product_brand_name AS product_brand_name
        } elseif ($product_category_id > 0 && $product_brand_id > 0 && $product_details_id == 0 && $companyId > 0) {
            $sql = "SELECT product_details_id,product_details_model_name,product_details_model_color,
pc.product_condition_name AS product_condition_name,pbt.product_box_type_name AS product_box_type_name,
pbw.product_brand_warranty_type AS product_brand_warranty_name,product_details_warranty_expiry,
product_details_model_comments,product_details_model_quantity,product_details_mfg_price,
product_details_company_price FROM `product_details` AS pd,`product_box_type` AS pbt,
`product_brand_warranty` AS pbw,`product_condition` AS pc WHERE 
product_details_category = '" . $product_category_id . "' AND 
product_details_brand = '" . $product_brand_id . "' AND 
pd.product_details_condition = pc.product_condition_id AND 
pd.product_details_box_type = pbt.product_box_type_id AND 
pd.product_details_brand_warranty = pbw.product_brand_warranty_id AND pd.company_id = '" . $companyId . "'";
        } else {
            $sql = "SELECT * FROM `product_details`";
        }
        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insertProductDetails($product_details_category,
                                         $product_details_brand, $product_details_model_name,
                                         $product_details_model_color, $product_details_condition,
                                         $product_details_box_type, $product_details_brand_warranty,
                                         $product_details_warranty_expiry, $product_details_model_comments,
                                         $product_details_model_quantity, $product_details_mfg_price,
                                         $product_details_company_price, $company_id)
    {
        $productDetailsCategory = $this->connection->real_escape_string($product_details_category);
        $productDetailsBrand = $this->connection->real_escape_string($product_details_brand);
        $productDetailsModelName = $this->connection->real_escape_string($product_details_model_name);
        $productDetailsModelColor = $this->connection->real_escape_string($product_details_model_color);
        $productDetailsCondition = $this->connection->real_escape_string($product_details_condition);
        $productDetailsBoxType = $this->connection->real_escape_string($product_details_box_type);
        $productDetailsBrandWarranty = $this->connection->real_escape_string($product_details_brand_warranty);
        $productDetailsWarrantyExpiry = $this->connection->real_escape_string($product_details_warranty_expiry);
        $productDetailsModelComments = $this->connection->real_escape_string($product_details_model_comments);
        $productDetailsModelQuantity = $this->connection->real_escape_string($product_details_model_quantity);
        $productDetailsMFGPrice = $this->connection->real_escape_string($product_details_mfg_price);
        $productDetailsCompanyPrice = $this->connection->real_escape_string($product_details_company_price);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "SELECT * FROM `product_details` WHERE 
product_details_brand ='" . $productDetailsBrand . "' AND 
product_details_model_name ='" . $productDetailsModelName . "' AND 
product_details_model_color ='" . $productDetailsModelColor . "' AND 
product_details_condition ='" . $productDetailsCondition . "' AND 
product_details_box_type ='" . $productDetailsBoxType . "' AND   
product_details_brand_warranty ='" . $productDetailsBrandWarranty . "' AND 
product_details_warranty_expiry ='" . $productDetailsWarrantyExpiry . "' AND company_id ='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows == 0) {
            $insert_sql = "INSERT INTO `product_details`(`product_details_category`,
 `product_details_brand`, `product_details_model_name`, `product_details_model_color`, 
 `product_details_condition`, `product_details_box_type`, `product_details_brand_warranty`, 
 `product_details_warranty_expiry`, `product_details_model_comments`, `product_details_model_quantity`, 
 `product_details_mfg_price`, `product_details_company_price`, `company_id`) 
 VALUES ('" . $productDetailsCategory . "','" . $productDetailsBrand . "',
 '" . $productDetailsModelName . "','" . $productDetailsModelColor . "',
 '" . $productDetailsCondition . "','" . $productDetailsBoxType . "',
 '" . $productDetailsBrandWarranty . "','" . $productDetailsWarrantyExpiry . "',
 '" . $productDetailsModelComments . "','" . $productDetailsModelQuantity . "',
 '" . $productDetailsMFGPrice . "','" . $productDetailsCompanyPrice . "','" . $companyId . "')";
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

    public function updateProductDetails($product_details_id, $product_details_model_name,
                                         $product_details_model_color, $product_details_condition,
                                         $product_details_box_type, $product_details_brand_warranty,
                                         $product_details_warranty_expiry, $product_details_model_comments,
                                         $product_details_model_quantity, $product_details_mfg_price,
                                         $product_details_company_price, $company_id)
    {
        $productDetailsId = $this->connection->real_escape_string($product_details_id);
        $productDetailsModelName = $this->connection->real_escape_string($product_details_model_name);
        $productDetailsModelColor = $this->connection->real_escape_string($product_details_model_color);
        $productDetailsCondition = $this->connection->real_escape_string($product_details_condition);
        $productDetailsBoxType = $this->connection->real_escape_string($product_details_box_type);
        $productDetailsBrandWarranty = $this->connection->real_escape_string($product_details_brand_warranty);
        $productDetailsWarrantyExpiry = $this->connection->real_escape_string($product_details_warranty_expiry);
        $productDetailsModelComments = $this->connection->real_escape_string($product_details_model_comments);
        $productDetailsModelQuantity = $this->connection->real_escape_string($product_details_model_quantity);
        $productDetailsMFGPrice = $this->connection->real_escape_string($product_details_mfg_price);
        $productDetailsCompanyPrice = $this->connection->real_escape_string($product_details_company_price);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "UPDATE `product_details` SET `product_details_model_name`='" . $productDetailsModelName . "',
`product_details_model_color`='" . $productDetailsModelColor . "',`product_details_condition`='" . $productDetailsCondition . "',
`product_details_box_type`='" . $productDetailsBoxType . "',`product_details_brand_warranty`='" . $productDetailsBrandWarranty . "',
`product_details_warranty_expiry`='" . $productDetailsWarrantyExpiry . "',`product_details_model_comments`='" . $productDetailsModelComments . "',
`product_details_model_quantity`='" . $productDetailsModelQuantity . "',`product_details_mfg_price`='" . $productDetailsMFGPrice . "',
`product_details_company_price`='" . $productDetailsCompanyPrice . "' WHERE `product_details_id`='" . $productDetailsId . "' AND `company_id`='" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProductDetails($product_details_id, $company_id)
    {
        $productDetailsId = $this->connection->real_escape_string($product_details_id);
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "DELETE FROM `product_details` WHERE product_details_id = '" . $productDetailsId . "' AND company_id = '" . $companyId . "'";
        $result = $this->connection->query($sql);

        if ($result === true) {
            return true;
        } else {
            return false;
        }
    }
}