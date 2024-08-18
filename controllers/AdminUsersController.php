<?php

require_once 'includes/dbconn.php';
require_once 'models/User.php';

class AdminUsersController
{
    private $user;

    public function __construct()
    {
        global $conn;

        $this->user = new User($conn);
    }

    public function getAllUsers()
    {
        try
        {
            $allUsers = $this->user->getAllUsers();
            return $allUsers;
        }

        catch (Exception $e)
        {
            logError($e->getMessage());
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

    public function getPaginatedUsers($page = 1, $perPage = 5)
    {
        $start = ($page - 1) * $perPage;
        $end = $start + $perPage;

        $allUsers = $this->getAllUsers();

        // Use array_slice to get a portion of the users array based on the page and perPage values
        $paginatedUsers = array_slice($allUsers, $start, $perPage);

        return $paginatedUsers;
    }
}

?>
