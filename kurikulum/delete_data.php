<?php 
require_once('../config/koneksi.php');
$sql="delete from insertkurikulum";
if($res=$cn->query($sql)){
	header("location:../index.php?sub=Kurikulum&idkurikulum=input-kurikulum");
}else{
	header("location:../index.php?sub=Kurikulum&idkurikulum=input-kurikulum");
}
?>