<?php

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $db_name = "lms_kemlu";

    $conn = mysqli_connect($hostname, $username, $password, $db_name);

    if (!$conn) {
        echo "Koneksi Failed";
    } 

?>