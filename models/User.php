<?php

require_once 'includes/dbconn.php';

class User
{
    public function loginUser($email, $password, $role)
    {
        global $conn;

        // Retrieve user data based on email
        $sql = "SELECT * FROM user WHERE email=? AND role=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $email, $role);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        // Check if a user was found with the given email and role
        if ($user)
        {
            // Compare the provided password with the stored password
            if ($password === $user['password'])
            {
                return true; // Login successful
            }

            else
            {
                return false; // Incorrect password
            }
        }

        else
        {
            return false; // User not found
        }
    }

    public function countAllUsers()
    {
        global $conn;

        $sql = "SELECT COUNT(*) FROM user";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return $count;
    }

    public function signupUser($name, $email, $password, $role, $picture, $membership)
    {
        global $conn;

        // Check if the email already exists
        $checkSql = "SELECT COUNT(*) FROM user WHERE email=?";
        $checkStmt = mysqli_prepare($conn, $checkSql);
        mysqli_stmt_bind_param($checkStmt, "s", $email);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_bind_result($checkStmt, $count);
        mysqli_stmt_fetch($checkStmt);
        mysqli_stmt_close($checkStmt);

        if ($count > 0)
        {
            return false; // Email already exists, return false
        }

        else
        {
            // Proceed with the INSERT statement
            $insertSql = "INSERT INTO user (email, name, password, role, picture, membership) VALUES (?, ?, ?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($insertStmt, "ssssss", $email, $name, $password, $role, $picture, $membership);

            if (mysqli_stmt_execute($insertStmt))
            {
                mysqli_stmt_close($insertStmt);
                return true;
            }

            else
            {
                $errorMessage = "Error creating profile: " . mysqli_error($conn);
                error_log($errorMessage);
                mysqli_stmt_close($insertStmt);
                throw new Exception($errorMessage);
            }
        }
        return false; 
    }

    public function getAllUsers()
    {
        global $conn;

        $role = '1';

        $sql = "SELECT * FROM user WHERE role=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $role);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $users = $this->handleResult($result);

        return $users;
    }

    public function getSpecificUsers($email)
    {
        global $conn;

        $sql = "SELECT * FROM user WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $users = $this->handleResult($result);

        return $users;
    }

    public function deleteProfile($email)
    {
        global $conn;

        $sql = "DELETE FROM user WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
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

    public function updateProfile($email, $name, $phone, $address, $membership, $password, $picture)
    {
        global $conn;

        $sql = "UPDATE user SET name=?, phone=?, address=?, membership=?, password=?, picture=? WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $name, $phone, $address, $membership, $password, $picture, $email);
        
        if (mysqli_stmt_execute($stmt))
        {
            mysqli_stmt_close($stmt);
            return true;
        }
        else
        {
            $errorMessage = "Error updating profile: " . mysqli_error($conn);
            error_log($errorMessage);
            mysqli_stmt_close($stmt);
            throw new Exception($errorMessage);
        }
    }

    public function addProfile($email, $name, $phone, $address, $membership, $password, $picture, $role)
    {
        global $conn;

        // Check if the email already exists
        $checkSql = "SELECT COUNT(*) FROM user WHERE email=?";
        $checkStmt = mysqli_prepare($conn, $checkSql);
        mysqli_stmt_bind_param($checkStmt, "s", $email);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_bind_result($checkStmt, $count);
        mysqli_stmt_fetch($checkStmt);
        mysqli_stmt_close($checkStmt);

        if ($count > 0)
        {
            return false; // Email already exists, return false
        }

        else
        {
            // Proceed with the INSERT statement
            $insertSql = "INSERT INTO user (email, name, phone, address, membership, password, picture, role) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $insertStmt = mysqli_prepare($conn, $insertSql);
            mysqli_stmt_bind_param($insertStmt, "ssssssss", $email, $name, $phone, $address, $membership, $password, $picture, $role);

            if (mysqli_stmt_execute($insertStmt))
            {
                mysqli_stmt_close($insertStmt);
                return true;
            }

            else
            {
                $errorMessage = "Error creating profile: " . mysqli_error($conn);
                error_log($errorMessage);
                mysqli_stmt_close($insertStmt);
                throw new Exception($errorMessage);
            }
        }
        return false; 
    }

    public function updateMembership($membershippay, $userEmail)
    {
        global $conn;

        $sql = "UPDATE user SET membership=? WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $membershippay, $userEmail);
        
        if (mysqli_stmt_execute($stmt))
        {
            mysqli_stmt_close($stmt);
            return true;
        }
        else
        {
            $errorMessage = "Error updating membership: " . mysqli_error($conn);
            error_log($errorMessage);
            mysqli_stmt_close($stmt);
            throw new Exception($errorMessage);
        }
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

        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);

        return $users;
    }
}

?>
