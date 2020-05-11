<?php
session_start();
include_once("../config.php");
$token =$_SESSION['token'];
include_once("../config/koneksi.php");
$sql="select id_mahasiswa,nim,nama_mahasiswa,id_jenis_daftar,id_jalur_daftar,id_periode_masuk,tanggal_daftar,id_perguruan_tinggi,id_prodi,sks_diakui,id_perguruan_tinggi_asal,id_prodi_asal,id_pembiayaan from updateriwayatpendidikanmahasiswa where status='3'";
if($data=$cn->query($sql)){
	if($data->num_rows >0){
		while($row=$data->fetch_assoc()){
			
			$key = array('id_registrasi_mahasiswa' => $row['id_registrasi_mahasiswa']);
			$record = array('id_mahasiswa' =>$row['id_mahasiswa'],
				'nim' =>$row['nim'],
				'id_jenis_daftar' =>$row['id_jenis_daftar'],
				'id_jalur_daftar' =>$row['id_jalur_daftar'],
				'id_periode_masuk' =>$row['id_periode_masuk'],
				'tanggal_daftar' =>$row['tanggal_daftar'],
				'id_perguruan_tinggi' =>$row['id_perguruan_tinggi'],
				'id_prodi' =>$row['id_prodi'],				
				'sks_diakui' =>$row['sks_diakui'],
				'id_perguruan_tinggi_asal' =>$row['id_perguruan_tinggi_asal'],
				'id_prodi_asal' =>$row['id_prodi_asal']);
		$ws=array("act"=>"UpdateRiwayatPendidikanMahasiswa",
					"token"=>$token,
					"key"=>$key,
					"record"=>$record);	
		$result_insert=json_decode(runWS($ws));
 		echo "<pre>";
		print_r($result_insert);
		echo "</pre>";
		if($result_insert->error_code==0){
		foreach ($result_insert->data as $id) {
			echo $id->id_registrasi_mahasiswa;
		}

		}elseif($result_insert->error_code<>0){
			$error_desc=mysqli_real_escape_string($cn,$result_insert->error_desc);
			$error_code=$result_insert->error_code;
			$sql1="update updateriwayatpendidikanmahasiswa set desk='$error_code - $error_desc' where nim='$npm' and id_prodi='$id_prodi'";
			$cn->query($sql1);				
		}	
	}
}
echo $cn->error;
}
// header("location:../index.php?sub=list_mahasiswa&list=1");
?>