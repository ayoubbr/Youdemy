<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Catalog | E-Learning Platform</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap');

        :root {
            /* Primary Colors */
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;

            /* Secondary Colors */
            --secondary-color: #06b6d4;
            --secondary-dark: #0891b2;
            --secondary-light: #22d3ee;


            --accent-purple: #8b5cf6;
            --accent-pink: #ec4899;
            --accent-orange: #f97316;

            /* Background Gradients */
            --bg-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            --card-gradient: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.9));

            /* Neutral Colors */
            --background-color: #f8fafc;
            --text-color: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;

            /* Shadows */
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto Slab", 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .header {
            background: var(--bg-gradient);
            padding: 2rem;
            color: var(--white);
            text-align: center;
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .search-container {
            max-width: 600px;
            margin: -1.5rem auto 2rem;
            padding: 0 1rem;
        }

        .search-box {
            display: flex;
            background: var(--white);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .search-box input {
            flex: 1;
            padding: 1rem;
            border: none;
            outline: none;
            font-size: 1rem;
        }

        .search-box button {
            padding: 1rem 1.5rem;
            background: var(--primary-color);
            color: var(--white);
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .search-box button:hover {
            background: var(--primary-dark);
        }

        .filters {
            padding: 1rem 2rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: 2px solid var(--primary-color);
            border-radius: 20px;
            background: transparent;
            color: var(--primary-color);
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color);
            color: var(--white);
        }

        .courses-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .course-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .course-image {
            width: 100%;
            height: 200px;
            background: var(--bg-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .course-content {
            padding: 1.5rem;
        }

        .course-category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: var(--primary-light);
            color: var(--white);
            border-radius: 20px;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .course-title {
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .course-description {
            color: var(--text-light);
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .course-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .course-rating {
            color: #fbbf24;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .course-price {
            font-weight: 600;
            color: var(--primary-color);
        }

        .course-tags {
            padding: 15px 15px 5px 15px;
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 5px;
            font-size: 12px;
        }

        .course-tags span {
            border-radius: 10px;
            background-color: #bbc2cb;
            color: black;
            width: 60px;
            height: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .course-details {
            text-decoration: none;
            background-color: #4f46e5;
            padding: 10px 20px;
            border-radius: 10px;
            color: white;
            border: none;
            cursor: pointer;
        }

        .course-details:hover {
            background-color: #1e293b;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 10px;
        }

        .btn {
            padding: 0.75rem 1.75rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            font-size: 1rem;
        }

        .btn-outline {
            background: var(--white);
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            text-decoration: none;
        }

        .btn-outline.orange {
            background: var(--accent-orange);
            border-color: var(--accent-orange);
            color: var(--white);
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 2rem;
            }

            .courses-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <h1>Explore Our Courses</h1>
        <p>Discover your next learning adventure</p>
        <div class="auth-buttons">
            <?php
            if (isset($_SESSION['user'])) {
            ?>
                <a href="/auth/logout" class="btn btn-outline">Logout</a>
            <?php
            } else {
            ?>
                <a href="/login" class="btn btn-outline">Log In</a>
                <a href="/signup" class="btn btn-primary">Sign Up</a>
            <?php
            }
            ?>
            <a href="/" class="btn btn-outline orange">Home</a>
        </div>
    </header>

    <div class="search-container">
        <div class="search-box">
            <input type="text" placeholder="Search for courses...">
            <button>
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="filters">
        <button class="filter-btn active">All</button>
        <?php
        foreach ($categories as $key => $value) {
        ?>
            <button class="filter-btn"><?= $value->getTitle(); ?></button>
        <?php
        }
        ?>
    </div>

    <div class="courses-grid">
        <?php
        foreach ($courses as $key => $value) {
        ?>
            <div class="course-card">
                <!-- <div class="course-image">
                    <img src="/api/placeholder/300/200" alt="Course thumbnail">
                </div> -->
                <div class="course-content">
                    <span class="course-category"><?php echo $value->getCategory()->getTitle(); ?></span>
                    <h3 class="course-title"><?php echo $value->getTitle(); ?></h3>
                    <p class="course-description"><?php echo $value->getDescription(); ?></p>
                    <div class="course-meta">
                        <div class="course-rating">
                            <i class="fas fa-star"></i>
                            <span><?php echo $value->getRating(); ?></span>
                        </div>
                        <div class="course-price">$<?php echo $value->getPrice(); ?></div>
                    </div>
                    <div class="course-tags">
                        <?php
                        if (!is_null($value->getTags())) {
                            foreach ($value->getTags() as $key => $tag) {
                        ?>
                                <span><?php echo $tag->getTitle(); ?></span>
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="course-meta">
                        <form action="/student/courses/details" method="post">
                            <input type="submit" class="course-details" value="Details">
                            <input type="hidden" name="id" class="course-details" value="<?php echo $value->getId(); ?>">
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    </div>

    <script>
        // Add click handlers for filter buttons
        const filterButtons = document.querySelectorAll('.filter-btn');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                button.classList.add('active');
            });
        });
    </script>
</body>

</html>