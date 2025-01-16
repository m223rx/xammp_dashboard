<?php
session_start();
include("./helpers/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (isset($username, $password)) {
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            if (password_verify($password, $stored_password)) {
                $_SESSION['logged_in'] = true;
                header('Location: ../index.php');
                exit;
            } else {
                $_SESSION['logged_in'] = false;
                $error_message = 'Invalid username or password.';
            }
        } else {
            $error_message = 'Username not found.';
        }

        $stmt->close();
    } else {
        $_SESSION['logged_in'] = false;
        $error_message = 'Please fill in all fields.';
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