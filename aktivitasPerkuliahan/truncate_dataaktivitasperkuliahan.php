<?php 
require_once('../config/koneksi.php');
$sql="delete from insertPerkuliahanMahasiswa";
if($res=$cn->query($sql)){
	header("location:../index.php?sub=aktivitasmhs");
}else{
	header("location:../index.php?sub=aktivitasmhs");
}
?>