<?php 
session_start();
require_once("../config/koneksi.php");
require_once("../config.php");
$token=$_SESSION['token'];
$data2 =["act"=>"GetPembiayaan","token"=>$token,"filter"=>"","limit"=>0];
$result2=json_decode(runWS($data2));
$sql="";
foreach ($result2->data as $row) {	
	$sql .="insert into getpembiayaan(id_pembiayaan,nama_pembiayaan)values('".$row->id_pembiayaan."','".$row->nama_pembiayaan."');";
}
if(!$cn->multi_query($sql)===true){
	print_r($result2->error_desc);
}
 ?>
