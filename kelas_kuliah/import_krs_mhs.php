<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select id_registrasi_mahasiswa,id_kelas_kuliah from krs_mahasiswa where status='1'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$idregmhs		=$rw['id_registrasi_mahasiswa'];
		$idklskul  		=$rw['id_kelas_kuliah'];
		$act			="InsertPesertaKelasKuliah";
		$wskrs=array("act"=>$act,
					'token'=>$token,
					"record"=>$rw);
		$wskrs=json_decode(RunWS($wskrs));
		if ($wskrs->error_code==0){
				$sql="DELETE FROM krs_mahasiswa where id_registrasi_mahasiswa='$idregmhs' and id_kelas_kuliah='$idklskul'";
				$res=$cn->query($sql);			
		}else{
			$erdesc =$wskrs->error_desc;
			$sql="update krs_mahasiswa set status='1', desk='$erdesc' where id_registrasi_mahasiswa='$idregmhs' and id_kelas_kuliah='$idklskul'";
			$res=$cn->query($sql);
		}		
	}
}
	header("location:../index.php?sub=krs");
}else{
	header("location:../index.php?sub=krs");
}
 ?>
