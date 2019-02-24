
<?php
require 'includes/connection.php';
$id=$_GET['edit'];
$sql = "SELECT * FROM transact where id=$id;"; 
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Capital Link</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
<?php require 'includes/header.php' ?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php require 'includes/sidebar.php' ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Update Deposit</a>
          </li>
         
        </ol>

        <?php 

if(isset($_POST['updateTransaction'])){
    

    $date = $_POST['transactionDate'];
    $amount = $_POST['amount'];
    $payee = $_POST['payee'];
    $type = $_POST['selectList'];
    $notes = $_POST['notes'];

    //Check if anything is empty
    if(empty($date)|| empty($amount) || empty($payee)){
        header("Location: ../update.php?error=emptyfields&date=".$date."&amount=".$amount."&payee".$payee."&notes".$notes."&type".$type);
    exit();

    //Check for validation
    }elseif(!preg_match("/^[1-9][0-9]*$/", $amount)){
        header("Location: ../update.php?error=notint");
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $payee)) {
        header("Location: ../update.php?error=invalidtext&payee=".$payee);
    exit();
    }

    //Create prepared statements for validation
    else{
                $sql = "UPDATE transact SET date = ?, amount=?, payee=?, type=?, notes=? WHERE transactId=$id";
                $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: update.php?error=sqlerror");
            exit();
        }else {
            $removeSlashes = stripslashes($notes);
            mysqli_stmt_bind_param($statement, "sisss",$date, $amount,$payee, $type,$removeSlashes);
            mysqli_stmt_execute($statement);
            header("Location: update.php?error=success");
            exit();
        }
            }
        
    mysqli_stmt_close($statement);
    mysqli_close($conn);
}else{ ?>
  <form action="update.php" method="post" class="signup-form">
  <div class="form-row">

  
  <div class="form-group col-md-2 required">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
          <label for="date">Date</label>
          <input type="date" name="transactionDate" class="form-control" value="<?php echo $date; ?>" >
      </div>
  
  <div class="form-group col-md-2 required">
          <label for="Amount">Amount </label>
          <input type="text" name="amount" class="form-control" value="<?php echo $amount; ?>">
      </div>

      <div class="form-group col-md-4 required">
          <label for="email">Payee: </label>
          <input type="text" name="payee" id="email" class="form-control" value="<?php echo $payee; ?>">
      </div>

      <div class="form-group col-md-4">
<label for="sel1">Payment type</label>
<select class="form-control" name="selectList" value="<?php echo $type; ?>">
<option selected value="NULL">Choose...</option>
<option value="cash">cash</option>
<option value="cheque">cheque</option>
<option value="MTN Mobile Money">MTN Mobile Money</option>
<option value="Airtel Money">Airtel Money</option>
<option value="credit card">credit card</option>
<option value="EFT">EFT</option>

</select>
</div> 
</div>

<div class="form-group">
<label for="exampleFormControlTextarea1">Notes</label>
<textarea class="form-control" rows="3" name="notes" value="<?php echo $notes; ?>"></textarea>
<label for="required"><span>Required fields:</span><span style="color:#e32"> *</span></label>
</div>

      <button type="submit" class="btn btn-success" name="updateTransaction">Update</button>
      
  </form>
    
<?php exit();} ?>

?>

      
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
