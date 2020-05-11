<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select id_prodi,id_semester,id_matkul,nama_kelas_kuliah,bahasan,tanggal_mulai_efektif,tanggal_akhir_efektif from kelas_kuliah where status='1'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$a			=$rw['id_prodi'];
		$b  		=$rw['id_matkul'];
		$c  		=$rw['nama_kelas_kuliah'];
		$act		="InsertKelasKuliah";
		$ws=array("act"=>$act,
					'token'=>$token,
					"record"=>$rw);
		$kelas_kuliah=json_decode(RunWS($ws));		
		if ($kelas_kuliah->error_code==0){
				$idtrf=$kelas_kuliah->data->id_kelas_kuliah;
				$sql="delete from kelas_kuliah where id_prodi='$a' and id_matkul='$b' and nama_kelas_kuliah='$c'";
				$res=$cn->query($sql);
				//status angkat 3=sukses;			
		}elseif ($kelas_kuliah->error_code<>0){
			$erdesc =$kelas_kuliah->error_desc;
			$ercode =$kelas_kuliah->error_code;
			$sql="update kelas_kuliah set desk='$ercode - $erdesc' where id_prodi='$a' and id_matkul='$b' and nama_kelas_kuliah='$c'";
			$res=$cn->query($sql);
		}		
	}
	}
	$cn->close();		
}
	header("location:../index.php?sub=kelaskuliah");
 ?>
