<?php

require_once 'includes/dbconn.php';
require_once 'models/Product.php';
require_once 'models/Order.php';

class ProductController
{
    private $product;

    public function __construct()
    {
        global $conn;

        $this->product = new Product($conn);
        $this->order = new Order($conn);
    }

    public function getAllProducts()
    {
        try
        {
            $allProducts = $this->product->getAllProducts();
            return $allProducts;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }

    public function getSpecificProducts($product)
    {
        try
        {
            $specificProducts = $this->product->getSpecificProducts($product);
            return $specificProducts;
        }

        catch (Exception $e)
        {
            error_log("Error in getSpecificUsers: " . $e->getMessage());
            return false;
        }
    }

    public function checkOrders($product_id)
    {
        try
        {
            $specificOrders = $this->order->checkOrders($product_id);
            return $specificOrders;
        }

        catch (Exception $e)
        {
            error_log("Error in checkOrders: " . $e->getMessage());
            return false;
        }
    }
}

?>
