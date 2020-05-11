<?php 
require_once('../config/koneksi.php');
$sql="delete from getDetailNilaiPerkuliahanKelas";
if($res=$cn->query($sql)){
	$cn->close;
	header("location:../index.php?sub=nilaimhs");
}else{
	$cn->close;
	header("location:../index.php?sub=nilaimhs");
}
?>