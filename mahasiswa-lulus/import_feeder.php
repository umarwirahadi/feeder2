<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
// $sql="select id_registrasi_mahasiswa,id_jenis_keluar,tanggal_keluar,keterangan,nomor_sk_yudisium,tanggal_sk_yudisium,ipk,nomor_ijazah,jalur_skripsi,judul_skripsi,bulan_awal_bimbingan,bulan_akhir_bimbingan from insertmahasiswalulusdo where status='1'";
$sql="select id_registrasi_mahasiswa,id_jenis_keluar,tanggal_keluar,keterangan,nomor_sk_yudisium,ipk,nomor_ijazah,jalur_skripsi,judul_skripsi from insertmahasiswalulusdo where status='1'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$id_reg			=$rw['id_registrasi_mahasiswa'];
		$act		="InsertMahasiswaLulusDO";
		$ws=array("act"=>$act,
					'token'=>$token,
					"record"=>$rw);
		$hasil_transfer=json_decode(RunWS($ws));
		//print_r($hasil_transfer);
		if ($hasil_transfer->error_code==0){
				$idrg=$hasil_transfer->data->id_registrasi_mahasiswa;
				$sqldel="delete from  insertmahasiswalulusdo where id_registrasi_mahasiswa='$idrg'";
				$cn->query($sqldel);		
		}else{
			$erkode =$hasil_transfer->error_code;
			$erdesc =$cn->real_escape_string($hasil_transfer->error_desc);
			$sqlerr="update insertmahasiswalulusdo set kode_error='$erkode', deskripsi='$erdesc',status='0' where  id_registrasi_mahasiswa='$id_reg'";
			$cn->query($sqlerr);
		}
	}
	echo "<script>window.location.href='../index.php?sub=mhs_lulus';</script>";
	}
}
echo "<script>window.location.href='../index.php?sub=mhs_lulus';</script>";
 ?>
