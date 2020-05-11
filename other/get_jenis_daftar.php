<?php 
session_start();
require_once("../config/koneksi.php");
require_once("../config.php");
$token=$_SESSION['token'];
$data2 =["act"=>"GetJenisPendaftaran","token"=>$token,"filter"=>"","limit"=>0];
$result2=json_decode(runWS($data2));
$sql="";
foreach ($result2->data as $row) {	
	$sql .="insert into GetJenisPendaftaran(id_jenis_daftar,nama_jenis_daftar)values('".$row->id_jenis_daftar."','".$row->nama_jenis_daftar."');";
}
if(!$cn->multi_query($sql)===true){
	print_r($result2->error_desc);
}
 ?>
