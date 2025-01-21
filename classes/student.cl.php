<?php
require_once 'user.cl.php';

class student extends user
{
    public function __construct()
    {
        $db = new connection();
        $this->conn = $db->get_conn();
    }

    //student: get courses with a enroll button
    public function get_courses()
    {
        $query = $this->conn->prepare("
             SELECT course.*, GROUP_CONCAT(tag.tag_name) AS tags
             FROM course
             LEFT JOIN course_tag ON course.course_id = course_tag.course_id
             LEFT JOIN tag ON course_tag.tag_id = tag.tag_id
             GROUP BY course.course_id ORDER BY course.created_at DESC");
        $query->execute();
        $courses = $query->fetchAll(PDO::FETCH_ASSOC);

        if (is_array($courses) && !empty($courses)) {
            foreach ($courses as $course) {
                echo "<div class='course_card'>";
                echo "<img src='" . $course['course_image'] . "'>";
                echo "<h3>" . htmlspecialchars($course['title']) . "</h3>";
                echo "<h5>".'👤' . htmlspecialchars($course['username']) . "</h5>";
                echo "<p class='category'>" .'<strong>Category:</strong> ' . htmlspecialchars($course['category_name']) . "</p>";
                echo "<p class='description'>" . htmlspecialchars(substr($course['description'], 0, 120)) . " ...</p>";
                echo "<div class='tags'>";
                $tags = explode(',', $course['tags']);
                foreach ($tags as $tag) {
                    echo "<p>#" . htmlspecialchars($tag) . "</p>";
                }
                echo "</div>";
                echo "<a class='readmore' href='course_details.php?course_id=" . $course['course_id'] . "'>Read More →</a>";
                echo "<div class='enroll'>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<div class='no-courses'>No courses found</div>";
        }
    }

    public function add_course($course_id, $user_id){
        //add course to student's my courses
        $query = $this->conn->prepare("INSERT INTO course_student (user_id, course_id) VALUES (:user_id, :course_id)");
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':course_id', $course_id);
        $query->execute();
    }
}
?>