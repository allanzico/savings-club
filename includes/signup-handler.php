<?php
define('included',TRUE);
if(isset($_POST['submit'])){
    require 'connection.php';

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];

    //Check if anything is empty
    if(empty($firstName)|| empty($lastName) || empty($email) || empty($password) || empty($repeatPassword)){
        header("Location: ../register.php?error=emptyfields&firstName=".$firstName."&lastName=".$lastName."&email".$email);
    exit();

    //Check for validation
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $firstName, $lastName)){
        header("Location: ../register.php?error=invalidemail");
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $firstName, $lastName)) {
        header("Location: ../register.php?error=invalidname&email=".$email);
    exit();
    }
    elseif ($password !== $repeatPassword) {
        header("Location: ../register.php?error=emptyfields&firstName=".$firstName."&lastName=".$lastName."&email".$email);
   exit();
    }

    //Create prepared statements for validation
    else {
        $sql = "SELECT * FROM users WHERE email=?";
        $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../register.php?error=sqlerror");
            exit();
        }else{
            mysqli_stmt_bind_param($statement, "s", $email);
            mysqli_stmt_execute($statement);
            mysqli_stmt_store_result($statement);
            $resultCheck = mysqli_stmt_num_rows($statement);
            if ($resultCheck > 0) {
                header("Location: ../register.php?error=usertaken&firstName=".$firstName."&lastName=".$lastName."&email=".$email);
                exit();
            }else{
                $sql = "INSERT INTO users (firstName, lastName, email, password ) VALUES (?,?,?,?)";
                $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../register.php?error=sqlerror");
            exit();
        }else {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            mysqli_stmt_bind_param($statement, "ssss", $firstName, $lastName, $email, $hashedPassword);
            mysqli_stmt_execute($statement);
            header("Location: ../register.php?error=success");
            exit();
        }
            }
        }
    }
    mysqli_stmt_close($statement);
    mysqli_close($conn);
}else{
    header("Location: ../register.php");
    exit();
}