<?php
define('included',TRUE);
if(isset($_POST['login_user'])){
    require 'connection.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
    exit();
    }else{
        //Validation using prepared statements
        $sql = "SELECT * FROM users WHERE email=?";
        $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../login.php?error=sqlerror");
    exit();
        }else {
            mysqli_stmt_bind_param($statement,"s",$email);
            mysqli_stmt_execute($statement);
            $result = mysqli_stmt_get_result($statement);
            if ($row = mysqli_fetch_assoc($result)) {
                $passwordCheck = password_verify($password, $row['password']);
               if($passwordCheck == false){
                header("Location: ../login.php?error=wrongpwd");
                exit();
               }elseif ($passwordCheck == true) {
                   session_start();
                   $_SESSION['userID']=$row['userId'];
                   $_SESSION['fName']=$row['firstName'];
                   $admin = $row['admin'];
                   if ($admin == 'N') {
                    header("Location: ../user.php?login=success");
                    exit();
                   }else {
                    header("Location: ../admin.php?login=success");
                   }

               }else{
                header("Location: ../login.php?=wrongpwd");
                exit();
               }
            }else {
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }

}else {
    header("Location: ../index.php");
    exit();
}