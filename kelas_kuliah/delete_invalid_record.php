<?php 
require_once('../config/koneksi.php');
$sql="delete from krs_mahasiswa where id_registrasi_mahasiswa IS NULL or id_kelas_kuliah IS NULL or id_kelas_kuliah='' or id_registrasi_mahasiswa=''";
if($cn->query($sql)){
	header("location:../index.php?sub=krs");
}else{
	echo $cn->error;
	// $cn->close;
}
 ?>