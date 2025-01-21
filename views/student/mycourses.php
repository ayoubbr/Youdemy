<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Enrolled Courses</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .page-title {
            font-size: 2.25rem;
            font-weight: 700;
            margin-bottom: 2rem;
            background: linear-gradient(to right, var(--primary), #818cf8);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .course-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .course-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .course-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .course-meta {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
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

        .progress-section {
            margin: 1.5rem 0;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .progress-text {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: var(--primary);
            border-radius: 4px;
            transition: width 0.3s ease;
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

        .continue-btn {
            background: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .continue-btn:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .course-meta {
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="main-content">
        <h1 class="page-title">My Enrolled Courses</h1>
        <div id="courses-container">
            <?php

            use App\Controllers\UserController;

            foreach ($subscriptions as $key => $value) {
            ?>
                <div class="course-card">
                    <div class="course-header">
                        <div>
                            <h2 class="course-title"><?php echo $value->getTitle(); ?></h2>
                            <div class="course-meta">
                                <div class="meta-item">
                                    <i class="fas fa-user"></i>
                                    <span>
                                        <?php
                                        $userC = new UserController();
                                        $teacher = $userC->findById($value->teacher_id);
                                        echo $teacher->getFirstname() . " " . $teacher->getLastname();
                                        ?>
                                    </span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-clock"></i>
                                    <span>duration</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>Last accessed</span>
                                </div>
                            </div>
                        </div>
                        <button class="continue-btn">Continue Learning</button>
                    </div>

                    <div class="progress-section">
                        <div class="progress-header">
                            <span class="progress-text">Your Progress</span>
                        </div>
                        <div class="progress-bar">
                        </div>
                    </div>

                    <div class="course-tags">
                        <?php
                        if (!is_null($value->getTags())) {
                            $tags = $value->getTags();

                            foreach ($tags as  $tag) {
                        ?>
                                <span class="tag"><?php echo $tag->getTitle(); ?></span>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>