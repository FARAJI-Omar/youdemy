<?php
require_once 'db.php';
session_start();
class user
{
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
        } else {
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

    public function login($email, $password)
    {
        $query = $this->conn->prepare("SELECT * FROM user WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $user = $query->fetch();

        //check if user exists
        if ($user) {
            //verify the password
            if (password_verify($password, $user['password'])) {
                //check user status
                if ($user['status'] === 'suspended') {
                    //redirect to suspended page
                    header("Location: suspended_page.php");
                    exit();
                } elseif ($user['status'] === 'active') {
                    //set session variables and log in the user
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_role'] = $user['user_role'];
                    $_SESSION["status"] = $user["status"];
                    //redirect to the admin/teacher/student dashboard
                    if ($user['user_role'] === 'admin') {
                        header("Location: admin_dashboard.php");
                    } elseif ($user['user_role'] === 'teacher') {
                        header("Location: teacher_dashboard.php");
                    } elseif ($user['user_role'] === 'student') {
                        header("Location: student_dashboard.php");
                    }
                }
            } else {
                return "Invalid email or password!";
            }
        } else {
            return "Invalid email or password!";
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

    public function get_courses($page = 1, $limit = 6)
    {
        $offset = ($page - 1) * $limit; // Calculate the offset for the SQL query

        $query = $this->conn->prepare("
            SELECT course.*, GROUP_CONCAT(tag.tag_name) AS tags
            FROM course
            LEFT JOIN course_tag ON course.course_id = course_tag.course_id
            LEFT JOIN tag ON course_tag.tag_id = tag.tag_id
            GROUP BY course.course_id
            LIMIT :limit OFFSET :offset
        ");

        // Bind parameters as integers
        $query->bindParam(':limit', $limit, PDO::PARAM_INT);
        $query->bindParam(':offset', $offset, PDO::PARAM_INT);
        $query->execute();
        $courses = $query->fetchAll();

        if (is_array($courses) && !empty($courses)) {
            echo "<div class='courses-box'>";
            foreach ($courses as $course) {
                echo "<div class='course_card'>";
                echo "<h3>" . htmlspecialchars($course['title']) . "</h3>";
                echo "<h5>" . 'By: ' . htmlspecialchars($course['username']) . "</h5>";
                echo "<p>" . 'Category: ' . htmlspecialchars($course['category_name']) . "</p>";
                echo "<img src='" . htmlspecialchars($course['course_image']) . "'>";
                echo "<p><strong>Tags:</strong> " . htmlspecialchars($course['tags'] ? $course['tags'] : 'No tags') . "</p>";
                echo "<p>" . htmlspecialchars(substr($course['description'], 0, 200)) . "...</p>";
                echo "<div class='course-actions'>";
                echo "<a href='course_details.php?course_id=" . $course['course_id'] . "' class='readmore'>Read more ⇨</a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<div class='no-courses'>No courses found</div>";
        }
    }

    public function get_total_courses()
    {
        $query = $this->conn->prepare("SELECT COUNT(*) FROM course");
        $query->execute();
        return $query->fetchColumn();
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
