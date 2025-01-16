<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | E-Learning Platform</title>
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
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: var(--white);
            box-shadow: var(--shadow-md);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: var(--primary-color);
            color: var(--white);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            padding: 2rem;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.75rem;
            color: var(--text-color);
        }

        .add-new-btn {
            background: var(--primary-color);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: background-color 0.3s;
        }

        .add-new-btn:hover {
            background: var(--primary-dark);
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php
    echo $request == '/admin' ?  '<link href="../../views/admin/dashboard.css" rel="stylesheet">' :  '';
    ?>
    <?php
    echo $request == '/admin/courses' ?  '<link href="../../views/admin/courses.css" rel="stylesheet">' :  '';
    ?>
    <?php
    echo $request == '/admin/users' ?  '<link href="../../views/admin/users.css" rel="stylesheet">' :  '';
    ?>
    <?php
    echo $request == '/admin/topics' ?  '<link href="../../views/admin/topics.css" rel="stylesheet">' :  '';
    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>

<body>
    <?php
    $request = $_SERVER['REQUEST_URI'];
    ?>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            Admin Panel
        </div>
        <nav>
            <a href="/admin" class="nav-item <?php echo $request == '/admin' ?  'active' :  ''; ?>">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>
            <a href="/admin/courses" class="nav-item <?php echo $request == '/admin/courses' ?  'active' :  ''; ?>">
                <i class="fas fa-book"></i>
                Courses
            </a>
            <a href="/admin/users" class="nav-item <?php echo $request == '/admin/users' ?  'active' :  ''; ?>">
                <i class="fas fa-users"></i>
                Users
            </a>
            <a href="/admin/topics" class="nav-item <?php echo $request == '/admin/topics' ?  'active' :  ''; ?>">
                <i class="fas fa-tags"></i>
                Categories & Tags
            </a>
            <!-- <a href="#" class="nav-item">
                <i class="fas fa-cog"></i>
                Settings
            </a> -->
        </nav>
    </aside>

    <?php

    switch ($request) {

        case '/admin/courses':
            require __DIR__ . "\\courses.php";
            break;
        case '/admin/users':
            require __DIR__ . "\\users.php";
            break;
        case '/admin/topics':
            require __DIR__ . "\\topics.php";
            break;
        case '/admin':
        default:
            include __DIR__ . "\\dashboard.php";
            break;
    }

    ?>

</body>

</html>