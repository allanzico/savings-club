<?php
define('included',TRUE);
if(isset($_POST['saveTransaction'])){
    require 'connection.php';

    $date = $_POST['transactionDate'];
    $amount = $_POST['amount'];
    $payeeEmail = $_POST['payeeEmail'];
    $type = $_POST['selectList'];
    $notes = $_POST['notes'];
    $removeSlashes = stripslashes($notes);

    //Check if anything is empty
    if(empty($date)|| empty($amount) || empty($payeeEmail)){
        header("Location: ../add-savings.php?error=emptyfields&date=".$date."&amount=".$amount."&payee".$payee."&notes".$notes."&type".$type);
    exit();

    //Check for validation
    }elseif(!preg_match("/^[1-9][0-9]*$/", $amount)){
        header("Location: ../add-savings.php?error=notint");
        exit();

    }elseif ($payeeEmail == "NULL") {
        header("Location: ../add-savings.php?error=choosePayee&payee=".$payeeEmail);
    exit();
    }

    //Create prepared statements for validation

    else{

                // $sql = "INSERT INTO transact (date, amount, payee, type, notes, userId )
                // SELECT '$date','$amount','$payee','$type','$removeSlashes', userId FROM users WHERE users.firstName='$firstName';
                //  ";

                // if (mysqli_query($conn, $sql)) {
                //     header("Location: ../add-savings.php?error=success");
                //     exit();
                // }else{

                //     echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
                //     // header("Location: ../add-savings.php?error=sqlerror");
                //     // exit();
                // }
                $sql = "INSERT INTO transact (date, amount, payeeEmail, type, notes, userId ) SELECT ?,?,?,?,?, userId FROM users WHERE users.email = '$payeeEmail'";
                $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../add-savings.php?error=sqlerror");
            exit();

            // echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "\n";
        }else {

            $removeSlashes = stripslashes($notes);
            mysqli_stmt_bind_param($statement, 'sisss',$date, $amount,$payeeEmail, $type,$removeSlashes);
            mysqli_stmt_execute($statement);
            // echo mysqli_info($conn);

           header("Location: ../add-savings.php?error=success");
            exit();
        }
            }

    mysqli_stmt_close($statement);
    mysqli_close($conn);
}else{
    header("Location: ../add-savings.php");
    exit();
}