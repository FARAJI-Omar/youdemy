<?php
require_once 'db.php';
require_once 'course.cl.php';

class admin_get_courses extends course
{
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
}
