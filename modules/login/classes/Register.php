<?php
/**
 * Created by PhpStorm.
 * User: fireion
 * Date: 28/5/18
 * Time: 12:16 PM
 */

class Register
{
    private $connection;

    function __construct($connection)
    {
        $this->connection = $connection;
    }

    function getCompanyDetails($phone_number, $companyId)
    {
        if ($phone_number != null && $companyId == 0) {
            $sql = "SELECT company_id FROM `company_details` WHERE company_phone='" . $phone_number . "'";
        } elseif ($phone_number != null && $companyId > 0) {
            $sql = "SELECT * FROM `company_details` WHERE company_id = '" . $companyId . "' AND company_phone='" . $phone_number . "'";
        } else {
            $sql = "SELECT * FROM `company_details`";
        }

        $result = $this->connection->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function insertCompanyDetails($company_name, $company_email, $company_phone,
                                  $company_address_line_1, $company_address_line_2, $_country,
                                  $company_password)
    {
        $companyName = $this->connection->real_escape_string($company_name);
        $companyEmail = $this->connection->real_escape_string($company_email);
        $companyPhone = $this->connection->real_escape_string($company_phone);
        $companyAddressLine1 = $this->connection->real_escape_string($company_address_line_1);
        $companyAddressLine2 = $this->connection->real_escape_string($company_address_line_2);
        $country = $this->connection->real_escape_string($_country);
        $companyPassword = $this->connection->real_escape_string($company_password);

        $sql = "SELECT * FROM `company_details` WHERE company_name = '" . $companyName . "' OR company_phone = '" . $companyPhone . "' OR company_email = '" . $companyEmail . "'";
        $result = $this->connection->query($sql);

        if ($result->num_rows == 0) {
            $insert_sql = "INSERT INTO `company_details`(`company_name`, `company_email`, 
`company_phone`, `company_address_line_1`, `company_address_line_2`, `country`, `company_password`) 
VALUES ('" . $companyName . "','" . $companyEmail . "','" . $companyPhone . "',
'" . $companyAddressLine1 . "','" . $companyAddressLine2 . "','" . $country . "','" . $companyPassword . "')";
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

    function updateCompanyDetails($company_id, $company_name, $company_email, $company_phone,
                                  $company_address_line_1, $company_address_line_2, $_country,
                                  $company_password)
    {
        $companyId = $this->connection->real_escape_string($company_id);
        $companyName = $this->connection->real_escape_string($company_name);
        $companyEmail = $this->connection->real_escape_string($company_email);
        $companyPhone = $this->connection->real_escape_string($company_phone);
        $companyAddressLine1 = $this->connection->real_escape_string($company_address_line_1);
        $companyAddressLine2 = $this->connection->real_escape_string($company_address_line_2);
        $country = $this->connection->real_escape_string($_country);
        $companyPassword = $this->connection->real_escape_string($company_password);

        $sql = "UPDATE `company_details` SET `company_name`='" . $companyName . "',
        `company_email`='" . $companyEmail . "',`company_phone`='" . $companyPhone . "',
        `company_address_line_1`='" . $companyAddressLine1 . "',
        `company_address_line_2`='" . $companyAddressLine2 . "',`country`='" . $country . "',
        `company_password`='" . $companyPassword . "' WHERE `company_id`='" . $companyId . "'";

        $result = $this->connection->query($sql);

        if ($result === true) {
            return true;
        } elseif ($result === false) {
            return false;
        } else {
            return Constants::STATUS_EXISTS;
        }
    }

    function deleteCompanyDetails($company_id)
    {
        $companyId = $this->connection->real_escape_string($company_id);

        $sql = "DELETE FROM `company_details` WHERE `id` = '" . $companyId . "'";
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