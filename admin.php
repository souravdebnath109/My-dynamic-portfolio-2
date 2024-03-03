<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: index.php');
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $username; ?></title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

    <header>
        <h1>Welcome to Adminpage  </h1>
    </header>

    <div>
        <p>This is the admin page.</p>

        <h2>Options:</h2>
        <ul>
        
    <li><a href="editcourse.php" class="button"style="background-color:#032d30;">Edit Courses</a></li>
    <li><a href="editproject.php" class="button"style="background-color:#032d30;">Edit Projects</a></li>
    <li><a href="timeline.php" class="button"style="background-color:#032d30;">Edit Timeline</a></li>
    <li><a href="photo.php" class="button"style="background-color:#032d30;">Edit Photographs</a></li>  
     <li> <a href="service.php" class="button"style="background-color:#032d30;">Edit services</a></li>
     <li><a href="index.php" class="button" style=" background-color: #ff4900;">Logout</a>
</li>

        </ul>
    </div>

</body>
</html>
