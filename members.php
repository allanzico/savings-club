
<?php
session_start();
define('included',TRUE);
require 'includes/connection.php';
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

  <title>Capital Link</title>

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
          <li class="breadcrumb-item active">Members</li>
        </ol>

        <!-- Icon Cards-->

        <!-- DataTables Example -->
        <form action="members.php" method="POST">
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
           Members

            </div>
          <div class="card-body">

            <div class="table-responsive">

              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>

                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Admin</th>
                    <th>Select </th>


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
                     <td><input type="checkbox" name="select" value="<?php echo $userId ?>" ></td>


                     </tr>


                     <?php   }
                } ?>


                </tbody>
              </table>

            </div>

          </div>




        </div>
        </form>
        <?php
    if(isset($_POST['changeRole'])){

      if (!empty($_POST['select'])) {
        $selected = $_POST['select'];

          $roleQuery = "UPDATE 'users SET admin ='Y' WHERE userId=$selected";
          $QueryResult = mysqli_query($conn, $roleQuery);
          if($QueryResult === FALSE){
              echo "Something went wrong." . mysqli_errno($conn) . ":". mysqli_error($conn);
          }else{
              echo "<h1>Changed</h1>";
          }


      }
    }
        ?>

<form class="form-inline" action="members.php" method="POST">
  <div class="form-group mb-2">
  <label for="select role">Change user role</label>
  <select class="form-control" name="selectRole">
                <option selected value="NULL">Choose...</option>
                <option value="admin" >Admin</option>
                <option value="user" >User</option>


                  </select>
    </div>

  <button type="submit" class="btn btn-primary mb-2" name="changeRole">Change</button>
  <label for="add new">Add new User</label>
  <a href="addNewMember.php" class="btn btn-primary mb-2">Add</a>
</form>
      </div>
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

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php require 'includes/logout-modal.php' ?>

  </div>

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

  <!-- <script type = "text/javascript">

            function getConfirmation() {
               var retVal = confirm("Are you sure you want to delete this row?");
               if( retVal == true ) {
                window.location.href = 'delete.php';
                  return true;
               } else {
                window.location.href = 'index.php';
                  return false;
               }
            }

      </script>  -->

</body>
</html>