<?php 
session_start();
require_once('../config/koneksi.php');
$no=$cn->real_escape_string($_GET['id']);
if($cn->query("delete from mahasiswa where no='$no'")){
header("location:../index.php?sub=list_mahasiswa&list=2");	
}else{
	echo "error :".$cn->error;
}

 ?>