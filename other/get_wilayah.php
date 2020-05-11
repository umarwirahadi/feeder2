<?php
session_start(); 
$token=$_SESSION['token'];
require_once("../config/koneksi.php");
require_once("../config.php");
$data2 =
[
  "act"=>"GetWilayah",
  "token"=>$token,
  "filter"=>"id_negara='ID'",
  "limit"=>""
];

$result2=json_decode(runWS($data2));
$sql="";
foreach ($result2->data as $row1) {
	$sqla="select * from GetWilayah where id_wilayah='$row1->id_wilayah'";
	$res=$cn->query($sqla);
	if($res->num_rows==0){
		$sql .="insert into GetWilayah(id_wilayah,id_negara,nama_wilayah) values('$row1->id_wilayah','$row1->id_negara','$row1->nama_wilayah');";
	}
}
if($cn->multi_query($sql)===true){
	header("location:../index.php?sub=wil");
}else{
	header("location:../index.php?sub=wil");
}
?>