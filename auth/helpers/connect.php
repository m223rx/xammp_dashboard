<?php

$conn = mysqli_connect("192.168.1.102", "root@admin", "_mzj@whwvaV2xKRC", "admins");
if (mysqli_connect_errno()) {
    printf("Error", mysqli_connect_error());
    exit;
}
return $conn;
