
<?php

session_start();
define('included',TRUE);
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
            } elseif ($_GET['error'] == "chooseReason") {
              echo ' <div class="alert alert-danger alert-dismissible">Select the reason for payment
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true">&times;</span>
              </button>

          </div>';
          }
            elseif ($_GET['error'] == "notint") {
                echo ' <div class="alert alert-danger alert-dismissible">Enter a valid amount
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            }elseif ($_GET['error'] == "laterDate") {
              echo ' <div class="alert alert-danger alert-dismissible">Date can not be beyond today
              <button type="button" class="close" data-dismiss="alert" aria-label="close">
              <span aria-hidden="true">&times;</span>
              </button>

          </div>';
          }
            elseif ($_GET['error'] == "success") {
                echo ' <div class="alert alert-success role="alert">Transaction recorded successfully
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            }
        }

        ?>
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
            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                  <h4 class="card-title">Record Petty Cash</h4>
                  <form action="includes/pettyCash-handler.php" method="post"class="form-sample">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Date</label>
                          <div class="col-sm-9">
                          <input type="date" name="pettyCashDate" class="form-control" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-4 col-form-label">Amount</label>
                          <div class="col-sm-9">
                          <input type="text" name="credit" class="form-control" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="depositPettyCash">Deposit petty cash</button>
                  </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- add Expenditure form starts -->
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Record Expenditure</h4>
                  <form action="includes/expenditure-handler.php" method="post"class="form-sample">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Date</label>
                          <div class="col-sm-9">
                          <input type="date" name="dateExpenditure" class="form-control" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Amount</label>
                          <div class="col-sm-9">
                          <input type="text" name="debit" class="form-control" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Notes</label>
                          <div class="col-sm-6">
                          <textarea class="form-control" rows="3" name="notes"></textarea>

                          </div>

                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-danger" name="addExpenditure">Add expenditure</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php require 'includes/logout-modal.php' ?>
          <!-- add a transaction form ends -->
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Balance Sheet</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Debit (UGX)</th>
                        <th>Credit (UGX)</th>
                        <th>Balance (UGX)</th>
                        <th>Description</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                $sql =
                "SELECT date, type,debit,credit,notes,@balance := @balance + p.credit - p.debit AS balance
                FROM
                  (SELECT @balance := 0) AS initial
                  CROSS JOIN
                    pettycash AS p
                ORDER BY
                date;";

                 $result = mysqli_query($conn,$sql);
                 $resultCheck = mysqli_num_rows($result); ?>

                 <?php

                 if ($resultCheck>0) {
                   while ($row = mysqli_fetch_assoc($result)) {

                     $date = $row['date'];
                     $type = $row['type'];
                     $debit = number_format($row['debit']);
                     $credit = number_format($row['credit']);
                     $balance =number_format($row['balance']) ;
                     $description = $row['notes'];
                     ?>
                     <tr>
                     <td><?php echo $date ?></td>
                     <td><?php echo $type ?></td>
                     <td><?php echo $debit ?></td>
                     <td><?php echo $credit ?></td>
                     <td><?php echo $balance ?></td>
                     <td><?php echo $description ?></td>

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