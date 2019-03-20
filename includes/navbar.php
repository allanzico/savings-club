<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="#">
          <img src="images/test.svg" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="#">
        <img src="images/test.svg" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">

        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">
                <?php
                if (isset($_SESSION['userID'])) {
								echo $_SESSION['fName'];
                } ?>
              </span>
              <?php
                require 'includes/connection.php';
                $id = $_SESSION['userID'];
                  $sql = "SELECT * FROM users WHERE userId=$id;";
                  $result = mysqli_query($conn,$sql);
                  while ($row = mysqli_fetch_array($result)) {
                    $profileImage = $row['profileImage'];
                  }
                  ?>
              <img class="img-xs rounded-circle" src="uploads/<?php echo $profileImage;?>" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <a class="dropdown-item" href="updateImage.php">
                Edit Image
              </a>
              <a class="dropdown-item" href="profile.php">
                Pofile
              </a>
              <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal" href="#">
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>