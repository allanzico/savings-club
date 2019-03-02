
<?php

session_start();
define('included',TRUE);
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

  <title>add-savings</title>

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
            <a href="index.php">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">add new member</li>
        </ol>

        </ol>

        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo ' <div class="alert alert-danger alert-dismissible">Fill in all fields
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            }elseif ($_GET['error'] == "choosePayee") {
                echo ' <div class="alert alert-danger alert-dismissible">Select a Payee
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            } elseif ($_GET['error'] == "notint") {
                echo ' <div class="alert alert-danger alert-dismissible">Enter a valid amount
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            }
            elseif ($_GET['error'] == "success") {
                echo ' <div class="alert alert-success role="alert">New member added
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            }
        }

        ?>

        <form action="includes/newMember-Handler.php" method="post" class="signup-form">
        <div class="form-row">


        <div class="form-group col-md-6 ">
        <label for="firstName">First Name: </label>
                <input type="text" name="firstName" id="firstName" class="form-control">
            </div>

        <div class="form-group col-md-6 ">
        <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" class="form-control">
            </div>

            <div class="form-group col-md-12 ">
            <label for="email">Email: </label>
                <input type="email" name="email" id="email" class="form-control">
            </div>

            <div class="form-group col-md-12 ">
            <label for="password">Password: </label>
                <input type="password" name="password" id="password" class="form-control">
</div>
</div>

<div class="form-group">
<label for="password">Confirm password: </label>
                <input type="password" name="repeatPassword" id="password" class="form-control">
  </div>

  <button type="submit" class="btn btn-success" name="submit">Save</button>

        </form>
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
    <?php require 'includes/logout-modal.php' ?>
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
