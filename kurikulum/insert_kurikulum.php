<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select nama_kurikulum,id_prodi,id_semester,jumlah_sks_lulus,jumlah_sks_wajib,jumlah_sks_pilihan from insertkurikulum where status='1'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$a			=$rw['nama_kurikulum'];
		$b  		=$rw['id_prodi'];		
		$act		="InsertKurikulum";
		$ws=array("act"=>$act,
					'token'=>$token,
					"record"=>$rw);
		$kelas_kuliah=json_decode(RunWS($ws));		
		if ($kelas_kuliah->error_code==0){
				$idtrf=$kelas_kuliah->data->id_kelas_kuliah;
				$sql="delete from insertkurikulum where id_prodi='$b' and nama_kurikulum='$a'";
				$res=$cn->query($sql);						
		}elseif ($kelas_kuliah->error_code<>0){
			$erdesc =$kelas_kuliah->error_desc;
			$ercode =$kelas_kuliah->error_code;
			$sql="update insertkurikulum set deskripsi='$erdesc',kode_error='$ercode' where id_prodi='$b' and nama_kurikulum='$a'";
			$res=$cn->query($sql);
		}		
	}
	}
	$cn->close();		
}
	header("location:../index.php?sub=Kurikulum&idkurikulum=input-kurikulum");
 ?>
