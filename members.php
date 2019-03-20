
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
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Club Members</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Admin</th>
                        <th>Select</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                 $id = $_SESSION['userID'];
                 $sql = "SELECT * FROM users WHERE userId <> '$id';";
                 $result = mysqli_query($conn,$sql);
                 $resultCheck = mysqli_num_rows($result); ?>

                 <?php

                 if ($resultCheck>0) {
                   while ($row = mysqli_fetch_assoc($result)) {


                     $firstName = $row['firstName'];
                     $lastName = $row['lastName'];
                     $email = $row['email'];
                     $admin = $row['admin'];
                     $userId = $row['userId'];
                     ?>
                     <tr>
                     <td><?php echo $firstName ?></td>
                     <td><?php echo $lastName ?></td>
                     <td><?php echo  $email ?></td>
                     <td><?php echo $admin ?></td>
                     <td><input type="checkbox" name="select[]" value="<?php echo $userId ?>" ></td>


                     </tr>


                     <?php   }
                } else {
                  echo "No results";
                } ?>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?php
            if(isset($_POST['changeRole'])){
              $role = $_POST['selectRole'];
                  foreach ($_POST['select'] as $selected => $value) {
                    $roleQuery = "UPDATE users SET admin =$role WHERE userId=$value";
                    $QueryResult = mysqli_query($conn, $roleQuery);
                  if($QueryResult === FALSE){
                    echo "Something went wrong." . mysqli_errno($conn) . ":". mysqli_error($conn);
                }else{
                    echo "<h1>Changed</h1>";
                }
                  }


              }

                ?>
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage members</h4>
                  <form action="members.php" method="post"class="form-sample">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Change role</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="selectRole">
                              <option value="Y" >Admin</option>
                              <option value="N" >User</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <div class="form-group row">
                          <div class="col-sm-6">
                            <button class="btn btn-success ">Change
                            <i class="mdi mdi-plus"></i>
                          </div>
                          <div class="col-md-6 col-sm-6">
                          <a href="addNewMember.php" class="btn btn-success">Add new member</a>
                          </div>
                        </div>
                      </div>
                    </div>
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