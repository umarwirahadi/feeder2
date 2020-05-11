<?php 
require_once('../config/koneksi.php');
$sql="delete from kelas_kuliah";
if($res=$cn->query($sql)){
	header("location:../index.php?sub=kelaskuliah");
}else{
	header("location:../index.php?sub=kelaskuliah");
}
?>