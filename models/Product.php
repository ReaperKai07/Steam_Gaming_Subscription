<?php

require_once 'includes/dbconn.php';

class Product
{
    public function getAllProducts()
    {
        global $conn;

        $sql = "SELECT * FROM product ORDER BY product_id ASC";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $products = $this->handleResult($result);

            return $products;
        } else {
            // Handle the case where the prepare statement fails
            return false;
        }
    }

    public function countAllProducts()
    {
        global $conn;

        $sql = "SELECT COUNT(*) FROM product";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return $count;
    }

    public function getSpecificProducts($product)
    {
        global $conn;

        $sql = "SELECT * FROM product WHERE product_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $product);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $products = $this->handleResult($result);

        return $products;
    }

    public function deleteProduct($product_id)
    {
        global $conn;

        $sql = "DELETE FROM product WHERE product_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $product_id);
        mysqli_stmt_execute($stmt);

        // Check if the delete operation was successful
        if (mysqli_stmt_affected_rows($stmt) > 0)
        {
            return true; // Deletion successful
        }
        else
        {
            return false; // Deletion failed
        }
    }

    public function updateProduct($product_id, $product_name, $product_price, $product_category, $product_description, $product_image)
    {
        global $conn;

        $sql = "UPDATE product SET product_name=?, product_price=?, product_category=?, product_description=?, product_image=? WHERE product_id=?";
        $stmt = mysqli_prepare($conn, $sql);
        
        // Use "sssssi" for binding parameters
        mysqli_stmt_bind_param($stmt, "ssssss", $product_name, $product_price, $product_category, $product_description, $product_image, $product_id);
        
        if (mysqli_stmt_execute($stmt))
        {
            mysqli_stmt_close($stmt);
            return true;
        }
        else
        {
            $errorMessage = "Error updating product: " . mysqli_error($conn);
            error_log($errorMessage);
            mysqli_stmt_close($stmt);
            throw new Exception($errorMessage);
        }
    }

    public function addProduct($product_id, $product_name, $product_price, $product_category, $product_description, $picture)
    {
        global $conn;

        // Check if the email already exists
        $checkSql = "SELECT COUNT(*) FROM product WHERE product_id=?";
        $checkStmt = mysqli_prepare($conn, $checkSql);
        mysqli_stmt_bind_param($checkStmt, "s", $product_id);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_bind_result($checkStmt, $count);
        mysqli_stmt_fetch($checkStmt);
        mysqli_stmt_close($checkStmt);

        if ($count > 0)
        {
            return false; // Product already exists, return false
        }

        else
        {
            // Proceed with the INSERT statement
            $insertSql = "INSERT INTO product (product_id, product_name, product_price, product_category, product_description, product_image) VALUES (?, ?, ?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($insertStmt, "ssssss", $product_id, $product_name, $product_price, $product_category, $product_description, $picture);

            if (mysqli_stmt_execute($insertStmt))
            {
                mysqli_stmt_close($insertStmt);
                return true;
            }

            else
            {
                $errorMessage = "Error adding product: " . mysqli_error($conn);
                error_log($errorMessage);
                mysqli_stmt_close($insertStmt);
                throw new Exception($errorMessage);
            }
        }
        return false; 
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
