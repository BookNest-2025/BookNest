<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest</title>
    <link rel="stylesheet" href="assets/css/root.css">
</head>
<body>
    <a href="login.php">login</a><br>
    <a href="register.php">register</a><br>
    <a href="ad.php">admin</a><br>
</body>
</html>
<?php
    session_start();
    if(isset($_SESSION['email']) && isset($_SESSION['user_type'])) {
        echo"hello {$_SESSION['user_type']}, {$_SESSION['user_id']}";
    }
    session_destroy();
?>