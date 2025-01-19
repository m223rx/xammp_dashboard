<?php

$conn = mysqli_connect("192.168.1.102", "northtest", "O0/pbKKvz@ricT_i", "admins");
if (mysqli_connect_errno()) {
    printf("Error", mysqli_connect_error());
    exit;
}
return $conn;
  