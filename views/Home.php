<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Transform Your Learning Journey</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100..900&display=swap');

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                transform: translateX(-100%);
            }

            to {
                transform: translateX(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

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
        }

        .glass-effect {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
        }

        /* Navigation */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            z-index: 1000;
        }


        nav.scrolled {
            background: rgba(255, 255, 255, 0.95);
            padding: 0.75rem 2rem;
            box-shadow: var(--shadow-md);
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: 800;
            background: var(--bg-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: #f6f1f1bf;
            letter-spacing: -1px;
        }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            margin-left: 3rem;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
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
            background: transparent;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
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

        /* Hero Section */
        .hero {
            min-height: 100vh;
            background: var(--hero-gradient);
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .hero-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 12rem 2rem 6rem;
            position: relative;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-text {
            animation: fadeIn 1s ease-out;
        }

        .hero-text h1 {
            font-size: 4rem;
            color: var(--white);
            margin-bottom: 1.5rem;
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .hero-text p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .hero-image {
            animation: float 6s ease-in-out infinite;
        }

        .hero-image img {
            width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: var(--shadow-xl);
        }

        /* Features Section */
        .features {
            padding: 8rem 2rem;
            background: var(--white);
            position: relative;
        }

        .section-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 4rem;
        }

        .section-header h2 {
            font-size: 2.5rem;
            color: var(--text-color);
            margin-bottom: 1rem;
            font-weight: 800;
        }

        .section-header p {
            color: var(--text-light);
            font-size: 1.2rem;
            line-height: 1.6;
        }

        .features-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2.5rem;
        }

        .feature-card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--bg-gradient);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            display: inline-block;
            padding: 1rem;
            background: var(--bg-gradient);
            border-radius: 16px;
            color: var(--white);
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: var(--text-color);
            font-weight: 700;
        }

        .feature-card p {
            color: var(--text-light);
            line-height: 1.7;
        }

        /* Stats Section */
        .stats {
            padding: 6rem 2rem;
            background: var(--bg-gradient);
            position: relative;
            overflow: hidden;
        }

        .stats::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%) -40px 0,
                linear-gradient(-45deg, rgba(255, 255, 255, 0.1) 25%, transparent 25%) -40px 0;
            background-size: 80px 80px;
        }

        .stats-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 3rem;
            position: relative;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-item h2 {
            font-size: 3rem;
            color: var(--white);
            margin-bottom: 0.5rem;
            font-weight: 800;
        }

        .stat-item p {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            font-size: 1.1rem;
        }

        /* Testimonials */
        .testimonials {
            padding: 8rem 2rem;
            background: var(--white);
        }

        .testimonials-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 3rem;
        }

        .testimonial-card {
            padding: 2.5rem;
            background: var(--card-gradient);
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            transition: all 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-5px);
        }

        .testimonial-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 1rem;
            background: var(--bg-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 600;
            font-size: 1.5rem;
        }

        .testimonial-info h4 {
            color: var(--text-color);
            font-size: 1.2rem;
            margin-bottom: 0.25rem;
        }

        .testimonial-info p {
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .testimonial-quote {
            color: var(--text-color);
            line-height: 1.7;
            font-size: 1.1rem;
        }

        .cta {
            padding: 8rem 2rem;
            background: var(--bg-gradient);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }

        .cta-content {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .cta h2 {
            font-size: 3rem;
            color: var(--white);
            margin-bottom: 1.5rem;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .cta p {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2.5rem;
            line-height: 1.6;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
        }

        .cta .btn-primary {
            background: var(--white);
            color: var(--primary-color);
        }

        .cta .btn-outline {
            border-color: var(--white);
            color: var(--white);
        }

        /* Partners */
        .partners {
            padding: 4rem 2rem;
            background: var(--white);
        }

        .partners-grid {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 3rem;
            align-items: center;
        }

        .partner-logo {
            height: 50px;
            opacity: 0.7;
            transition: opacity 0.3s ease;
        }

        .partner-logo:hover {
            opacity: 1;
        }

        /* Footer */
        footer {
            background: var(--text-color);
            color: var(--white);
            padding: 6rem 2rem 2rem;
            position: relative;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr repeat(3, 1fr);
            gap: 4rem;
        }

        .footer-main {
            padding-right: 2rem;
        }

        .footer-main .logo {
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .footer-main p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        .footer-section h3 {
            color: var(--white);
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 1rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--white);
            transform: translateX(5px);
        }

        .footer-bottom {
            max-width: 1200px;
            margin: 4rem auto 0;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Animations and Hover Effects */
        @keyframes scaleIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-in {
            animation: scaleIn 0.5s ease-out forwards;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .footer-content {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                padding: 8rem 2rem 4rem;
            }

            .hero-text h1 {
                font-size: 3rem;
            }

            .nav-links {
                display: none;
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .partners-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .features-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <nav>
        <div class="nav-container">
            <div class="logo">Youdemy</div>
            <div class="nav-links">
                <a href="#features">Features</a>
                <a href="#courses">Courses</a>
                <a href="#testimonials">Testimonials</a>
                <a href="#pricing">Pricing</a>
            </div>

            <?php
            ?>
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

            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Transform Your Future with Online Learning</h1>
                <p>Unlock your potential with world-class courses, expert instructors, and a supportive global community. Start your learning journey today.</p>
                <div class="cta-buttons">
                    <button class="btn btn-primary">Get Started Free</button>
                    <button class="btn btn-outline">Explore Courses</button>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://www.scnsoft.com/education-industry/elearning-portal/elearning-portals-cover-picture.svg" alt="Online Learning Platform" />
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <div class="section-header">
            <h2>Why Choose Youdemy?</h2>
            <p>Discover the features that make our platform the perfect choice for your learning journey</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3>Expert-Led Courses</h3>
                <p>Learn from industry experts and gain practical skills that matter in today's rapidly evolving job market.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💡</div>
                <h3>Interactive Learning</h3>
                <p>Engage with hands-on projects, quizzes, and peer feedback to reinforce your learning experience.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🌐</div>
                <h3>Global Community</h3>
                <p>Connect with learners worldwide, share insights, and grow together in our vibrant community.</p>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="stats-grid">
            <div class="stat-item">
                <h2>15K+</h2>
                <p>Active Students</p>
            </div>
            <div class="stat-item">
                <h2>500+</h2>
                <p>Expert Instructors</p>
            </div>
            <div class="stat-item">
                <h2>1,200+</h2>
                <p>Online Courses</p>
            </div>
            <div class="stat-item">
                <h2>96%</h2>
                <p>Success Rate</p>
            </div>
        </div>
    </section>

    <section class="testimonials" id="testimonials">
        <div class="section-header">
            <h2>Student Success Stories</h2>
            <p>Hear from our community about their learning experience with Youdemy</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">S</div>
                    <div class="testimonial-info">
                        <h4>Sarah Johnson</h4>
                        <p>Data Science Graduate</p>
                    </div>
                </div>
                <p class="testimonial-quote">"Youdemy transformed my career. The practical projects and expert guidance helped me land my dream job in data science."</p>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-header">
                    <div class="testimonial-avatar">M</div>
                    <div class="testimonial-info">
                        <h4>Michael Chen</h4>
                        <p>Web Development Student</p>
                    </div>
                </div>
                <p class="testimonial-quote">"The interactive learning experience and supportive community made learning to code enjoyable and effective."</p>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="cta-content">
            <h2>Start Your Learning Journey Today</h2>
            <p>Join thousands of learners who have transformed their careers with Youdemy</p>
            <div class="cta-buttons">
                <button class="btn btn-primary">Start Free Trial</button>
                <button class="btn btn-outline">View Pricing</button>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-main">
                <div class="logo">Youdemy</div>
                <p>Empowering learners worldwide with quality education and practical skills for the future.</p>
                <div class="social-links">
                    <a href="#" class="social-link">f</a>
                    <a href="#" class="social-link">t</a>
                    <a href="#" class="social-link">in</a>
                    <a href="#" class="social-link">ig</a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Platform</h3>
                <ul class="footer-links">
                    <li><a href="#">Browse Courses</a></li>
                    <li><a href="#">Success Stories</a></li>
                    <li><a href="#">For Enterprise</a></li>
                    <li><a href="#">Become an Instructor</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Support</h3>
                <ul class="footer-links">
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Technical Support</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Legal</h3>
                <ul class="footer-links">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Cookie Policy</a></li>
                    <li><a href="#">Accessibility</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Youdemy. All rights reserved.</p>
            <p>Made with ❤️ for learners worldwide</p>
        </div>
    </footer>
</body>

</html>