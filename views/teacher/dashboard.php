<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard | E-Learning Platform</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            background: var(--primary-color);
            box-shadow: var(--shadow-md);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--white);
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
            color: var(--white);
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.3s;
        }

        .nav-item:hover,
        .nav-item.active {
            background: var(--white);
            color: var(--primary-color);
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
            background: var(--white);
            color: var(--primary-color);
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

        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .dashboard-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .card-title {
            color: var(--text-light);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .card-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .card-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            color: #10b981;
        }

        /* Table Styles */
        .data-table {
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        th {
            background: var(--background-color);
            font-weight: 600;
            color: var(--text-light);
        }

        td {
            color: var(--text-color);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
        }

        .status-active {
            background: #dcfce7;
            color: #166534;
        }

        .status-pending {
            background: #fef9c3;
            color: #854d0e;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .action-btn {
            padding: 0.5rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-btn {
            background: #dbeafe;
            color: #1e40af;
        }

        .delete-btn {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-btn:hover {
            opacity: 0.8;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--white);
            padding: 2rem;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .close-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--text-light);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 1rem;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .modal-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }

        .cancel-btn {
            background: var(--background-color);
            color: var(--text-color);
        }

        .save-btn {
            background: var(--primary-color);
            color: var(--white);
        }
    </style>
    <?php
    echo $request == '/teacher' ?  '<link href="../../views/teacher/statistics.css" rel="stylesheet">' :  '';
    ?>
    <?php
    echo $request == '/teacher/statistics' ?  '<link href="../../views/teacher/statistics.css" rel="stylesheet">' :  '';
    ?>
    <?php
    echo $request == '/teacher/courses' ?  '<link href="../../views/teacher/courses.css" rel="stylesheet">' :  '';
    ?>
    <?php
    echo $request == '/teacher/students' ?  '<link href="../../views/teacher/students.css" rel="stylesheet">' :  '';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script src="sweetalert2.all.min.js"></script>

</head>

<body>
    <?php
    $request = $_SERVER['REQUEST_URI'];
    ?>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <i class="fas fa-graduation-cap"></i>
            Teacher Panel
        </div>
        <nav>
            <a href="/teacher/statistics" class="nav-item <?php echo $request == '/teacher/statistics' ?  'active' :  ''; ?>">
                <i class="fas fa-chart-line"></i>
                Dashboard
            </a>
            <a href="/teacher/courses" class="nav-item <?php echo $request == '/teacher/courses' ?  'active' :  ''; ?>">
                <i class="fas fa-book"></i>
                Courses
            </a>
            <a href="/teacher/students" class="nav-item <?php echo $request == '/teacher/students' ?  'active' :  ''; ?>">
                <i class="fas fa-users"></i>
                Students
            </a>
        </nav>
    </aside>

    <?php

    switch ($request) {

        case '/teacher/statistics':
            require __DIR__ . "\\statistics.php";
            break;
        case '/teacher/courses':
            require __DIR__ . "\\courses.php";
            break;
        case '/teacher/students':
            require __DIR__ . "\\students.php";
            break;
        default:
            include __DIR__ . "\\statistics.php";
            break;
    }

    ?>

</body>

</html>