<?php 
session_start();
require_once("../config/koneksi.php");
require_once("../config.php");
$token=$_SESSION['token'];
$data2 =["act"=>"GetKebutuhanKhusus","token"=>$token,"filter"=>"","limit"=>0];
$result2=json_decode(runWS($data2));
$sql="";
foreach ($result2->data as $row) {	
	$sql .="insert into tb_kebutuhan_khusus(id_kebutuhan_khusus,nama_kebutuhan_khusus)values('".$row->id_kebutuhan_khusus."','".$row->nama_kebutuhan_khusus."');";
	// $cn->query($sql);
}
if($cn->multi_query($sql)===true){
	echo '<script>alert("Sukses mengambil data dari Feeder");</script>';
}else{
	echo "gagal";
}

 ?>
