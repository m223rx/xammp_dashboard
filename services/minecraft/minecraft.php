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
</head>

<body>
    <?php
    include('../../components/header.php');
    ?>
    <main>
        <div>
            <h2>Server Settings</h2>
            <p><strong>Server Name:</strong> <?php echo $serverName; ?></p>
            <p><strong>Status:</strong> <?php echo $serverStatus; ?></p>
            <form action="start_server.php" method="post" style="display: inline;">
                <button type="submit" class="button">Start Server</button>
            </form>
            <form action="stop_server.php" method="post" style="display: inline;">
                <button type="submit" class="button stop">Stop Server</button>
            </form>
        </div>
    </main>
</body>

</html>