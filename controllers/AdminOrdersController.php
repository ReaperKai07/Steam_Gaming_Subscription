<?php

require_once 'includes/dbconn.php';
require_once 'models/Order.php';

class AdminOrdersController
{
    private $order;

    public function __construct()
    {
        global $conn;

        $this->order = new Order($conn);
    }

    public function getAllOrders()
    {
        try
        {
            $allOrders = $this->order->getAllOrders();
            return $allOrders;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }

    public function approveOrder($order_id, $orderStatus)
    {
        try
        {
            $approveOrders = $this->order->approveOrder($order_id, $orderStatus);
            return $approveOrders;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }

    public function getPaginatedOrders($page = 1, $perPage = 5)
    {
        $start = ($page - 1) * $perPage;
        $end = $start + $perPage;

        $allOrders = $this->getAllOrders();

        // Use array_slice to get a portion of the products array based on the page and perPage values
        $paginatedOrders = array_slice($allOrders, $start, $perPage);

        return $paginatedOrders;
    }
}

?>
