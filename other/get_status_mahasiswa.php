<?php
session_start(); 
$token=$_SESSION['token'];
require_once("../config/koneksi.php");
require_once("../config.php");
$data2 =
[
  "act"=>"GetStatusMahasiswa",
  "token"=>$token,
  "filter"=>"",
  "limit"=>""];

$result2=json_decode(runWS($data2));
$sql="";
foreach ($result2->data as $row1) {
	$sqla="select * from GetStatusMahasiswa where id_status_mahasiswa='$row1->id_status_mahasiswa'";
	$res=$cn->query($sqla);
	if($res->num_rows==0){
		$sql .="insert into GetStatusMahasiswa(id_status_mahasiswa,nama_status_mahasiswa) values('$row1->id_status_mahasiswa','$row1->nama_status_mahasiswa');";
	}
}
if($cn->multi_query($sql)===true){
	header("location:../index.php?sub=statusmhs");
}else{
	header("location:../index.php?sub=statusmhs");
}
?>