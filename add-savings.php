
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
        <!-- add a trnsaction form starts -->
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add a transaction</h4>
                  <form action="includes/savings-handler.php" method="post"class="form-sample">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row required">
                          <label class="col-sm-3 col-form-label">Date</label>
                          <div class="col-sm-9">
                          <input type="date" name="transactionDate" class="form-control" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row required">
                          <label class="col-sm-3 col-form-label">Amount</label>
                          <div class="col-sm-9">
                          <input type="text" name="amount" class="form-control" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row required">
                          <label class="col-sm-3 col-form-label">Payee email</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="payeeEmail">
                            <?php
                            require 'includes/connection.php';
                            $sql = "SELECT * FROM users;";
                            $result = mysqli_query($conn,$sql);
                            $resultCheck = mysqli_num_rows($result);
                            ?>

                            <option selected value="NULL">Choose...</option>
                            <?php

                            if ($resultCheck>0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                              $email = $row['email'];
                              $userID = $row ['userID'];
                              ?>
                              <option value="<?php echo $email ?>"><?php  echo $email ?></option>
                              <?php }
                              } ?>


                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row required">
                          <label class="col-sm-3 col-form-label">Paid For</label>
                          <div class="col-sm-9">
                          <select class="form-control" name="paidFor">
                            <option selected value="NULL">Choose...</option>
                            <option value="fine">Fine</option>
                            <option value="subscription">Subscription</option>
                            <option value="savings">Extra</option>
                          </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Payment type</label>
                          <div class="col-sm-9">
                          <select class="form-control" name="selectList">
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
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Notes</label>
                          <div class="col-sm-12">
                          <textarea class="form-control" rows="3" name="notes"></textarea>

                          </div>

                        </div>
                        <label for="required"><span>Required fields:</span><span style="color:#e32"> *</span></label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="saveTransaction">Save</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <?php require 'includes/logout-modal.php' ?>
          <!-- add a transaction form ends -->
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