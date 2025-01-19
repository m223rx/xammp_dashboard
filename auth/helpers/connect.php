<?php

$conn = mysqli_connect("192.168.1.102", "northtest", "northtest666", "admins");

if (mysqli_connect_errno()) {
    printf("Connection failed: %s\n", mysqli_connect_error());
    exit;
}

return $conn;
