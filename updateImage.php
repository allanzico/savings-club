<?php
session_start();
define('included',TRUE);
if (!isset($_SESSION['fName']) || !isset($_SESSION['userID'])) {
  header("Location: 404.php");

}

if(isset($_POST['saveImage'])){
  require 'includes/connection.php';

    $id = $_SESSION['userID'];
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];

    $fileExt = explode('.',$fileName );
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    $fileNameNew = "profile".$id.".".$fileActualExt;
    $fileDestination = 'uploads/'.$fileNameNew;
    if (move_uploaded_file($fileTmpName,$fileDestination)) {
      $updateImg = "UPDATE users SET profileImage=? WHERE userId=$id;";
                $statement = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($statement, $updateImg )){
                        header("Location: updateImage.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($statement,'s', $fileNameNew);
                        mysqli_stmt_execute($statement);
                        echo mysqli_info($conn);
                        header("Location: updateImage.php?error=success");
                        exit();
    }
  }
    mysqli_close($conn);
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
            if ($_GET['error'] == "imgSize") {
                echo ' <div class="alert alert-danger alert-dismissible">Image beyond the 1mb limit
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
            }elseif ($_GET['error'] == "success") {
                echo ' <div class="alert alert-success alert-dismissible">Profile image updated successfully
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            }
        }

        ?>
        <!-- add a trnsaction form starts -->
          <div class="row">
            <div class="col-9 offset-1 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">update Image</h4>
                  <form action="updateImage.php" method="post" class="form-sample" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Image</label>
                          <div class="col-sm-9">
                          <input type="file" name="image" class="form-control" >
                          </div>
                        </div>
                      </div>
                      </div>
                    <button type="submit" class="btn btn-success" name="saveImage">Save</button>
                  </form>
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