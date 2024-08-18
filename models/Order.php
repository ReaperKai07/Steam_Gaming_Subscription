<?php

require_once 'includes/dbconn.php';

class Order
{
    public function getAllOrdersPending()
    {
        global $conn;

        $status = "Pending";
        $sql = "SELECT * FROM orders WHERE status=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $status);
        
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $orders = $this->handleResult($result);

            return $orders;
        } else {
            // Handle the case where the prepare statement fails
            return false;
        }
    }

    public function addOrder($product_id, $total_price, $date, $status, $userEmail)
    {
        global $conn;

        // Check if the order already exists
        $checkSql = "SELECT COUNT(*) FROM orders WHERE order_id=?";
        $checkStmt = mysqli_prepare($conn, $checkSql);
        mysqli_stmt_bind_param($checkStmt, "s", $product_id);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_bind_result($checkStmt, $count);
        mysqli_stmt_fetch($checkStmt);
        mysqli_stmt_close($checkStmt);

        if ($count > 0)
        {
            return false; // Order already exists, return false
        }
        else
        {
            // Proceed with the INSERT statement
            $insertSql = "INSERT INTO orders (product_id, total_price, date, status, email) VALUES (?, ?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($insertStmt, "sssss", $product_id, $total_price, $date, $status, $userEmail);

            if (mysqli_stmt_execute($insertStmt))
            {
                mysqli_stmt_close($insertStmt);
                return true;
            }
            else
            {
                $errorMessage = "Error adding order: " . mysqli_error($conn);
                error_log($errorMessage);
                mysqli_stmt_close($insertStmt);
                throw new Exception($errorMessage);
            }
        }
        return false;
    }

    public function countAllOrders()
    {
        global $conn;

        $sql = "SELECT COUNT(*) FROM orders";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return $count;
    }

    public function getAllOrder($userEmail)
    {
        global $conn;

        $sql = "SELECT * FROM orders WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $orders = $this->handleResult($result);

        return $orders;
    }

    public function getAllOrders()
    {
        global $conn;

        $sql = "SELECT * FROM orders ORDER BY status ASC";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $orders = $this->handleResult($result);

            return $orders;
        } else {
            // Handle the case where the prepare statement fails
            return false;
        }
    }

    public function checkOrders($user_email, $product_id)
    {
        global $conn;

        $sql = "SELECT * FROM orders WHERE email=? AND product_id=? AND status='Approved'";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $user_email, $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $orders = $this->handleResult($result);

        return !empty($orders); // Return true if orders are found, false otherwise
    }

    public function approveOrder($order_id, $orderStatus)
    {
        global $conn;

        $sql = "UPDATE orders SET status=? WHERE order_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        
        // Use "sssssi" for binding parameters
        mysqli_stmt_bind_param($stmt, "ss", $orderStatus, $order_id);
        
        if (mysqli_stmt_execute($stmt))
        {
            mysqli_stmt_close($stmt);
            return true;
        }
        else
        {
            $errorMessage = "Error updating status order: " . mysqli_error($conn);
            error_log($errorMessage);
            mysqli_stmt_close($stmt);
            throw new Exception($errorMessage);
        }
    }

    public function getOrderById($order_id)
    {
        global $conn;

        $sql = "SELECT * FROM orders WHERE order_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $order_id); // Assuming order_id is an integer, adjust if it's a different type
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $order = $this->handleResult($result);

        return !empty($order) ? $order[0] : null; // Return the first order if found, otherwise return null
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
