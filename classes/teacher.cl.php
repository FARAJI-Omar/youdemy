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

    public function add_course($title, $description, $category, $tags, $username, $video_content, $text_content)
    {
        $this->conn->beginTransaction();

            $query = $this->conn->prepare("INSERT INTO course (title, description, category_name, username, video_content, text_content) VALUES (:title, :description, :category, :username, :video_content, :text_content)");
            $query->bindParam(':title', $title);
            $query->bindParam(':description', $description);
            $query->bindParam(':category', $category);
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
}
