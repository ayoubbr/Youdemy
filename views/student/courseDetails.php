<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap');

        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #059669;
            --danger: #dc2626;
            --warning: #d97706;
            --background: #f9fafb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto Slab", 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--background);
            color: var(--text-primary);
            line-height: 1.5;
            padding: 30px 120px;
        }

        .main-content {
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Course Header Section */
        .course-header {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .course-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(to right, var(--primary), #818cf8);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .course-meta {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
        }

        .meta-item i {
            color: var(--primary);
        }

        .course-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .tag {
            background: #e0e7ff;
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Course Content Grid */
        .course-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        @media (max-width: 1024px) {
            .course-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Course Description Section */
        .course-description {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--text-primary);
        }

        .description-content {
            color: var(--text-secondary);
            line-height: 1.7;
        }

        /* Course Curriculum */
        .curriculum-section {
            margin-top: 2rem;
        }

        .module {
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .module-header {
            padding: 1rem 1.5rem;
            background: #f8fafc;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .module-header h3 {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .module-content {
            display: none;
            padding: 1.5rem;
            border-top: 1px solid var(--border);
        }

        .module.active .module-content {
            display: block;
        }

        .lesson-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            color: var(--text-secondary);
        }

        .lesson-item i {
            color: var(--primary);
        }

        /* Course Sidebar */
        .course-sidebar {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 2rem;
        }

        .price-tag {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .enroll-button, .enrolled-button {
            width: 100%;
            background: var(--primary);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 0.75rem;
            font-weight: 600;
            font-size: 1.125rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .enrolled-button{
            background-color: #059669;
            cursor: default;
        }

        .enroll-button:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(79, 70, 229, 0.1);
        }

        .course-features {
            margin-top: 2rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.75rem 0;
            color: var(--text-secondary);
        }

        .feature-item i {
            color: var(--success);
        }

        /* Instructor Section */
        .instructor-section {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            margin-top: 2rem;
        }

        .instructor-info {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .instructor-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
        }

        .instructor-details h4 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .instructor-bio {
            color: var(--text-secondary);
            margin-top: 1rem;
        }

        /* Progress Bar */
        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            margin: 1rem 0;
            overflow: hidden;
        }

        .progress {
            width: 0%;
            height: 100%;
            background: var(--primary);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        /* Reviews Section */
        .reviews-section {
            margin-top: 2rem;
        }

        .review-card {
            border: 1px solid var(--border);
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .reviewer-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .rating {
            color: #fbbf24;
        }

        .review-date {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="main-content">
        <div class="course-header">
            <h1 class="course-title"><?= $course->getTitle(); ?></h1>
            <div class="course-meta">
                <div class="meta-item">
                    <i class="fas fa-user-graduate"></i>
                    <span><?= count($course->getStudents()); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-star"></i>
                    <span><?= $course->getRating(); ?></span>
                </div>
            </div>
            <div class="course-tags">
                <?php
                if (!is_null($course->getTags())) {

                    $tags = explode(', ', $course->getTags());
                    foreach ($tags as $key => $value) {
                ?>
                        <span class="tag"><?= $value; ?></span>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <!-- Course Content Grid -->
        <div class="course-grid">
            <div class="course-main">
                <div class="course-description">
                    <h2 class="section-title">Course Description</h2>
                    <div class="description-content">
                        <p><?php echo $course->getDescription(); ?></p>
                        <div class="progress-bar">
                            <div class="progress" style="width: 100%;"></div>
                        </div>
                    </div>
                </div>

                <div class="curriculum-section">
                    <h2 class="section-title">Course Content</h2>
                    <div class="module active">
                        <div class="module-header">
                            <h3><?php echo $course->getTitle(); ?></h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="module-content">
                            <!-- TODO  create course with content-->
                            <div class="lesson-item">
                                <i class="fas fa-play-circle"></i>
                                <a href="<?php echo $course->getTitle(); ?>">Click here to see course. </a>
                            </div>
                            <div class="lesson-item">
                                <i class="fas fa-file-alt"></i>
                                <a href="<?php echo $course->getTitle(); ?>">Click here to see course. </a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="instructor-section">
                    <h2 class="section-title">Your Instructor</h2>
                    <div class="instructor-info">
                        <img src="<?php echo $course->getTeacher()->getPhoto(); ?>" alt="Instructor" class="instructor-avatar">
                        <div class="instructor-details">
                            <h4><?php echo $course->getTeacher()->getFirstname() . ' ' . $course->getTeacher()->getLastname(); ?></h4>
                            <p><?php echo $course->getTeacher()->getEmail(); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="course-sidebar">
                <div class="price-tag">$<?php echo $course->getPrice(); ?></div>
                <?php
                // var_dump($subscriptions);
                // var_dump($course);
                $isSubs = false;
                foreach ($subscriptions as $key => $subscription) {
                    if ($course->getId() == $subscription->getId()) {
                        $isSubs = true;
                        break;
                    }
                }
                if ($isSubs) {
               
               ?>

                    <span class="enrolled-button">Subscribed</span>
               
               <?php

                } else {

                ?>
                    <form action="/student/course/subscribe" method="post" class="enroll-form">
                        <input type="hidden" name="course_id" value="<?php echo $course->getId(); ?>">
                        <button class="enroll-button">Subscribe Now</button>
                    </form>

                <?php
                }
                ?>





                <div class="course-features">
                    <div class="feature-item">
                        <i class="fas fa-video"></i>
                        <span>24 hours on-demand video</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-infinity"></i>
                        <span>Full lifetime access</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-mobile-alt"></i>
                        <span>Access on mobile and TV</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-certificate"></i>
                        <span>Certificate of completion</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.module-header').forEach(header => {
            header.addEventListener('click', () => {
                const module = header.parentElement;
                module.classList.toggle('active');

                const icon = header.querySelector('i');
                if (module.classList.contains('active')) {
                    icon.classList.replace('fa-chevron-down', 'fa-chevron-up');
                } else {
                    icon.classList.replace('fa-chevron-up', 'fa-chevron-down');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const progress = document.querySelector('.progress');
            progress.style.width = '100%';
        });
        const enrollButton = document.querySelector('.enroll-button');


        enrollButton.addEventListener('click', () => {
            enrollButton.textContent = 'Enrolling...';
            enrollButton.style.opacity = '0.8';
        });


        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;

            const style = document.createElement('style');
            style.textContent = `
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background: var(--success);
                color: white;
                padding: 1rem 2rem;
                border-radius: 0.75rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                animation: slideIn 0.3s ease-out forwards;
            }

            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
        `;
            document.head.appendChild(style);

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease-in forwards';
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }
    </script>
</body>

</html>