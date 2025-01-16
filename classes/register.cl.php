<?php
require_once 'classes/db.php';

class register extends connection {

    public $register_error = "";

    public function userExists($username, $email)
    {
        $query = $this->conn->prepare("SELECT * FROM user WHERE username = :username OR email = :email");
        $query->bindParam(":username", $username);
        $query->bindParam(":email", $email);
        $query->execute();
        return $query->rowCount() > 0;
    }

    private function validateInputs($username, $email, $password, $confirmPassword, $role)
    {
        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword) || empty($role)) {
            $this->register_error = "All fields are required!";
            return false;
        } elseif (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $username)) {
            $this->register_error = "Username must be 4-20 characters long and can only contain letters, numbers, and underscores.";
            return false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->register_error = "Invalid email address.";
            return false;
        } elseif (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[@$!%*?&#]/', $password)) {
            $this->register_error = "Password must be at least 8 characters long and include letters, numbers, and special characters.";
            return false;
        } elseif ($password !== $confirmPassword) {
            $this->register_error = "Passwords do not match.";
            return false;
        } elseif (empty($role)) {
            $this->register_error = "Please select a role.";
            return false;
        }
        return true; //means all validations passed
    }

    public function registerUser($username, $email, $password, $confirmPassword, $role)
    {
        if ($this->userExists($username, $email)) {
            $this->register_error = "User already exists!";
            return false;
        }
        if (!$this->validateInputs($username, $email, $password, $confirmPassword, $role)) {
            return false;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        if ($role == "teacher") {
            $query = $this->conn->prepare("INSERT INTO user (username, email, password, user_role, status) VALUES (:username, :email, :password, :role, 'suspended')");
            $query->bindParam(":username", $username);
            $query->bindParam(":email", $email);
            $query->bindParam(":password", $hashedPassword);
            $query->bindParam(":role", $role);

            if ($query->execute()) {
                return true;
            } else {
                $this->register_error = "An error occurred during registration.";
                return false;
            }
        }else {
            $query = $this->conn->prepare("INSERT INTO user (username, email, password, user_role) VALUES (:username, :email, :password, :role)");
            $query->bindParam(":username", $username);
            $query->bindParam(":email", $email);
            $query->bindParam(":password", $hashedPassword);
            $query->bindParam(":role", $role);

            if ($query->execute()) {
                return true;
            } else {
                $this->register_error = "An error occurred during registration.";
                return false;
            }
        }
    }
}
?>