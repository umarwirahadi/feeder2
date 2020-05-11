<?php 
require_once('../config/koneksi.php');
$sql="delete from insertdosenpengajarkelaskuliah";
if($res=$cn->query($sql)){
	header("location:../index.php?sub=dosen");
}else{
	header("location:../index.php?sub=dosen");
}
?>