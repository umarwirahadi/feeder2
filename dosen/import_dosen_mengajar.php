<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select id_registrasi_dosen,id_kelas_kuliah,id_substansi,sks_substansi_total,rencana_tatap_muka,realisasi_tatap_muka,id_jenis_evaluasi from insertdosenpengajarkelaskuliah where status='1'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$a			=$rw['id_registrasi_dosen'];
		$b  		=$rw['id_kelas_kuliah'];
		$c  		=$rw['id_jenis_evaluasi'];
		$act		="InsertDosenPengajarKelasKuliah";
		$ws=array("act"=>$act,
					"token"=>$token,
					"record"=>$rw);
		$id_aktivitas_mengajar=json_decode(RunWS($ws));		
		if ($id_aktivitas_mengajar->error_code==0){
				// $idtrf=$id_aktivitas_mengajar->data->id_kelas_kuliah;
				$sql="delete from insertdosenpengajarkelaskuliah where id_registrasi_dosen='$a' and id_kelas_kuliah='$b'";
				$res=$cn->query($sql);							
		}else{
			$erdesc =$id_aktivitas_mengajar->error_desc;
			$ercode =$id_aktivitas_mengajar->error_code;
			$sql1="update insertdosenpengajarkelaskuliah set error_kode='$ercode',deskripsi='$erdesc' where id_registrasi_dosen='$a' and id_kelas_kuliah='$b'";
			$res=$cn->query($sql1);
		}		
	}
	}
	$cn->close();	
}
	header("location:../index.php?sub=dosen");
 ?>
