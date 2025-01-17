<?php
require_once 'classes/db.php';
session_start();

class login extends connection
{
    public $login_error = "";

    public function login($email, $password)
    {
        $query = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $user = $query->fetch();

        if ($query->rowCount() > 0) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['user_role'] = $user['user_role'];
                $_SESSION["status"] = $user["status"];

                // if the user role is admin
                if ($user['user_role'] === 'admin') {
                    header('location: admin_dashboard.php');
                    exit();
                }elseif ($user['user_role'] === 'teacher') {
                    header('location: teacher_dashboard.php');
                    exit();
                }elseif ($user['user_role'] === 'student') {
                    header('location: student_dashboard.php');
                    exit();
                }
                else {
                    header('location: index.php');
                    exit();
                }
            } else {
                $this->login_error = "Invalid email or password!";
                return false;
            }
        } else {
            $this->login_error = "Invalid email or password!";
            return false;
        }
    }

    public function get_username()
    {
        $stmt = "SELECT username from user where user_id = :user_id";
        $query = $this->conn->prepare($stmt);
        $query->bindParam(":user_id", $_SESSION["user_id"]);
        $query->execute();
        $user = $query->fetch();
        echo $user;
    }
}
?>