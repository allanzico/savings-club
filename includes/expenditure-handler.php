<?php
define('included',TRUE);
if(isset($_POST['addExpenditure'])){
    require 'connection.php';

    $date = $_POST['dateExpenditure'];
    $debit = $_POST['debit'];
    $notes = stripslashes($_POST['notes']);
    $type= "Withdraw";

    //Check if anything is empty
    if(empty($date)|| empty($debit)){
        header("Location: ../pettyCash.php?error=emptyfields&date");
    exit();

    //Check for validation
    }elseif(!preg_match("/^[1-9][0-9]*$/", $debit)){
        header("Location: ../pettyCash.php?error=notInt");
        exit();

    }
    //Create prepared statements for validation

    else{

                $sql = "INSERT INTO pettyCash (date, debit,type,notes) VALUES (?,?,?,?)";
                $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../pettyCash.php?error=sqlerror");
            exit();

            // echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
        }else {

            $removeSlashes = stripslashes($notes);
            mysqli_stmt_bind_param($statement, 'siss',$date, $debit,$type,$notes);
            mysqli_stmt_execute($statement);
            // echo mysqli_info($conn);

           header("Location: ../pettyCash.php?error=success");
            exit();
        }
            }

    mysqli_stmt_close($statement);
    mysqli_close($conn);
}else{
    header("Location: ../pettyCash.php");
    exit();
}