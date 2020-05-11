<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select id_registrasi_mahasiswa,kode_mata_kuliah_asal,nama_mata_kuliah_asal,sks_mata_kuliah_asal,nilai_huruf_asal,id_matkul,sks_mata_kuliah_diakui,nilai_huruf_diakui,nilai_angka_diakui from nilai_transfer where status='2'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$id_reg		=$rw['id_registrasi_mahasiswa'];
		$b  		=$rw['id_matkul'];
		$act		="InsertNilaiTransferPendidikanMahasiswa";
		$ws=array("act"=>$act,
					"token"=>$token,
					"record"=>$rw);
		$hasil_transfer=json_decode(RunWS($ws));		
		if ($hasil_transfer->error_code==0){
				$idtrf=$hasil_transfer->data->id_transfer;
			$sql="delete from  nilai_transfer where id_registrasi_mahasiswa='$id_reg' and id_matkul='$b'";
				$res=$cn->query($sql);
				//status angkat 3=sukses;			
		}elseif ($hasil_transfer->error_code<>0){
			$erkode =$hasil_transfer->error_code;
			$erdesc =$cn->real_escape_string($hasil_transfer->error_desc);
			$sql="update nilai_transfer set eror_code='$erkode',eror_deskripsi='$erdesc' where id_registrasi_mahasiswa='$id_reg' and id_matkul='$b'";
			$res=$cn->query($sql);
		}
	
	}
	}
	header("location:../index.php?sub=nilaiTransfer");		
}

 ?>
