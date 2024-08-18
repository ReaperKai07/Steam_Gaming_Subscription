<?php

require_once 'includes/dbconn.php';
require_once 'models/Order.php';
require_once 'models/Product.php';
require_once 'models/User.php';

class AdminDashboardController
{
    private $order;
    private $product;
    private $user;

    public function __construct()
    {
        global $conn;

        $this->order = new Order($conn);
        $this->product = new Product($conn);
        $this->user = new User($conn);
    }

    
    public function getAllOrdersPending()
    {
        try
        {
            $result = $this->order->getAllOrdersPending();
            return $result;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }

    public function getAllProducts()
    {
        try
        {
            $result = $this->product->getAllProducts();
            return $result;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }

    public function countOrder()
    {
        try
        {
            $result = $this->order->countAllOrders();
            return $result;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }

    public function countProduct()
    {
        try
        {
            $result = $this->product->countAllProducts();
            return $result;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }

    public function countUser()
    {
        try
        {
            $result = $this->user->countAllUsers();
            return $result;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }
    
}

?>
