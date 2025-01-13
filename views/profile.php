<?php
// session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Profile</h1>
    <?php
    if (isset($_SESSION['user'])) {
        var_dump($_SESSION['user']);
    ?>
        <a href="/auth/logout">logout</a>
    <?php
    }
    ?>
    <a href="/">Home</a>

</body>

</html>