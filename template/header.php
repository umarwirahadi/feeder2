<!DOCTYPE html>
<html lang="en">
<head>
  <title>Feeder</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <style>
    table.td{
      style="white-space: nowrap;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">POLITEKNIK PIKSI GANESHA</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#" onclick="<script>window.location.href='index.php';</script>">Home</a></li>
      <li><a href="/mahasiswa/list_mahasiswa.php">Mahasiswa</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Perkuliahan <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="#"><span class="glyphicon glyphicon-duplicate"></span> Mata kuliah</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-equalizer"></span> Kurikulum</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-compressed"></span> Kelas perkuliahan</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-new-window"></span> Input KRS</a></li>
          <li><a href="#"><span class="glyphicon glyphicon-random"></span> Input Nilai Mahasiswa</a></li>
        </ul>
      </li>
      <li><a href="#">Page 2</a></li>
      <li><a href="#">Page 3</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="../auth/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>  
<div class="container">
