<?php
require_once 'db.php';
session_start();
class user {
    private $db;
    protected $conn;

    public function __construct()
    {
        $this->db = new connection();
        $this->conn = $this->db->get_conn();
    }

    // Register
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

    // Login
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
                } elseif ($user['user_role'] === 'teacher') {
                    header('location: teacher_dashboard.php');
                    exit();
                } elseif ($user['user_role'] === 'student') {
                    header('location: student_dashboard.php');
                    exit();
                } else {
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

    public function get_courses()
    {
        $query = $this->conn->prepare("SELECT * FROM course");
        $query->execute();
        $courses = $query->fetchAll();

        if (is_array($courses) && !empty($courses)) {
            echo "<div class='courses-box'>";
            foreach ($courses as $course) {
                echo "<div class='course_card'>";
                echo "<h3>" . $course['title'] . "</h3>";
                echo "<p>By: " . $course['username'] . "</p>";
                echo "<img src='" . $course['course_image'] . "'>";
                echo "<div class='course-actions'>";
                echo "<a href='process/delete_course.process.php?course_id=" . $course['course_id'] . "' class='delete-btn'>Delete</a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<div class='no-courses'>No courses found</div>";
        }
    }

    public function delete_course($course_id)
    {
        $query = $this->conn->prepare("DELETE FROM course WHERE course_id = :course_id");
        $query->bindParam(':course_id', $course_id);
        $query->execute();
    }

    public function get_categories()
    {
        $query = $this->conn->prepare("SELECT * FROM category ORDER BY category_name ASC");
        $query->execute();
        $categories = $query->fetchAll();
        
        if (is_array($categories) && !empty($categories)) {
            echo "<div>";
            foreach ($categories as $category) {
                echo '<div class="user_get_categories">
                        <span class="user_category">' . htmlspecialchars($category['category_name']) . '</span>
                      </div>';
            }
            echo "</div>";
        }
    }

}
?>