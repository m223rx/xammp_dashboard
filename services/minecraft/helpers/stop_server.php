<?php
if (file_exists('server_running.flag')) {
    unlink('server_running.flag');
    shell_exec("taskkill /IM java.exe /F");
    header("Location: index.php");
} else {
    echo "Server is not running!";
    header("refresh:2;url=index.php");
}
