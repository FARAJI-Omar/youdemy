<?php
require_once 'user.cl.php';

class Teacher extends User
{
    public function __construct()
    {
        $db = new connection();
        $this->conn = $db->get_conn();
    }

    public function get_categories()
    {
        $query = $this->conn->prepare("SELECT * FROM category ORDER BY category_name ASC");
        $query->execute();
        $categories = $query->fetchAll();

        if (is_array($categories) && !empty($categories)) {
            foreach ($categories as $category) {
                echo '<option value="' . $category['category_name'] . '">' . htmlspecialchars($category['category_name']) . '</option>';
            }
        }
    }

    public function get_tags()
    {
        $query = $this->conn->prepare("SELECT * FROM tag ORDER BY tag_name ASC");
        $query->execute();
        $tags = $query->fetchAll();

        foreach ($tags as $tag) {
            echo '<option value="' . htmlspecialchars($tag['tag_id']) . '" >' . htmlspecialchars($tag['tag_name']) . '</option>';
        }
    }

    public function add_course($title, $description, $category, $image, $tags, $username, $video_content, $text_content)
    {
        $this->conn->beginTransaction();

        $query = $this->conn->prepare("INSERT INTO course (title, description, category_name, course_image, username, video_content, text_content) 
                                        VALUES (:title, :description, :category, :image, :username, :video_content, :text_content)");
        $query->bindParam(':title', $title);
        $query->bindParam(':description', $description);
        $query->bindParam(':category', $category);
        $query->bindParam(':image', $image);
        $query->bindParam(':username', $username);
        $query->bindParam(':video_content', $video_content);
        $query->bindParam(':text_content', $text_content);
        $query->execute();

        $courseId = $this->conn->lastInsertId();

        foreach ($tags as $tag) {
            $tagQuery = $this->conn->prepare("INSERT INTO course_tag (course_id, tag_id) VALUES (:course_id, :tag_id)");
            $tagQuery->bindParam(':course_id', $courseId);
            $tagQuery->bindParam(':tag_id', $tag);
            $tagQuery->execute();
        }
        $this->conn->commit();
    }

    public function get_courses($page = 1, $limit = 6)
    {
        // Start a transaction
        $this->conn->beginTransaction();
    
        // Step 1: Get teacher's username from the session
        $query = $this->conn->prepare("SELECT username FROM user WHERE user_id = :user_id");
        $query->bindParam(':user_id', $_SESSION['user_id']);
        $query->execute();
        $teacher = $query->fetch();
        $teacher = $teacher['username'];
    
        // Step 2: Get courses for the teacher
        $query = $this->conn->prepare("SELECT * FROM course WHERE username = :teacher");
        $query->bindParam(':teacher', $teacher);
        $query->execute();
        $courses = $query->fetchAll();
    
        // Initialize table output if courses exist
        if (is_array($courses) && !empty($courses)) {
            echo "<table class='courses-table'>";
            echo "<thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Enrolled Students</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>";
    
            foreach ($courses as $course) {
                // Step 3: Get enrolled students for the current course
                $query = $this->conn->prepare("
                    SELECT user.username 
                    FROM course_student
                    JOIN user ON course_student.user_id = user.user_id
                    WHERE course_student.course_id = :course_id
                ");
                $query->bindParam(':course_id', $course['course_id']);
                $query->execute();
                $students = $query->fetchAll();
    
                // Render course row
                echo "<tr>";
                echo "<div class='course-row'>";
                echo "<td>" . htmlspecialchars($course['title']) . " <br><br> <p style='font-size:10px;'>" . htmlspecialchars($course['created_at']) . "</p></td>";
                echo "</div>";
                echo "<td><img src='" . htmlspecialchars($course['course_image']) . "' alt='Course Image' style='width:100%; height:90px;'></td>";
                echo "<td>" . htmlspecialchars($course['description']) . "</td>";
                echo "<td>" . htmlspecialchars($course['category_name']) . "</td>";
                echo "<td>";
                if (!empty($students)) {
                    echo "<ul>";
                    foreach ($students as $student) {
                        echo "<li>" . htmlspecialchars($student['username']) . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "No students enrolled";
                }
                echo "</td>";
                echo "<td>
                        <div class='course_actions'>
                            <a href='process/delete_course.process.php?course_id=" . htmlspecialchars($course['course_id']) . "' class='delete-btn'>Delete</a>
                            <a href='teacher_edit_course.php?course_id=" . htmlspecialchars($course['course_id']) . "' class='edit-btn'>Edit</a>
                        </div>
                      </td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='no-courses'>No courses found</div>";
        }
    
        // Commit transaction
        $this->conn->commit();
    }
    

    public function edit_course($course_id, $title, $description, $category, $image, $tags, $username, $video_content, $text_content)
    {
        $this->conn->beginTransaction();

        $query = $this->conn->prepare("UPDATE course SET title = :title, description = :description, category_name = :category, course_image = :image, username = :username, video_content = :video_content, text_content = :text_content WHERE course_id = :course_id");
        $query->bindParam(':title', $title);
        $query->bindParam(':description', $description);
        $query->bindParam(':category', $category);
        $query->bindParam(':image', $image);
        $query->bindParam(':username', $username);
        $query->bindParam(':video_content', $video_content);
        $query->bindParam(':text_content', $text_content);
        $query->bindParam(':course_id', $course_id);
        $query->execute();

        foreach ($tags as $tag) {
            $query = $this->conn->prepare("UPDATE course_tag SET tag_id = :tag_id WHERE course_id = :course_id");
            $query->bindParam(':tag_id', $tag);
            $query->bindParam(':course_id', $course_id);
            $query->execute();
        }

        $this->conn->commit();
    }

    public function get_course_title($course_id)
    {
        $stmt = "SELECT title from course where course_id = :course_id";
        $query = $this->conn->prepare($stmt);
        $query->bindParam(":course_id", $course_id);
        $query->execute();
        $course = $query->fetch();
        echo $course['title'];
    }
}
