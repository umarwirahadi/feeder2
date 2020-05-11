<?php 
$namakur=$_GET['idkurikulum'];
require_once('../config/koneksi.php');
$sql="delete from insertmatkulkurikulum";
if($res=$cn->query($sql)){
	//header("location:../index.php?sub=Kurikulum&idkurikulum=input-kurikulum");
	header("location:../index.php?sub=Kurikulum&idkurikulum=".$namakur);
}else{
	header("location:../index.php?sub=Kurikulum&idkurikulum=".$namakur);
	//header("location:../index.php?sub=Kurikulum&idkurikulum=input-kurikulum");
}
?>