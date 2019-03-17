
<?php
session_start();
define('included',TRUE);
ob_start();
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
                echo ' <div class="alert alert-danger alert-dismissible">Fill in all required fields
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
                  <h4 class="card-title">Edit transaction</h4>
                  <form action="<?php $_PHP_SELF ?>" method="post"class="form-sample">
                  <?php
                  require 'includes/connection.php';
                  $sql = "SELECT * FROM transact;";
                  $result = mysqli_query($conn,$sql);
                  while ($row = mysqli_fetch_array($result)) {

                    $ID = $row['transactId'];
                    $amount = $row['amount'];
                    $date = $row['date'];
                    $type = $row['type'];
                    $paidFor = $row['paidFor'];
                    $description = $row['notes'];
                  }
                  ?>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row required">
                          <label class="col-sm-3 col-form-label">Date</label>
                          <div class="col-sm-9">
                          <input type="hidden" name="ID" class="form-control" value="<?php echo $ID ?>" >
                          <input type="date" name="transactionDate" value="<?php echo $date; ?>" class="form-control" >

                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row required">
                          <label class="col-sm-3 col-form-label">Amount</label>
                          <div class="col-sm-9">
                          <input type="text" name="amount" value="<?php echo $amount; ?>" class="form-control" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Payment type</label>
                          <div class="col-sm-9">
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
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Notes</label>
                          <div class="col-sm-12">
                          <textarea class="form-control" rows="3" name="notes" ><?php echo $description; ?></textarea>
                          </div>

                        </div>
                        <label for="required"><span>Required fields:</span><span style="color:#e32"> *</span></label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="updateTransaction">Update</button>
                  </form>

                  <?php
                    if(isset($_POST['updateTransaction'])){
                      require 'includes/connection.php';

                        $id = $_POST ['ID'];
                        $date = $_POST['transactionDate'];
                        $amount = $_POST['amount'];
                        $type = $_POST['selectList'];
                        $notes = $_POST['notes'];

                        //Check if anything is empty
                        if(empty($date)|| empty($amount)){
                            header("Location: update.php?error=emptyfields&date=".$date."&amount=".$amount."&notes".$notes."&type".$type);
                        exit();

                        //Check for validation
                        }elseif(!preg_match("/^[1-9][0-9]*$/", $amount)){
                            header("Location: update.php?error=notint");
                            exit();
                        }

                        //Create prepared statements for validation
                        else{
                                    $sql = "UPDATE transact SET date =?, amount=?, type=?, notes=? WHERE transactId=$id";
                                    $statement = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($statement, $sql)){
                                header("Location: update.php?error=sqlerror");
                                exit();
                            }else {
                                $removeSlashes = stripslashes($notes);
                                mysqli_stmt_bind_param($statement, "siss",$date, $amount, $type,$removeSlashes);
                                mysqli_stmt_execute($statement);
                                header("Location: admin.php");
                            }
                            mysqli_stmt_close($statement);
                            mysqli_close($conn);
                          }
                    }?>
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