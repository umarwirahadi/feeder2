<?php 
require_once('../config/koneksi.php');
$sql="delete from krs_mahasiswa";
if($res=$cn->query($sql)){
	$cn->close;
	header("location:../index.php?sub=krs");
}else{
	$cn->close;
	header("location:../index.php?sub=krs");
}
?>