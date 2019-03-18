<?php
session_start();
define('included',TRUE);
if (!isset($_SESSION['fName']) || !isset($_SESSION['userID'])) {
  header("Location: 404.php");
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
            }elseif ($_GET['error'] == "invalidemail") {
                echo ' <div class="alert alert-danger alert-dismissible">Enter a valid email
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            } elseif ($_GET['error'] == "invalidname") {
                echo ' <div class="alert alert-danger alert-dismissible">Enter a valid name
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            }elseif ($_GET['error'] == "usertaken") {
                echo ' <div class="alert alert-danger alert-dismissible">Email is taken
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
                <?php
                  require 'includes/connection.php';
                  $sql = "SELECT * FROM users WHERE userId=$id;";
                  $result = mysqli_query($conn,$sql);
                  while ($row = mysqli_fetch_array($result)) {
                    $firstName = $row['firstName'];
                    $lastName = $row['lastName'];
                    $email = $row['email'];
                  }
                  ?>
                  <h4 class="card-title">Edit My Profile</h4>
                  <form action="editProfile.php" method="post" class="form-sample">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">First name</label>
                          <div class="col-sm-9">
                          <input type="text" name="firstName" id="firstName" value="<?php echo $firstName ?>" class="form-control" >
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Last name</label>
                          <div class="col-sm-9">
                          <input type="text" name="lName" id="lastName" value="<?php echo $lastName ?>" class="form-control" >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                          <input type="email" name="email" id="email" value="<?php echo $email ?>" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="update">Update</button>
                  </form>
                </div>
              </div>
            </div>
            <?php
            ob_start();
            if(isset($_POST['update'])){
                    require 'includes/connection.php';
                    $firstName = $_POST['firstName'];
                    $lastName = $_POST['lName'];
                    $email = $_POST['email'];

                    //Check if anything is empty
                    if(empty($firstName)|| empty($lastName) || empty($email)){
                        header("Location: editProfile.php?error=emptyfields&firstName=".$firstName."&lastName=".$lastName."&email".$email);
                    exit();

                    //Check for validation
                    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        header("Location: editProfile.php?error=invalidemail");
                        exit();
                    }
                    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $firstName)) {
                        header("Location: editProfile.php?error=invalidname&email=".$email);
                    exit();
                    }elseif (!preg_match("/^[a-zA-Z0-9]*$/",$lastName)) {
                      header("Location: ../register.php?error=invalidname&email=".$email);
                  exit();
                  }
                    //Create prepared statements for validation
                    else {
                        $selectQuery = "SELECT * FROM users WHERE email=?";
                        $statement = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($statement, $selectQuery)){
                            header("Location: editProfile.php?error=sqlerror");
                            exit();
                        }else{
                            mysqli_stmt_bind_param($statement, "s", $email);
                            mysqli_stmt_execute($statement);
                            mysqli_stmt_store_result($statement);
                            $resultCheck = mysqli_stmt_num_rows($statement);
                            if($resultCheck > 0){
                             header("Location: editProfile.php?error=usertaken&firstName=".$firstName."&lastName=".$lastName."&email=".$email);
                             exit();
                            }else{
                                $insertQuery = "INSERT INTO users (firstName, lastName, email) VALUES (?,?,?);";
                                $statement = mysqli_stmt_init($conn);
                                    if(!mysqli_stmt_prepare($statement, $insertQuery)){
                                        header("Location: editProfile.php?error=sqlerror");
                                        exit();
                                    }else {
                                        mysqli_stmt_bind_param($statement,'sss', $firstName, $lastName , $email);
                                        mysqli_stmt_execute($statement);
                                        header("Location: profile.php?error=success");
                                        unset($_POST);
                                        exit();
                                    }
                            }
                        }
                    }
                    mysqli_stmt_close($statement);
                    mysqli_close($conn);
                }
                ob_end_flush(); ?>
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