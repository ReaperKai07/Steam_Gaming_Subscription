<?php

require_once 'includes/dbconn.php';
require_once 'models/Product.php';

class AdminProductsDetailController
{
    private $product;

    public function __construct()
    {
        global $conn;

        $this->product = new Product($conn);
    }

    public function getSpecificProducts($product_id)
    {
        try
        {
            $specificProducts = $this->product->getSpecificProducts($product_id);
            return $specificProducts;
        }

        catch (Exception $e)
        {
            error_log("Error in getSpecificUsers: " . $e->getMessage());
            return false;
        }
    }

    public function updateProduct($product_id, $product_name, $product_price, $product_category, $product_description, $product_image)
    {
        try
        {
            $this->product->updateProduct($product_id, $product_name, $product_price, $product_category, $product_description, $product_image);
            return true;
        }
        
        catch (Exception $e)
        {
            error_log("Error in updateProduct: " . $e->getMessage());
            return false;
        }
    }

    public function deleteProducts($product_id)
    {
        try
        {
            $deleteProducts = $this->product->deleteProduct($product_id);
            return $deleteProducts;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }
}


?>
