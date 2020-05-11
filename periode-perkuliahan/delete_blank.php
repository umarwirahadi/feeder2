<?php 
require_once('../config/koneksi.php');
$sql="delete from setting_periode_perkuliahan";
if($res=$cn->query($sql)){
	header("location:../index.php?sub=periodekuliah");
}else{
	header("location:../index.php?sub=periodekuliah");
}
?>