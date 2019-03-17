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
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <h2 class="text-center mb-4">Register</h2>
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
            elseif ($_GET['error'] == "success") {
                echo ' <div class="alert alert-success role="alert">Registration successful
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
                </button>

            </div>';
            }
        }

        ?>
            <div class="auto-form-wrapper">
              <form action="includes/signup-handler.php" method="post" class="signup-form">
              <div class="form-group">
                  <input type="text" name="firstName" id="firstName" class="form-control" placeholder="first name">
              </div>
              <div class="form-group">
                  <input type="text" name="lastName" id="lastName" class="form-control"  placeholder="last name">
              </div>

              <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control"  placeholder="email address">
              </div>

              <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control"  placeholder="password">
              </div>

              <div class="form-group">
                  <input type="password" name="repeatPassword" id="password" class="form-control"  placeholder="confirm password">
              </div>

              <button type="submit" class="btn btn-success" name="submit">Sign up</button>

              </form>
                <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Already have an account ?</span>
                    <a href="login.php" class="text-small">Login</a>
                </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
</body>

</html>