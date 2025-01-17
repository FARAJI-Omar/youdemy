<?php
require_once 'db.php';

class course extends connection
{
    public function get_courses()
    {
        $query = $this->conn->prepare("SELECT * FROM course");
        $query->execute();
        $courses = $query->fetchAll();

        if(is_array($courses) && !empty($courses)){
            echo "<div>";
            foreach($courses as $course){
                echo "<div class='course_card'>";
                echo "<h3>".$course['title']."</h3>";
                echo "<p>".$course['description']."</p>";
                echo "<img src='".$course['image']."'>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<div>No courses found</div>";
        }
    }

    public function delete_course($course_id)
    {
        $query = $this->conn->prepare("DELETE FROM course WHERE course_id = :course_id");
        $query->bindParam(':course_id', $course_id);
        $query->execute();
    }
}
?>