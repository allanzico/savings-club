<?php
define('included',TRUE);
require 'includes/connection.php';
  if (isset($_GET['delete'])) {
   
    $id = $_GET['delete'];
    $sql="DELETE FROM transact WHERE transact.transactId=$id;";
    $result = mysqli_query($conn,$sql);
    
      header("Location: index.php"); 
  }
 
  
  

