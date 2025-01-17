<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../../auth/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css">
    <script src="helpers/controller.js"></script>
    <script src="https://kit.fontawesome.com/e1130e2a24.js" crossorigin="anonymous"></script>
    <title>Server</title>
</head>

<body>
    <main>
        <div class="serverRunContainer">
            <div class="serverBannerContainer">
                <h1>192.168.1.102:80</h1>
                <span>
                    <i class="fas fa-power-off"></i>
                    Server Off
                </span>
            </div>
            <div class="serverStatusContainer">
                <form action="./start.php" method="post">
                    <button type="submit">Start</button>
                </form>
                <form action="./start.php" method="post">
                    <button type="submit">Stop</button>
                </form>
            </div>

        </div>
    </main>
</body>

</html>