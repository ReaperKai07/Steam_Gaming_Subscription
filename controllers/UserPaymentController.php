<?php

require_once 'includes/dbconn.php';
require_once 'models/Memberships.php';
require_once 'models/User.php';
require_once 'models/Product.php';
require_once 'models/Order.php';

class UserPaymentController
{
    private $membership;

    public function __construct()
    {
        global $conn;

        $this->membership = new Membership($conn);
        $this->user = new User($conn);
        $this->product = new Product($conn);
        $this->order = new Order($conn);
    }

    public function getSpecificMemberships($membership_id)
    {
        try
        {
            $specificMemberships = $this->membership->getSpecificMemberships($membership_id);
            return $specificMemberships;
        }

        catch (Exception $e)
        {
            error_log("Error in getSpecificMemberships: " . $e->getMessage());
            return false;
        }
    }

    public function updateMembership($membershippay, $userEmail)
    {
        try
        {
            $this->user->updateMembership($membershippay, $userEmail);
            return true;
        }
        
        catch (Exception $e)
        {
            error_log("Error in updateMembership: " . $e->getMessage());
            return false;
        }
    }

    public function addOrder($product_id, $total_price, $date, $status, $userEmail)
    {
        try
        {
            $this->order->addOrder($product_id, $total_price, $date, $status, $userEmail);
            return true;
        }
        
        catch (Exception $e)
        {
            error_log("Error in addOrder: " . $e->getMessage());
            return false;
        }
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
}
?>