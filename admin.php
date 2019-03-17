
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
                      <p class="mb-0 text-right">Total Revenue</p>
                      <div class="fluid-container">
                        <h4 class="font-weight-medium text-right mb-0">

                        <?php

                            $sql = "SELECT FORMAT (SUM(amount),0) AS total_savings FROM transact;";
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
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 65% lower growth
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi mdi-account-multiple-outline icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Members</p>
                      <div class="fluid-container">
                              <?php

                          $sql = "SELECT COUNT(firstName) AS total_members FROM users;";
                          $result = mysqli_query($conn,$sql);
                          $resultCheck = mysqli_num_rows($result);

                          if ($resultCheck>0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                            $total_members = $row['total_members'];
                            ?>
                            <h3 class="font-weight-medium text-right mb-0"><?php echo $total_members;?></h3>
                            <?php   }
                          }

                          ?>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Sales</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">5693</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> Weekly Sales
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Employees</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0">246</h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Product-wise sales
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Manage Tickets</h5>
                  <div class="fluid-container">
                    <div class="row ticket-card mt-3">
                      <div class="col-md-1">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="images/faces/face3.jpg" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">John Doe :</p>
                          <p class="text-primary mr-1 mb-0">[#23246]</p>
                          <p class="mb-0 ellipsis">Mauris blandit aliquet elit, eget tincidunt nibh pulvinar.</p>
                        </div>
                        <p class="text-gray ellipsis mb-2">Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Lorem ipsum dolor sit amet.</p>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted">Last responded :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted">3 hours ago</small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted">Due in :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted">2 Days</small>
                          </div>
                        </div>
                      </div>
                      <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-reply fa-fw"></i>Quick reply</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw"></i>Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-check text-success fa-fw"></i>Resolve Issue</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-times text-danger fa-fw"></i>Close Issue</a>
                          </div>
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
                  <h4 class="card-title">Savings list</h4>
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
                     <td>

                     <a href="update.php?edit=<?php echo $row['transactId']; ?>"><span style=" color: 	#4169E1 ;"><i class="far fa-edit "></span></i></a> |
                     <a href="delete.php?delete=<?php echo $row['transactId']; ?>"  ><span style=" color: 	#FF0000 ;"><i class="fas fa-trash-alt"></span></i></a>
                    </td>

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