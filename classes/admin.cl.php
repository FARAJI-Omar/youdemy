<?php
require_once 'db.php';

class admin extends connection
{
    public function get_students()
    {
        $query = $this->conn->prepare("SELECT * FROM user WHERE user_role = 'student'");
        $query->execute();
        $students = $query->fetchAll();

        if (is_array($students) && !empty($students)) {
            echo "<div>";
            foreach ($students as $student) {
                echo '<div class="student_user">
                            <div>
                                <p>' . $student['username'] . '</p>
                                <p>' . $student['email'] . '</p>
                            </div>
                            <div>
                                <a href="process/suspend_user.process.php?user_id=' . $student['user_id'] . '" class="suspend_button">Suspend</a>
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
                    $buttonText = 'Desactivate';
                    $status = 'active';
                } else {
                    $buttonText = 'Activate';
                    $status = 'pending';
                }
                echo '<div class="teacher_user">
                            <div>
                                <p>' . $teacher['username'] . '</p>
                                <p>' . $teacher['email'] . '</p>
                            </div>
                            <div>
                                <a href="process/activate_teacher.process.php?user_id=' . $teacher['user_id'] . '&status=' . $status . '" class="activate_button">' . $buttonText . '</a>  
                                <a href="process/suspend_user.process.php?user_id=' . $teacher['user_id'] . '" class="suspend_button">Suspend</a>
                                <a href="process/delete_user.process.php?user_id=' . $teacher['user_id'] . '" class="delete_button">Delete</a>
                            </div>
                        </div>';
            }
            echo "</div>";
        } else {
            echo "<div>No teachers found</div>";
        }
    }

    public function activate_teacher($user_id)
    {
        $query = $this->conn->prepare("UPDATE user SET status = 'active' WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
    }
    public function deactivate_teacher($user_id)
    {
        $query = $this->conn->prepare("UPDATE user SET status = 'pending' WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
    }

    public function delete_user($user_id)
    {
        $query = $this->conn->prepare("DELETE FROM user WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        $query->execute();
      
    }
    public function suspend_user($user_id)
    {
        $query = $this->conn->prepare("UPDATE user SET status = 'suspended' WHERE user_id = :user_id");
        $query->bindParam(':user_id', $user_id);
        $query->execute();
        if ($query->execute()) {
            return "admin_dashboard.php";
        } else {
            return "admin_dashboard.php";
        }
    }
}
