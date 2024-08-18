<?php

require_once 'includes/dbconn.php';
require_once 'models/Memberships.php';
require_once 'models/User.php';

class UserPaymentController
{
    private $membership;

    public function __construct()
    {
        global $conn;

        $this->membership = new Membership($conn);
        $this->user = new User($conn);
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
}
?>