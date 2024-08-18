<?php

require_once 'includes/dbconn.php';
require_once 'models/User.php';
require_once 'models/Order.php';

class AdminUsersProfileController
{
    private $user;

    public function __construct()
    {
        global $conn;

        $this->user = new User($conn);
        $this->order = new Order($conn);
    }

    public function getSpecificUsers($email)
    {
        try
        {
            $specificUsers = $this->user->getSpecificUsers($email);
            return $specificUsers;
        }

        catch (Exception $e)
        {
            error_log("Error in getSpecificUsers: " . $e->getMessage());
            return false;
        }
    }

    public function updateProfile($email, $name, $phone, $address, $membership, $password, $picture)
    {
        try
        {
            $this->user->updateProfile($email, $name, $phone, $address, $membership, $password, $picture);
            return true;
        }
        
        catch (Exception $e)
        {
            error_log("Error in updateProfile: " . $e->getMessage());
            return false;
        }
    }

    public function deleteUsers($email)
    {
        try
        {
            $deleteUsers = $this->user->deleteProfile($email);
            return $deleteUsers;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }

    public function getAllOrder($userEmail)
    {
        try
        {
            $allOrders = $this->order->getAllOrder($userEmail);
            return $allOrders;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
            return false;
        }
    }
}


?>
