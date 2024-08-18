<?php

require_once 'includes/dbconn.php';
require_once 'models/Order.php';

class PrintOrdersController
{
    private $order;

    public function __construct()
    {
        global $conn;

        $this->order = new Order($conn);
    }

    // Get specific order by order_id
    public function getOrderById($order_id)
    {
        try
        {
            return $this->order->getOrderById($order_id);
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
        
    }
    
}

?>
