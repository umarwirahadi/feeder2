<?php 
$no=$_GET['id'];
require_once('../config/koneksi.php');
$sql="delete from krs_mahasiswa where id='$no'";
if($cn->query($sql)){
	$cn->close;
	header("location:../index.php?sub=krs");

}else{
	echo $cn->error;
}
 ?>