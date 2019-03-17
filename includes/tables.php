<?php
define('included',TRUE);
include "connection.php";

//Users table
$users = "CREATE TABLE IF NOT EXISTS users(
    userId INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    profileImage VARCHAR(100),
    password BINARY(60) NOT NULL,
    admin ENUM('Y','N') DEFAULT 'N'

)" ;

//Transaction
$Transaction = "CREATE TABLE IF NOT EXISTS transact(
    transactId INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    amount INT(50) NOT NULL,
    payeeEmail VARCHAR(50) NOT NULL,
    payedFor VARCHAR(50) NOT NULL,
    type VARCHAR(50) ,
    notes VARCHAR(250),
    userId INT(6) NOT NULL,
    FOREIGN KEY(userId) REFERENCES users (userId)
)";

//Petty Cash
$Transaction = "CREATE TABLE IF NOT EXISTS pettyCash(
    cashId INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    type VARCHAR(50) ,
    debit INT(50) DEFAULT 0,
    credit INT(50) DEFAULT 0,
    notes VARCHAR(250)
)";


?>
