<?php

require_once 'includes/dbconn.php';
require_once 'models/Product.php';

class AdminProductsController
{
    private $product;

    public function __construct()
    {
        global $conn;

        $this->product = new Product($conn);
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

    public function getPaginatedProducts($page = 1, $perPage = 5)
    {
        $start = ($page - 1) * $perPage;
        $end = $start + $perPage;

        $allProducts = $this->getAllProducts();

        // Use array_slice to get a portion of the products array based on the page and perPage values
        $paginatedProducts = array_slice($allProducts, $start, $perPage);

        return $paginatedProducts;
    }
}

?>
