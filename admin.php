
<?php
session_start();
define('included',TRUE);
require 'includes/connection.php';
if (!isset($_SESSION['fName']) || !isset($_SESSION['userID'])) {
  header("Location: 404.html");
}


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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/cosmo/bootstrap.min.css">

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
            <a href="admin.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Overview</li>
        </ol>

        <!-- Icon Cards-->
        <div class="row">
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-primary o-hidden h-100">
              <div class="card-body">
              <h5 class="card-title">Total savings</h5>
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-hand-holding-usd"></i>
                </div>
                <h4 class="card-text">
                  <?php

                  $sql = "SELECT FORMAT (SUM(amount), 3) AS total_savings FROM transact;";
                  $result = mysqli_query($conn,$sql);
                  $resultCheck = mysqli_num_rows($result);

                  if ($resultCheck>0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                     $total_savings = $row['total_savings'];


                      echo "UGX " .$total_savings;
                    }
                  }

                  ?>
                </h4>
              </div>

            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body align-items-center d-flex justify-content-center">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-users"></i>
                </div>
                <div class="mr-5">
                <?php

                  $sql = "SELECT COUNT(firstName) AS total_members FROM users;";
                  $result = mysqli_query($conn,$sql);
                  $resultCheck = mysqli_num_rows($result);

                  if ($resultCheck>0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                     $total_members = $row['total_members'];
                     ?>
                     <span class="index-cards"><?php echo $total_members." Users" ?></span>
                     <?php   }
                  }

                  ?>

                </div>
              </div>

            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-success o-hidden h-100">
              <div class="card-body align-items-center d-flex justify-content-center">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">123 New Orders!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-3">
            <div class="card text-white bg-danger o-hidden h-100">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">13 New Tickets!</div>
              </div>
              <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                  <i class="fas fa-angle-right"></i>
                </span>
              </a>
            </div>
          </div>
        </div>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Overview

            </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>

                    <th>Payee</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Payment type</th>
                    <th>Description</th>
                    <th>Update</th>

                  </tr>
                </thead>

                <tbody>
                 <?php
                 $sql = "SELECT * FROM transact, users WHERE users.userId=transact.userId;";
                 $result = mysqli_query($conn,$sql);
                 $resultCheck = mysqli_num_rows($result); ?>

                 <?php

                 if ($resultCheck>0) {
                   while ($row = mysqli_fetch_assoc($result)) {

                     $amount = $row['amount'];
                     $date = $row['date'];
                     $type = $row['type'];
                     $description = $row['notes'];
                     $firstName = $row ['firstName'];
                     $lastName = $row ['lastName'];
                     ?>
                     <tr>
                     <td><?php echo $firstName." ".$lastName  ?></td>
                     <td><?php echo $amount ?></td>
                     <td><?php echo $date ?></td>
                     <td><?php echo $type ?></td>
                     <td><?php echo $description ?></td>
                     <td>

                     <a href="update.php?edit=<?php echo $row['transactId']; ?>"><span style=" color: 	#4169E1 ;"><i class="far fa-edit "></span></i></a> |
                     <a href="delete.php?delete=<?php echo $row['transactId']; ?>"  ><span style=" color: 	#FF0000 ;"><i class="fas fa-trash-alt"></span></i></a>
                    </td>

                     </tr>

                     <?php   }
                } ?>


                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>

      </div>
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

  <?php require 'includes/logout-modal.php' ?>

  </div>

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

  <script type = "text/javascript">

            function getConfirmation() {
               var retVal = confirm("Are you sure you want to delete this row?");
               if( retVal == true ) {
                window.location.href = 'delete.php';
                  return true;
               } else {
                window.location.href = 'index.php';
                  return false;
               }
            }

      </script>

</body>

</html>
