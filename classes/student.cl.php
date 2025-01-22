<?php
require_once 'user.cl.php';

class student extends user
{
    private $db;
    protected $conn;
    public $page;
    public $limit;

    public function __construct($page = 1, $limit = 6)
    {
        $this->db = new connection();
        $this->conn = $this->db->get_conn();
        $this->page = $page;
        $this->limit = $limit;
    }

    //student: get courses with a enroll button
    public function get_courses($page = 1, $limit = 6)
    {
        $query = $this->conn->prepare("
            SELECT course.*, GROUP_CONCAT(tag.tag_name) AS tags
            FROM course
            LEFT JOIN course_tag ON course.course_id = course_tag.course_id
            LEFT JOIN tag ON course_tag.tag_id = tag.tag_id
            GROUP BY course.course_id
        ");
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
                echo "<a href='process/enroll_course.process.php?course_id=" . $course['course_id'] . "' class='enroll-btn'>Enroll</a>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "<div class='no-courses'>No courses found</div>";
        }
    }


    public function add_course($course_id, $user_id)
    {
        //add course to student's my courses
        $query = $this->conn->prepare("INSERT INTO course_student (user_id, course_id) VALUES (:user_id, :course_id)");
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':course_id', $course_id);
        $query->execute();
    }

    public function get_my_courses($user_id)
    {
        $query = $this->conn->prepare("SELECT course.*, GROUP_CONCAT(tag.tag_name) AS tags
        FROM course
        LEFT JOIN course_tag ON course.course_id = course_tag.course_id
        LEFT JOIN tag ON course_tag.tag_id = tag.tag_id
        WHERE course.course_id IN (SELECT course_id FROM course_student WHERE user_id = :user_id)
        GROUP BY course.course_id ORDER BY course.created_at DESC");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        $my_courses = $query->fetchAll();

        if (is_array($my_courses) && !empty($my_courses)) {
            foreach ($my_courses as $my_course) {
                echo "<div class='course_card'>";
                echo "<img src='" . $my_course['course_image'] . "'>";
                echo "<h3>" . htmlspecialchars($my_course['title']) . "</h3>";
                echo "<h5>" . '👤' . htmlspecialchars($my_course['username']) . "</h5>";
                echo "<p class='category'>" . '<strong>Category:</strong> ' . htmlspecialchars($my_course['category_name']) . "</p>";
                echo "<p class='description'>" . htmlspecialchars(substr($my_course['description'], 0, 120)) . " ...</p>";
                echo "<div class='tags'>";
                $tags = explode(',', $my_course['tags']);
                foreach ($tags as $tag) {
                    echo "<p>#" . htmlspecialchars($tag) . "</p>";
                }
                echo "</div>";
                echo "<a class='readmore' href='course_details.php?course_id=" . $my_course['course_id'] . "'>Read More →</a>";
                echo "<a class='view_content' href='course_content.php?course_id=" . $my_course['course_id'] . "'>View Content</a>";
                echo "</div>";
            }
        } else {
            echo "<div class='no-courses'>No courses found</div>";
        }
    }

    public function get_course_content($course_id)
    {
        $query = $this->conn->prepare("SELECT * FROM course WHERE course_id = :course_id");
        $query->bindParam(':course_id', $course_id);
        $query->execute();
        $content = $query->fetch();
        return $content;
    }
}
