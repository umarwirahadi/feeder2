<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select npm from history_pendidikan_mahasiswa where status='0'";
if($data=$cn->query($sql)){
	if($data->num_rows>0){
		while ($rw=$data->fetch_assoc()){
		$act		="GetListMahasiswa";
		$filter		="id_mahasiswa='2af8388e-1a13-4717-a025-38619122b174'";
		$order 		="";
		$limit 		="";
		$offset 	="";
		$ws=array("act"=>$act,
					"token"=>$token,
					"filter"=>$filter,
					"order"=>$order,
					"limit"=>$limit,
					"offset"=>$offset);
		$hasil=json_decode(RunWS($ws));
		// if($hasil->error_code=0){
		// 	foreach ($hs=$hasil->data) {
		// 		$id_mhs=$hs->id_mahasiswa;
		// 		$id_pt=$hs->id_perguruan_tinggi;
		// 		echo "id mhs ".$id_mhs;
		// 		echo "<br>";
		// 		echo "id PT ".$id_pt;
		// 	}

		// }
		print_r($hasil);
		}
	}else{
		echo "error :".$cn->error;
	}
}
 ?>