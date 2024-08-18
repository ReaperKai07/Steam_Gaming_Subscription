<?php

require_once 'includes/dbconn.php';
require_once 'models/User.php';

class AdminUsersAddController
{
    private $user;

    public function __construct()
    {
        global $conn;

        $this->user = new User($conn);
    }

    public function addProfile($email, $name, $phone, $address, $membership, $password, $picture, $role)
    {
        try
        {
            $result = $this->user->addProfile($email, $name, $phone, $address, $membership, $password, $picture, $role);
            if ($result)
            {
                // Profile added successfully
                return true;
            }

            else
            {
                // Profile already exists, handle accordingly
                // You can display an error message or take other actions
                return false;
            }
        }
        
        catch (Exception $e)
        {
            error_log("Error in addProfile: " . $e->getMessage());
            return false;
        }
    }
}


?>
