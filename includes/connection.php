<?php

if(!defined('included')){
        header("Location: ./404.php");

        exit();
     }
//Create connection to mysql server
$conn = mysqli_connect("b8rg15mwxwynuk9q.chr7pe7iynqr.eu-west-1.rds.amazonaws.com", "mph8lqg1ds27cdod", "c3hvst4i0j2rjmr5")
        OR DIE("<p>Unable to connect to the database server.</p>");

// $conn = mysqli_connect("localhost", "root", "")
// OR DIE("<p>Unable to connect to the database server.</p>");

//Creating database if doesn't already exist and selecting
//$DBName = "savings_club";
$DBName = "zywixeao4qc32xir";
if (!mysqli_select_db($conn, $DBName)) {
    $SQLstring = "CREATE DATABASE $DBName";
    mysqli_query($conn, $SQLstring)
            OR DIE("<p>Unable to create database.</p>");
}
mysqli_select_db($conn, $DBName)
        OR DIE("<p>Unable to select database.</p>");
?>