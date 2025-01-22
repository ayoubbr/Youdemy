<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | E-Learning Platform</title>
    <?php echo $request == '/admin' ?  '<link href="../../views/admin/statistics.css" rel="stylesheet">' :  ''; ?>
    <?php echo $request == '/admin/statistics' ?  '<link href="../../views/admin/statistics.css" rel="stylesheet">' :  ''; ?>
    <?php echo $request == '/admin/courses' ?  '<link href="../../views/admin/courses.css" rel="stylesheet">' :  ''; ?>
    <?php echo $request == '/admin/users' ?  '<link href="../../views/admin/users.css" rel="stylesheet">' :  ''; ?>
    <?php echo $request == '/admin/teachers' ?  '<link href="../../views/admin/teachers.css" rel="stylesheet">' :  ''; ?>
    <?php echo $request == '/admin/topics' ?  '<link href="../../views/admin/topics.css" rel="stylesheet">' :  ''; ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../views/admin/dashboard.css">
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
            <a href="/admin" class="nav-item <?php echo ($request == '/admin' ?  'active' :  $request == '/admin/statistics') ? 'active' : ''; ?>">
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
            <a href="/admin/teachers" class="nav-item <?php echo $request == '/admin/teachers' ?  'active' :  ''; ?>">
                <i class="fa-solid fa-user-tie"></i>
                Teachers
            </a>
            <a href="/admin/topics" class="nav-item <?php echo $request == '/admin/topics' ?  'active' :  ''; ?>">
                <i class="fas fa-tags"></i>
                Categories & Tags
            </a>
            <a href="/auth/logout" class="nav-item last">
                <i class="fa-solid fa-circle-arrow-left"></i>
                Logout
            </a>
        </nav>
    </aside>

    <?php
    switch ($request) {
        case '/admin':
            require __DIR__ . "\\statistics.php";
            break;
        case '/admin/courses':
            require __DIR__ . "\\courses.php";
            break;
        case '/admin/teachers':
            require __DIR__ . "\\teachers.php";
            break;
        case '/admin/users':
            require __DIR__ . "\\users.php";
            break;
        case '/admin/topics':
            require __DIR__ . "\\topics.php";
            break;
        default:
            require __DIR__ . "\\statistics.php";
            break;
    }
    ?>

</body>

</html>