<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --primary-light: #818cf8;

            --secondary-color: #06b6d4;
            --secondary-dark: #0891b2;
            --secondary-light: #22d3ee;

            --accent-purple: #8b5cf6;
            --accent-pink: #ec4899;
            --accent-orange: #f97316;

            --bg-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            --card-gradient: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.95));
            --hero-gradient: linear-gradient(135deg, rgba(79, 70, 229, 0.95) 0%, rgba(6, 182, 212, 0.95) 100%);

            --background-color: #f8fafc;
            --text-color: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;

            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.12);
            --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);

            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Roboto Slab", 'Inter', system-ui, -apple-system, sans-serif;
        }

        body {
            background: var(--background-color);
            min-height: 100vh;
            color: var(--text-color);
            overflow-x: hidden;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 1.5rem;
            box-shadow: var(--shadow-xl);
            overflow: hidden;
        }

        .profile-header {
            position: relative;
        }

        .cover-image {
            height: 260px;
            width: 100%;
            background: var(--bg-gradient);
            position: relative;
            overflow: hidden;
        }

        .cover-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"><circle cx="20" cy="20" r="20" fill="%23ffffff10"/><circle cx="80" cy="80" r="30" fill="%23ffffff10"/></svg>');
            background-size: 80px 80px;
            opacity: 0.3;
        }

        .profile-picture {
            position: absolute;
            bottom: -60px;
            left: 50%;
            transform: translateX(-50%);
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 6px solid var(--white);
            box-shadow: var(--shadow-lg);
            background: #eee;
            overflow: hidden;
            z-index: 2;
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .profile-picture:hover img {
            transform: scale(1.1);
        }

        .profile-content {
            padding: 5rem 2rem 2rem;
            text-align: center;
        }

        .profile-name {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: var(--bg-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .profile-title {
            color: var(--text-light);
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .profile-bio {
            color: var(--text-light);
            max-width: 600px;
            line-height: 1.7;
            margin: 0 auto 2rem;
        }

        .contact-info {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
            padding: 1rem;
            background: linear-gradient(to right, rgba(79, 70, 229, 0.1), rgba(6, 182, 212, 0.1));
            border-radius: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-light);
            font-size: 1.1rem;
            transition: transform 0.2s;
        }

        .contact-item:hover {
            transform: translateY(-2px);
            color: var(--primary-color);
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .social-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            box-shadow: var(--shadow-md);
        }

        .social-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .social-button.primary {
            background: var(--primary-color);
        }

        .social-button.secondary {
            background: var(--secondary-color);
        }

        .sections-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            padding: 0 1rem;
        }

        .section {
            background: var(--white);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: var(--primary-dark);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title::before {
            content: '';
            display: block;
            width: 3px;
            height: 24px;
            background: var(--bg-gradient);
            border-radius: 3px;
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .skill-tag {
            padding: 0.5rem 1rem;
            border-radius: 0.75rem;
            background: linear-gradient(to right, rgba(79, 70, 229, 0.1), rgba(6, 182, 212, 0.1));
            color: var(--primary-color);
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.2s;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        .skill-tag:hover {
            transform: translateY(-2px);
            background: var(--primary-color);
            color: var(--white);
        }

        .activity-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 1rem;
            margin-bottom: 1rem;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .activity-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-light);
        }

        .activity-title {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--primary-dark);
        }

        .activity-description {
            color: var(--text-light);
            line-height: 1.6;
        }

        .activity-meta {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            font-size: 0.9rem;
            color: var(--text-light);
        }

        @media (max-width: 768px) {
            .sections-grid {
                grid-template-columns: 1fr;
            }

            .contact-info {
                flex-direction: column;
                gap: 1rem;
                align-items: center;
            }

            .profile-picture {
                width: 150px;
                height: 150px;
            }

            .cover-image {
                height: 200px;
            }

            .profile-name {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
    }
    ?>
    <div class="container">
        <div class="profile-header">
            <div class="cover-image"></div>
            <div class="profile-picture">
                <img src="<?php echo $user->getPhoto() ?>" alt="Profile Picture">
            </div>
        </div>

        <div class="profile-content">
            <h1 class="profile-name"><?php echo ucfirst($user->getFirstname());
                                        echo " ";
                                        echo ucfirst($user->getLastname()); ?></h1>
            <div class="profile-title">Senior Software Engineer</div>
            <p class="profile-bio">
                Passionate about building scalable web applications and contributing to open-source projects.
                Experienced in React, Node.js, and cloud architecture. Always eager to learn and share knowledge
                with the developer community.
            </p>

            <div class="contact-info">
                <div class="contact-item">
                    📍 <?php echo $user->getRole()->getName(); ?>
                </div>
                <div class="contact-item">
                    ✉️ <?php echo $user->getEmail(); ?>
                </div>
                <div class="contact-item">
                    🔗 <?php echo $user->getStatus(); ?>
                </div>
            </div>

            <div class="social-links">
                <a href="#" class="social-button primary">
                    Something
                </a>
                <a href="/auth/logout" class="social-button secondary">
                    Logout
                </a>
            </div>

            <div class="sections-grid">
                <div class="section">
                    <h2 class="section-title">Skills & Expertise</h2>
                    <div class="skills-container">
                        <span class="skill-tag">React</span>
                        <span class="skill-tag">Node.js</span>
                        <span class="skill-tag">TypeScript</span>
                        <span class="skill-tag">AWS</span>
                        <span class="skill-tag">Docker</span>
                        <span class="skill-tag">GraphQL</span>
                        <span class="skill-tag">MongoDB</span>
                        <span class="skill-tag">Redis</span>
                    </div>
                </div>

                <div class="section">
                    <h2 class="section-title">Courses</h2>
                    <div class="activity-card">
                        <h3 class="activity-title">React Performance Optimization</h3>
                        <p class="activity-description">
                            Implemented advanced rendering optimizations resulting in 40% faster load times.
                        </p>
                        <div class="activity-meta">
                            <span>🗓️ Yesterday</span>
                            <span>👍 12 kudos</span>
                        </div>
                    </div>
                    <div class="activity-card">
                        <h3 class="activity-title">Tech Talk: Modern Web Architecture</h3>
                        <p class="activity-description">
                            Presented best practices in scalable web development at TechConf 2024.
                        </p>
                        <div class="activity-meta">
                            <span>🗓️ Last week</span>
                            <span>👥 230 attendees</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Smooth reveal animation for sections
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        document.querySelectorAll('.section').forEach((section) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'all 0.6s ease-out';
            observer.observe(section);
        });

        // Hover effect for activity cards
        document.querySelectorAll('.activity-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-3px)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>

</html>