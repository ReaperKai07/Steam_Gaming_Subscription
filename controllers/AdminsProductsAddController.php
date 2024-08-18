<?php

require_once 'includes/dbconn.php';
require_once 'models/Product.php';

class AdminsProductsAddController
{
    private $product;

    public function __construct()
    {
        global $conn;

        $this->product = new Product($conn);
    }

    public function addProduct($product_id, $product_name, $product_price, $product_category, $product_description, $picture)
    {
        try
        {
            $result = $this->product->addProduct($product_id, $product_name, $product_price, $product_category, $product_description, $picture);
            if ($result)
            {
                return true;
            }

            else
            {
                return false;
            }
        }
        
        catch (Exception $e)
        {
            error_log("Error in addProduct: " . $e->getMessage());
            return false;
        }
    }
}


?>
