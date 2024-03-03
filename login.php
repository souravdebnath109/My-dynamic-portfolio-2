<?php
session_start();

$db = new mysqli('localhost', 'root', '', 'web');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = $db->query($query);

    if ($results->num_rows == 1) {
        $_SESSION['username'] = $username;
        header('location: admin.php');
        exit;
    } else {
        $loginErrorMessage = "Invalid username or password. Please try again or register.";

        // Display the alert box in PHP
        echo '<script>alert("' . $loginErrorMessage . '")</script>';
    }
}

if (isset($_POST['reg_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $db->query($query);

    $_SESSION['username'] = $username;
    header('location: register.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="login_user">Login</button>
        <button type="submit" name="reg_user">Register</button>
    </form>

    <div class="error-message-container">
        <?php
        // Display the login error message
        if (isset($loginErrorMessage)) {
           // echo '<p class="error-message">' . $loginErrorMessage . '</p>';
        }
        ?>
    </div>

</body>

</html>
