<?php
define('included',TRUE);
include "connection.php";

//Users table
$users = "CREATE TABLE IF NOT EXISTS users(
    userId INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(15) NOT NULL,
    lastName VARCHAR(20) NOT NULL,
    email VARCHAR(45) NOT NULL UNIQUE,
    profileImage VARCHAR(100),
    password CHAR(60) NOT NULL,
    admin ENUM('Y','N') DEFAULT 'N'

)" ;

//Transaction
$Transaction = "CREATE TABLE IF NOT EXISTS transact(
    transactId INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    amount INT(50) NOT NULL,
    payee VARCHAR(50) NOT NULL,
    type VARCHAR(50) ,
    notes VARCHAR(250),
    userId INT(6) NOT NULL,
    FOREIGN KEY(userId) REFERENCES users (userId)
)";



?>
