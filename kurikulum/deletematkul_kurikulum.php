<?php 
$no=$_GET['id'];
$namakur=$_GET['idkurikulum'];
require_once('../config/koneksi.php');
$sql="delete from insertmatkulkurikulum where id='$no'";
if($cn->query($sql)){
	$cn->close;
	header("location:../index.php?sub=Kurikulum&idkurikulum=".$namakur);

}else{
	echo $cn->error;
}
 ?>