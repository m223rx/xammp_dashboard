<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: ../../auth/login.php');
    exit;
}

?>

<?php
$serverName = "Minecraft Server";
$serverStatus = file_exists('server_running.flag') ? 'Running' : 'Stopped';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft</title>
    <link rel="stylesheet" href="../../styles/styles.css">
    <script src="../../helpers/controller.js"></script>
    <script src="https://kit.fontawesome.com/e1130e2a24.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include('../../components/header.php');
    ?>
    <main>
        <div class="serverSettingsContainer">
            <div class="asideContainer">
                <aside>
                    <h2>Menu</h2>
                    <ul>
                        <li>
                            <a href="./helpers/server.php" target="contentFrame">Server</a>
                        </li>
                        <li><a href="page2.php" target="contentFrame">Console</a></li>
                        <li><a href="page3.php" target="contentFrame">Log</a></li>
                    </ul>
                </aside>
            </div>
            <iframe name="contentFrame" src="server.html"></iframe>
        </div>
    </main>
</body>

</html>