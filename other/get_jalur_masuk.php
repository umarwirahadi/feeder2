<?php 
session_start();
require_once("../config/koneksi.php");
require_once("../config.php");
$token=$_SESSION['token'];
$data2 =["act"=>"GetJalurMasuk","token"=>$token,"filter"=>"","limit"=>0];
$result2=json_decode(runWS($data2));
$sql="";
foreach ($result2->data as $row) {	
	$sql .="insert into GetJalurMasuk(id_jalur_masuk,nama_jalur_masuk)values('".$row->id_jalur_masuk."','".$row->nama_jalur_masuk."');";
	// $cn->query($sql);
}
if($cn->multi_query($sql)===true){
	echo "<script>alert('Sukses mengambil data dari Feeder');</script>";
	header("location:index.php?sub=jalurmasuk");
}else{
	echo "Data gagal diupdate";
}

 ?>
