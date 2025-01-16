<!-- connect to database -->
<?php

$conn = mysqli_connect("192.168.1.121", "root@admin", "_mzj@whwvaV2xKRC", "admin");
if (mysqli_connect_errno()) {
    printf("Error", mysqli_connect_error());
    exit(1);
}
if (!mysqli_query($conn, "")) {
    printf("", mysqli_connect_error());
}
return $conn;

?>