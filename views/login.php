<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Login</title>
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

            /* Background Gradients */
            --bg-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
            --card-gradient: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.9));

            /* Neutral Colors */
            --background-color: #f8fafc;
            --text-color: #1e293b;
            --text-light: #64748b;
            --white: #ffffff;
            --error-color: #ef4444;

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
            background: var(--bg-gradient);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative background elements */
        body::before,
        body::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: 0;
        }

        body::before {
            top: -100px;
            left: -100px;
        }

        body::after {
            bottom: -100px;
            right: -100px;
        }

        .login-container {
            background: var(--card-gradient);
            padding: 3rem;
            border-radius: 20px;
            box-shadow: var(--shadow-lg);
            width: 100%;
            max-width: 440px;
            position: relative;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            z-index: 1;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo {
            font-size: 2.5rem;
            background: var(--bg-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .subtitle {
            color: var(--text-light);
            margin-top: 0.5rem;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.75rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .input-container {
            position: relative;
        }

        .input-container input {
            width: 100%;
            padding: 0.875rem 1rem;
            padding-left: 2.5rem;
            border: 2px solid rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .input-container input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-light);
            font-size: 1.1rem;
        }

        .login-button {
            width: 100%;
            padding: 1rem;
            background: var(--bg-gradient);
            color: var(--white);
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .login-button:active {
            transform: translateY(0);
        }

        .signup-link {
            text-align: center;
            margin-top: 2rem;
            color: var(--text-light);
            font-size: 0.95rem;
        }

        .signup-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.5rem;
            transition: color 0.3s ease;
        }

        .signup-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .error-message {
            color: rgb(192 23 23);
            background-color: rgb(233 198 198);
            border: 1px solid #f77575;
            padding: 10px;
            width: 100%;
            display: block;
            border-radius: 6px;
            text-align: center;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 2rem;
            }

            .logo {
                font-size: 2rem;
            }
        }

        /* Loading animation for button */
        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }

            100% {
                opacity: 1;
            }
        }

        .login-button.loading {
            animation: pulse 1.5s infinite;
            cursor: wait;
        }

        /* Success checkmark animation */
        @keyframes checkmark {
            0% {
                transform: scale(0);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .success-checkmark {
            display: none;
            color: var(--white);
            font-size: 1.2rem;
            animation: checkmark 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo-container">


            <div class="logo">Youdemy</div>
            <div class="subtitle">Unlock Your Learning Potential</div>
        </div>

        <form id="loginForm" action="/auth/login" method="post">
            <?php
            if (isset($_SESSION['error'])) {
            ?>
                <div class="form-group">
                    <span for="error" class="error-message">
                        <?php

                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>

                    </span>

                </div>
            <?php
            }
            ?>
            <div class="form-group">
                <label for="email">Email Address</label>
                <div class="input-container">
                    <span class="input-icon">✉️</span>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        required
                        autocomplete="email">
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-container">
                    <span class="input-icon">🔒</span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        required
                        autocomplete="current-password">
                </div>
            </div>

            <button type="submit" class="login-button">
                <span class="button-text">Log In</span>
                <span class="success-checkmark">✓</span>
            </button>

            <div class="signup-link">
                New to Youdemy?<a href="/signup">Create an account</a>
            </div>
        </form>
    </div>
</body>

</html>