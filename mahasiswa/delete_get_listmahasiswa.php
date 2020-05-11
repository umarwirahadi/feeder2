<?php 
$no=$_GET['id'];
require_once('../config/koneksi.php');
$sql="delete from GetListMahasiswa";
if($cn->query($sql)){
	$cn->close;
	header("location:../index.php?sub=list_mahasiswa");
}
 ?>