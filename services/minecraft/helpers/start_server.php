<?php
// Path to your Minecraft server .bat file
$batFile = "C:\\path\\to\\your\\start_server.bat";

if (!file_exists('server_running.flag')) {
    shell_exec("start /b $batFile");
    file_put_contents('server_running.flag', '1');
    header("Location: ./index.php");
} else {
    echo "Server is already running!";
    header("refresh:2;url=index.php");
}
