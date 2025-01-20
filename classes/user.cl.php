<?php
require_once 'db.php';
class user {
    private $db;
    protected $conn;

    public function __construct()
    {
        $this->db = new connection();
        $this->conn = $this->db->get_conn();
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