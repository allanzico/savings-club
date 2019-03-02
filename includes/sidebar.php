
<?php 
                 
                 require 'connection.php';
                  $id = $_SESSION['userID'];
                  $sql = "SELECT * FROM users WHERE userId =$id;";
                  $result = mysqli_query($conn,$sql);
                  $resultCheck = mysqli_num_rows($result); 
                
                  if ($resultCheck>0) {
                    while ($row = mysqli_fetch_assoc($result)) { 
                      $firstName = $row['firstName'];
                      $lastName = $row['lastName'];
                      $email = $row['email'];
                      $admin = $row ['admin'];
                    
                    }}
                                       ?>
                


<ul class="sidebar navbar-nav">
      <li class="nav-item active">
        <?php if ($admin == 'N') { ?>
<a class="nav-link" href="./user.php">
<i class="fas fa-fw fa-tachometer-alt"></i>
<span>Dashboard</span>
</a>

       <?php }else { ?>
        <a class="nav-link" href="./admin.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>

      <?php  }
          
         ?>
        
      </li>
      <?php if ($admin == 'Y') { ?>
      <li class="nav-item">
        <a class="nav-link" href="charts.html">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Charts</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="add-savings.php">
          <i class="fas fa-plus"></i>
          <span>Add Transaction</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">
          <i class="fas fa-users"></i>
          <span>My profile</span></a>
      <li class="nav-item">
        <a class="nav-link" href="members.php">
          <i class="fas fa-users"></i>
          <span>Members</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="tables.html">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span></a>
      </li>

      <?php } else { ?>

        <li class="nav-item">
        <a class="nav-link" href="profile.php">
          <i class="fas fa-users"></i>
          <span>My profile</span></a>

          <li class="nav-item">
        <a class="nav-link" href="members.php">
          <i class="fas fa-users"></i>
          <span>Members</span></a>
      </li>

    <?php  } ?>
    </ul>