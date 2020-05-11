<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select id_prodi,id_semester,jumlah_target_mahasiswa_baru,jumlah_pendaftar_ikut_seleksi,jumlah_pendaftar_lulus_seleksi,jumlah_daftar_ulang,jumlah_mengundurkan_diri,tanggal_awal_perkuliahan,tanggal_akhir_perkuliahan from setting_periode_perkuliahan where status='1'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$idprodi			=$rw['id_prodi'];
		$id_semester  		=$rw['id_semester'];
		$act			="InsertPeriodePerkuliahan";
		$wskrs=array("act"=>$act,
					'token'=>$token,
					"record"=>$rw);
		$wskrs=json_decode(RunWS($wskrs));
		print_r($wskrs);
		if ($wskrs->error_code==0){
				$sql="delete from  setting_periode_perkuliahan where id_prodi='$idprodi' and id_semester='$id_semester'";
				$res=$cn->query($sql);
				//status angkat 2=sukses upload KRS;			
		}elseif ($wskrs->error_code<>0){
				$erdesc =$wskrs->error_desc;
				$ercode =$wskrs->error_code;
				$sql="update setting_periode_perkuliahan set kode_error='$ercode',status='3', desk='$erdesc' where id_prodi='$idprodi' and id_semester='$id_semester'";
				$res=$cn->query($sql);
			}	
	}
	}else{
		echo "error 1 :".$cn->error;
		// header("location:../index.php?sub=periodekuliah");
	}		
}
	header("location:../index.php?sub=periodekuliah");
 ?>
