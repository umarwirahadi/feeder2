<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select id_kurikulum,id_matkul,semester,sks_mata_kuliah,sks_tatap_muka,sks_praktek,sks_praktek_lapangan,sks_simulasi,apakah_wajib from InsertMatkulKurikulum where status='1'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$id_kur		=$rw['id_kurikulum'];
		$b  		=$rw['id_matkul'];
		$act		="InsertMatkulKurikulum";
		$ws=array("act"=>$act,
					'token'=>$token,
					"record"=>$rw);
		$hasil_transfer=json_decode(RunWS($ws));
		if ($hasil_transfer->error_code==0){
				$sql="delete from InsertMatkulKurikulum where id_kurikulum='$id_kur' and id_matkul='$b'";
				$res=$cn->query($sql);			
		}elseif ($hasil_transfer->error_code<>0){
			$erkode =$hasil_transfer->error_code;
			$erdesc =$hasil_transfer->error_desc;
			$sql="update InsertMatkulKurikulum set kode_error='$erkode',deskripsi='$erdesc' where id_kurikulum='$id_kur' and id_matkul='$b'";
			$res=$cn->query($sql);
		}
	}
	}
	$cn->close();
	header("location:../index.php?sub=Kurikulum");
}
 ?>
