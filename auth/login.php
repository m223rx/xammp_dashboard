<?php
session_start(); // Start the session

// Dummy credentials (You can replace this with a database check)
$valid_username = 'admin';
$valid_password = 'password123';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_username && $password === $valid_password) {
        // Set session variable to indicate the user is logged in
        $_SESSION['logged_in'] = true;
        header('Location: ../index.php'); // Redirect to index page
        exit;
    } else {
        $error_message = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="../helpers/controller.js"></script>
</head>

<body>
    <div class="login-container">
        <div class="loginFormContainer">
            <h2>Login</h2>
            <?php
            if (isset($error_message)) {
                echo "<p style='color: red;'>$error_message</p>";
            }
            ?>
            <form action="login.php" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="@username" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="**********" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>