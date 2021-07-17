<?php

$user = 'root';
$pass = '';
$server = 'localhost';
$db  = 'bankingsystem';

$conn = mysqli_connect($server, $user, $pass, $db) or die("No connection".mysqli_connect_error());
// mysqli_select_db($conn, $db);

// if($conn)
//     echo"connected";
// else
//     echo"connection failed";
?>