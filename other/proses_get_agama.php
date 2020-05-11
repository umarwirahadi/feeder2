<?php 
session_start();
require_once("../config/koneksi.php");
require_once("../config.php");
$token=$_SESSION['token'];
$data2 =["act"=>"GetAgama","token"=>$token,"filter"=>"","limit"=>0];
$result2=json_decode(runWS($data2));
$sql="";
foreach ($result2->data as $row) {	
	$sql .="insert into GetAgama(id_agama,nama_agama)values('".$row->id_agama."','".$row->nama_agama."');";
}
if($cn->multi_query($sql)===true){
	echo '<script>alert("Sukses mengambil data dari Feeder");</script>';
	header('location:index.php?sub=agama');
}else{
	echo "Data agama gagal diupdate";
}

 ?>
