<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../auth/login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <script src="../helpers/controller.js"></script>
</head>

<body>
    <?php
    include('../components/header.php');
    ?>
    <main>
        <div class="servicesContainer">
            <h1>Services</h1>
            <div class="servicesHandler">
                <div class="servicesCardContainer" onclick="return redirect('./minecraft/minecraft.php');">
                    <img src="../resources/images/minecraft.jpeg" alt="">
                    <h3>Minecraft Server</h3>
                </div>
            </div>
        </div>
    </main>
</body>

</html>