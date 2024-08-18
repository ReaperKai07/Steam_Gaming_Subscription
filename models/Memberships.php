<?php

require_once 'includes/dbconn.php';

class Membership
{
    public function getSpecificMemberships($membership_id)
    {
        global $conn;

        $sql = "SELECT * FROM membership WHERE membership_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $membership_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $membership = $this->handleResult($result);

        return $membership;
    }

    private function handleResult($result)
    {
        global $conn;

        if (!$result)
        {
            $errorMessage = "Error executing query: " . mysqli_error($conn);
            error_log($errorMessage);
            throw new Exception($errorMessage);
        }

        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        return $products;
    }
}
?>












