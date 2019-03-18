<?php
session_start();
define('included',TRUE);
require 'includes/connection.php';
if (!isset($_SESSION['fName']) || !isset($_SESSION['userID'])) {
  header("Location: 404.html");
  $id = $_SESSION['userID'];

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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">My total savings</p>
                      <div class="fluid-container">
                        <h4 class="font-weight-medium text-right mb-0">

                        <?php
                            $sql = "SELECT FORMAT (SUM(amount),0) AS total_savings FROM transact WHERE transact.userId = $id;";
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
                  <p class="text-muted mt-3 mb-0">
                    <!-- <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 65% lower growth -->
                  </p>
                </div>
              </div>
            </div>
            <div class="col-9 grid-margin">
              <div class="card">
                <div class="card-body">
                 <?php

                  $sql = "SELECT * FROM users WHERE userId =$id;";
                  $result = mysqli_query($conn,$sql);
                  $resultCheck = mysqli_num_rows($result);



                  if ($resultCheck>0) {
                    while ($row = mysqli_fetch_assoc($result)) {


                      $firstName = $row['firstName'];
                      $lastName = $row['lastName'];
                      $email = $row['email'];
                    }
                  }
                       ?>
                  <div class="card-title mb-4 text-primary"><h2><?php echo $firstName." ".$lastName; ?></h2></div>
                  <div class="fluid-container">
                    <div class="row ticket-card mt-3">
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap"><?php echo $email; ?></p>
                        </div>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-12 d-flex">
                            <small class="mb-0 mr-2 text-muted">Last responded :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted">3 hours ago</small>
                          </div>
                        </div>
                      </div>
                      <div class="ticket-actions col-md-2">
                        <div class="btn-group">
                          <a href="editProfile.php" class="btn btn-primary" aria-haspopup="true" aria-expanded="false">
                            Edit profile
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">My savings list</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Payment type</th>
                        <th>Description</th>
                        <th>Paid For</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                 $sql = "SELECT * FROM transact WHERE userId = $id;";
                 $result = mysqli_query($conn,$sql);
                 $resultCheck = mysqli_num_rows($result); ?>

                 <?php

                 if ($resultCheck>0) {
                   while ($row = mysqli_fetch_assoc($result)) {

                     $amount = number_format($row['amount']);
                     $date = $row['date'];
                     $type = $row['type'];
                     $description = $row['notes'];
                     $paidFor =$row['paidFor'];
                     ?>
                     <tr>
                     <td><?php echo $date ?></td>
                     <td>UGX <?php echo $amount ?></td>
                     <td><?php echo $type ?></td>
                     <td><?php echo $description ?></td>
                     <td><?php echo $paidFor ?></td>


                     </tr>

                     <?php   }
                } else{ ?>
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