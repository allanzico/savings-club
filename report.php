
<?php
session_start();
define('included',TRUE);
require 'includes/connection.php';
if (!isset($_SESSION['fName']) || !isset($_SESSION['userID'])) {
  header("Location: 404.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Capital Link</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
  <?php require 'includes/navbar.php' ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
    <?php require 'includes/sidebar.php' ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Sort data</h5>
                  <div class="fluid-container">
                    <form action="" method="post">
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">From</label>
                            <div class="col-sm-9">
                            <input type="date" name="dateFrom"  class="form-control" >
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label">To</label>
                            <div class="col-sm-9">
                            <input type="date" name="dateTo"  class="form-control" >
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group row">
                            <div class="col-sm-9">
                            <button type="submit" class="btn btn-success" name="sort">Sort</button>
                            <button type="submit" class="btn btn-success" name="reset">Refresh</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                <?php
                      if(isset($_POST['sort'])){
                        $dateFrom = $_POST['dateFrom'];
                        $dateTo = $_POST['dateTo'];
                        $sql = "SELECT * FROM transact, users WHERE users.userId=transact.userId AND date BETWEEN '$dateFrom' AND '$dateTo';";
                        ?>
                      <h4 class="card-title">Savings list From: <span class="text-primary mr-1 mb-0"><?php echo $dateFrom; ?></span> To: <span class="text-primary mr-1 mb-0"> <?php echo $dateFrom; ?></span></h4>
                     <?php }
                     else {
                        $sql = "SELECT * FROM transact, users WHERE users.userId=transact.userId;";
                       ?>
                        <h4 class="card-title">Savings list</h4>
                     <?php }

                        $result = mysqli_query($conn,$sql);
                        $resultCheck = mysqli_num_rows($result);

                         ?>

                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Payee</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Payment type</th>
                        <th>Description</th>
                        <th>Paid For</th>
                        </tr>
                      </thead>
                      <tbody>


                 <?php

                 if ($resultCheck>0) {
                   while ($row = mysqli_fetch_assoc($result)) {

                     $amount = number_format($row['amount']);
                     $date = $row['date'];
                     $type = $row['type'];
                     $description = $row['notes'];
                     $firstName = $row ['firstName'];
                     $lastName = $row ['lastName'];
                     $paidFor =$row['paidFor'];
                     ?>
                     <tr>
                     <td><?php echo $firstName." ".$lastName  ?></td>
                     <td>UGX <?php echo $amount ?></td>
                     <td><?php echo $date ?></td>
                     <td><?php echo $type ?></td>
                     <td><?php echo $description ?></td>
                     <td><?php echo $paidFor ?></td>
                     </tr>

                     <?php }
                } else { ?>
                  <span class="text-danger mr-1 mb-0"><?php echo " No results "?></span>

               <?php } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php require 'includes/logout-modal.php' ?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
        <?php require 'includes/footer.php' ?>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>