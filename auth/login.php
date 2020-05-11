
<?php
// error_reporting(0);
session_start();
// if(($_SESSION['gagal'])==100){
//   // echo '<script>window.location.href="index.php?sub=login"</script>';
//   echo '<a href="auth/login.php">form login</a>';
//   $data1=$_SESSION['token'];
//   echo $data1;
//   // echo "Token sudah expired";
// }else{
// include("config/koneksi.php");
//  echo $_SESSION['gagal'];
include("../config/koneksi.php");
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Feeder</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="../assets/js/jquery.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <style>
    table td{
            white-space: nowrap;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <img src="../assets/piksi1.png" width="80" height="80"><!-- <a class="navbar-brand" href="#">POLITEKNIK PIKSI GANESHA</a> -->
    </div>    
    <div class="nav navbar-nav navbar-right">
      <img src="../assets/ristekdikti.png" width="80" height="80">
    </div>
  </div>
</nav>

<!-- ///// -->

<div class="col-md-4 col-md-offset-4">
  <div class="panel-group">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h4><i class="  glyphicon glyphicon-edit"></i> Excel Feeder Importer</h4>
      </div>
      <div class="panel-body">
          
      </div>
  <form action="act_login.php" method="POST">
    <div class="input-group">
      <!-- <label for="userID">Kode PT</label> -->
      <span  class="input-group-addon"><i class="glyphicon glyphicon-user"></i> Kode PT</span><input type="text" class="form-control" id="userID" placeholder="Kode Kampus" name="userID">
    </div>
    <div class="input-group">
      <!-- <label for="pwd">Password</label> -->
      <span  class="input-group-addon"><i class="glyphicon glyphicon-lock"></i> Pass PT</span><input type="password" class="form-control" id="pwd" placeholder="password" name="pwd">
    </div>    
    <button type="submit" class="btn btn-md btn-primary">Login</button>
  </form>
</div> <!--panel default -->
</div>
</div>