<?php 
require_once('../config/koneksi.php');
$sql="delete from insertmahasiswalulusdo";
if($res=$cn->query($sql)){
	header("location:../index.php?sub=mhs_lulus");
}else{
	header("location:../index.php?sub=mhs_lulus");
}
?>