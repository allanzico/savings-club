
  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

<a class="navbar-brand mr-1" href="/index.php">Capital Link</a>

<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
  <i class="fas fa-bars"></i>
</button>

<!-- Navbar -->
<ul class="navbar-nav ml-auto ml-md-0" >

				<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				 <img src="assets/img/user.png" class="img-circle" alt="Avatar">
				 <span>
							<?php if (isset($_SESSION['userID'])) {
								echo $_SESSION['fName'];
							} ?> 
						</span>
				</a>
				
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="#">profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
        </div>
      </li>
</ul>

</nav>