<?php

if(!defined('included')){
        header("Location: ./404.php");

        exit();
     }
//Create connection to mysql server
$conn = mysqli_connect("capitallink.mysql.database.azure.com", "akanyijuka@capitallink", "@P455word")
        OR DIE("<p>Unable to connect to the database server.</p>");

// $conn = mysqli_connect("localhost", "root", "")
// OR DIE("<p>Unable to connect to the database server.</p>");

//Creating database if doesn't already exist and selecting
$DBName = "savings_club";
if (!mysqli_select_db($conn, $DBName)) {
    $SQLstring = "CREATE DATABASE $DBName";
    mysqli_query($conn, $SQLstring)
            OR DIE("<p>Unable to create database.</p>");
}
mysqli_select_db($conn, $DBName)
        OR DIE("<p>Unable to select database.</p>");
?>