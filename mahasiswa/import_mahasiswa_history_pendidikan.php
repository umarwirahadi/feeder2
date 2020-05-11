<?php
session_start();
include_once("../config.php");
$token =$_SESSION['token'];
include_once("../config/koneksi.php");

//proses update data prodi 		
$sql="select id_mahasiswa,npm as nim,id_jenis_daftar,id_jalur_daftar,id_periode_masuk,tanggal_daftar,id_perguruan_tinggi,id_prodi,sks_diakui,id_perguruan_tinggi_asal,id_prodi_asal,id_pembayaran as id_pembiayaan from mahasiswa where status='4'";
if($data=$cn->query($sql)){
	if($data->num_rows >0){
		while($row=$data->fetch_assoc()){
		$ws=array("act"=>"InsertRiwayatPendidikanMahasiswa",
					"token"=>$token,
					"record"=>$row);	
		$result_insert=json_decode(runWS($ws));
		$npm=$row['nim'];
		$id_prodi=$row['id_prodi'];		
		if($result_insert->error_code==0){			
			$id_reg_mhs=$result_insert->data->id_registrasi_mahasiswa;
			$error_desc=$result_insert->error_desc;
			$error_code=$result_insert->error_code;			
			// $sql="update mahasiswa set id_registrasi_mahasiswa='$id_reg_mhs',deskripsi='' where npm='$npm' and id_prodi='$id_prodi' and status='4'";
			$sql="DELETE FROM mahasiswa where npm='$npm' and id_prodi='$id_prodi' and status='4'";
			if($cn->query($sql)){
				// echo "sukses update";
			}else{
				echo "Proses update Id Registrasi Mahasiswa gagal ".$cn->error;
			}
		}elseif($result_insert->error_code<>0){
			$error_desc=mysqli_real_escape_string($cn,$result_insert->error_desc);
			$error_code=$result_insert->error_code;
			$sql1="update mahasiswa set deskripsi='$error_code - $error_desc' where npm='$npm' and id_prodi='$id_prodi'";
			if($cn->query($sql1)){
				// echo "<br>sukses update gagal";
			}else{
				echo "<br>Proses Update Deskripsi Error".$cn->error;
			}
		}else{
			echo "<br>tidak ada data yang akan di validasi";
		}
	// echo "<pre>";
	// print_r($result_insert);
	// echo "</pre>";
	
	}
}
}
// jika menggunakan Href
header("location:../index.php?sub=list_mahasiswa&list=2");
?>