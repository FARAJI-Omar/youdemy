<?php
require_once 'classes/user.cl.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YOUDEMY</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <main>
        <?php include 'header.php'; ?>

        <div class="hero-content">
            <div class="hero-text">
                <h1>Unlock Your Potential with Online Learning</h1>
                <p>Join our community of learners and instructors. Whether you want to learn or teach, our platform provides the tools and resources you need to succeed in today's digital world.</p>
                <div class="hero-buttons">
                    <a href="login.php" class="btn-start">Get Started</a>
                    <a href="#" class="btn-view">→ Browse Courses</a>
                </div>
            </div>
            <div class="hero-image">
                <div class="image_main" style="width: 400px; height: 300px;"><img src="img/learning.jpg" style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;"></div>
            </div>
        </div>
    </main>

    <div class="tech_icons">
        <img src="img/icons.png" alt="">
    </div>

    <div class="student_review">
        <div class="review-container">
            <div class="review-image">
                <img src="img/student_review.png" alt="Student">
            </div>
            <div class="review-content">
                <p class="review-text">"This platform has transformed my learning journey. The courses are well-structured and the instructors are amazing!"</p>
                <div class="reviewer-name">- Sarah Johnson, Web Development Student</div>
            </div>
        </div>
    </div>

    <div class="recomended_courses">
        <div class="courses-container">
            <div class="course-card">
                <div class="course-image">
                    <img src="img/online-programming-course-01.jpg" alt="HTML Course">
                </div>
                <div class="course-content">
                    <span class="course-category">FRONT END</span>
                    <h3>HTML 5 Web Component Fundamentals</h3>
                    <div class="course-meta">
                        <div class="level">
                            <span class="level-icon">👤</span>
                            <span>Teacher name</span>
                        </div>
                        <div class="read_more">
                            <a href="">read more →</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-card">
                <div class="course-image">
                    <img src="img/online-programming-course-01.jpg" alt="CSS Course">
                </div>
                <div class="course-content">
                    <span class="course-category">FRONT END</span>
                    <h3>Mastering CSS 3 Flexbox With Real World Projects</h3>
                    <div class="course-meta">
                        <div class="level">
                            <span class="level-icon">👤</span>
                            <span>Teacher name</span>
                        </div>
                        <div class="read_more">
                            <a href="">read more →</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-card">
                <div class="course-image">
                    <img src="img/online-programming-course-01.jpg" alt="React Course">
                </div>
                <div class="course-content">
                    <span class="course-category">FRONT END</span>
                    <h3>Full Stack Web Development with React Hooks and Redux</h3>
                    <div class="course-meta">
                        <div class="level">
                            <span class="level-icon">👤</span>
                            <span>Teacher name</span>
                        </div>
                        <div class="read_more">
                            <a href="">read more →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="before_footer">
        <div class="before_footer_content">
            <h1>Join the community of learners and instructors</h1>
            <p>Start your journey to success today with our platform. Whether you want to learn or teach, we have the resources and support you need to thrive in today's digital world.</p>
        </div>
        <div class="join_now">
            <a href="login.php">join now</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>