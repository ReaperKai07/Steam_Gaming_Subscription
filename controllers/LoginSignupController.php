<?php

require_once 'includes/dbconn.php';
require_once 'models/User.php';

class LoginSignupController
{
    private $user;

    public function __construct()
    {
        global $conn;

        $this->user = new User($conn);
    }

    public function signupUser($name, $email, $password, $role, $picture, $membership)
    {
        try
        {
            $result = $this->user->signupUser($name, $email, $password, $role, $picture, $membership);
            return $result;
        }

        catch (Exception $e)
        {
            error_log("Error in signupUser: " . $e->getMessage());
            return false;
        }
    }

    public function loginUser($email, $password, $role)
    {
        try
        {
            $result = $this->user->loginUser($email, $password, $role);
            return $result;
        }

        catch (Exception $e)
        {
            error_log("Error in loginUser: " . $e->getMessage());
            return false;
        }
    }
}


?>
