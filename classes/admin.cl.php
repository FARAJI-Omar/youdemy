<?php
require_once 'user.cl.php';
class admin extends user {
    protected $conn;

    public function __construct()
    {
        $db = new connection();
        $this->conn = $db->get_conn();
    }

    public function get_students()
    {
        $query = $this->conn->prepare("SELECT * FROM user WHERE user_role = 'student'");
        $query->execute();
        $students = $query->fetchAll();

        if (is_array($students) && !empty($students)) {
            echo "<div>";
            foreach ($students as $student) {
                if ($student['status'] == 'active') {
                    $buttonText = 'Suspend';
                    $status = 'active';
                } elseif ($student['status'] == 'suspended') {
                    $buttonText = 'Activate';
                    $status = 'suspended';
                }
                echo '<div class="student_user">
                            <div>
                                <p>' . $student['username'] . '</p>
                                <p>' . $student['email'] . '</p>
                            </div>
                            <div>
                                <a href="process/suspend_user.process.php?user_id=' . $student['user_id'] . '&status=' . $status . '" class="suspend_button">' . $buttonText . '</a>
                                <a href="process/delete_user.process.php?user_id=' . $student['user_id'] . '" class="delete_button">Delete</a>
                            </div>
                        </div>';
            }
            echo "</div>";
        } else {
            echo "<div>No students found</div>";
        }
    }

    public function get_teachers()
    {
        $query = $this->conn->prepare("SELECT * FROM user WHERE user_role = 'teacher'");
        $query->execute();
        $teachers = $query->fetchall();
        if (is_array($teachers) && !empty($teachers)) {
            echo "<div>";
            foreach ($teachers as $teacher) {
                if ($teacher['status'] == 'active') {
                    $buttonText = 'Suspend';
                    $status = 'active';
                } elseif ($teacher['status'] == 'suspended') {
                    $buttonText = 'Activate';
                    $status = 'suspended';
                }

                echo '<div class="teacher_user">
                            <div>
                                <p>' . $teacher['username'] . '</p>
                                <p>' . $teacher['email'] . '</p>
                            </div>
                            <div>
                                <a href="process/suspend_user.process.php?user_id=' . $teacher['user_id'] . '&status=' . $status . '" class="suspend_button">' . $buttonText . '</a>
                                <a href="process/delete_user.process.php?user_id=' . $teacher['user_id'] . '" class="delete_button">Delete</a>
                            </div>
                        </div>';
            }
            echo "</div>";
        } else {
            echo "<div>No teachers found</div>";
        }
    }

    public function activate_user($user_id)
    {
        $query = $this->conn->prepare("UPDATE user SET status = 'active' WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
    }

    public function delete_user($user_id)
    {
        $query = $this->conn->prepare("DELETE FROM user WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
    }

    public function suspend_user($user_id)
    {
        $query = $this->conn->prepare("UPDATE user SET status = 'suspended' WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
    }

    public function create_category($category)
    {
        $query = $this->conn->prepare("INSERT INTO category (category_name) VALUES (:category_name)");
        $query->bindParam(':category_name', $category);
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
                echo '<div class="category_tag_delete">
                        <span class="category_tag_d">' . htmlspecialchars($category['category_name']) . 
                        '<a href="process/delete_category.process.php?category_id=' . htmlspecialchars($category['category_id']) . '" id="delete_cat_btn">×</a>
                        </span>
                      </div>';
            }
            echo "</div>";
        } else {
            echo "<div>No categories found</div>";
        }
    }

    public function delete_category($category_id)
    {
        $query = $this->conn->prepare("DELETE FROM category WHERE category_id = :category_id");
        $query->bindParam(':category_id', $category_id);
        $query->execute();
    }

    //admin: get courses with a delete button
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

    public function create_tag($tag_name)
    {
        $query = $this->conn->prepare("INSERT INTO tag (tag_name) VALUES (:tag_name)");
        $query->bindParam(':tag_name', $tag_name);
        $query->execute();
    }  

    //admin: get tags with a delete button
    public function get_tags()
    {
        $query = $this->conn->prepare("SELECT * FROM tag ORDER BY tag_name ASC");
        $query->execute();
        $tags = $query->fetchAll();
        
        if (is_array($tags) && !empty($tags)) {
            echo "<div>";
            foreach ($tags as $tag) {
                echo '<div class="category_tag_delete">
                        <span class="category_tag_d">' . htmlspecialchars($tag['tag_name']) . 
                        '<a href="process/delete_tag.process.php?tag_id=' . htmlspecialchars($tag['tag_id']) . '" id="delete_tag_btn">×</a>
                        </span>
                      </div>';
            }
            echo "</div>";
        } else {
            echo "<div>No tags found</div>";
        }
    }

    public function delete_tag($tag_id)
    {
        $query = $this->conn->prepare("DELETE FROM tag WHERE tag_id = :tag_id");
        $query->bindParam(':tag_id', $tag_id);
        $query->execute();
    }
}

