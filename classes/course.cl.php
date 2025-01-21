<?php
require_once 'db.php';

class course{
    private $db;
    protected $conn;

    function __construct(){
        $this->db = new connection();
        $this->conn = $this->db->get_conn();
    }

    public function get_course_details($course_id){
        $query = $this->conn->prepare(" SELECT course.*, GROUP_CONCAT(tag.tag_name) AS tags
             FROM course
             LEFT JOIN course_tag ON course.course_id = course_tag.course_id
             LEFT JOIN tag ON course_tag.tag_id = tag.tag_id WHERE course.course_id = :course_id
             GROUP BY course.course_id");
        $query->bindParam(':course_id', $course_id);
        $query->execute();
        $details = $query->fetchall();

        foreach($details as $detail){
            echo "<div class='course_image'><img src='" . $detail['course_image'] . "'> </div>";
            echo "<h1 class='course_title'>" . $detail['title'] . "</h1>";
            echo "<div class='details'>";
                echo "<h3 class='description'>Course description:</h3>";
                echo "<p class='course_description'>". $detail['description'] . "</p>";
                echo "<p class='created_at'>Created at: " . $detail['created_at'] . "</p>";
                echo "<h3 class='category'>Category: <p class='category_name'>" . $detail['category_name'] . "</p></h3>";
                echo "<h3 class='tags_title'>Tags:</h3>";
                echo "<div class='tags'>";
                    $tags = explode(',', $detail['tags']);
                        foreach ($tags as $tag) {
                            echo "<p class='tag'>#" . htmlspecialchars($tag) . "</p>";
                        }
                echo "</div>";
                if($this->check_enrollment($detail['course_id'], $_SESSION['user_id'])){
                    echo "<a class='enroll_btn'>Already enrolled</a>";
                }else{
                    echo "<a href='process/enroll_course.process.php?course_id=" . $detail['course_id'] . "' class='enroll_btn'>Enroll in this course</a>";
                }
                echo "</div>";
        }
    
    }

    //checj if student has enrolled in this course
    public function check_enrollment($course_id, $user_id){
        $query = $this->conn->prepare("SELECT * FROM course_student WHERE course_id = :course_id AND user_id = :user_id");
        $query->bindParam(':course_id', $course_id);
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        $result = $query->fetchall();
        return $result;
    }
}
?>