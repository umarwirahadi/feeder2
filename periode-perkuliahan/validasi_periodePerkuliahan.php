<?php 
include_once("../config/koneksi.php");
$sql="select * from setting_periode_perkuliahan where status='0'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		for ($i=0; $i <$data1->num_rows ; $i++) {
			$rw=$data1->fetch_row();
			$nama_prod	=$rw[1];
			$jenjang	=$rw[2];		
			$id_semester=$rw[5];			
			$gab		=$rw[2]." ".$rw[1];
			$sqlprodi="select id_prodi from prodipt where nama_program_studi='$nama_prod' and nama_jenjang_pendidikan='$jenjang'";
			if($resultprodi=$cn->query($sqlprodi)){				
				if($resultprodi->num_rows>=1){
					$id_prodi=$resultprodi->fetch_row();
					$id_prodi1=$id_prodi[0];
					$sql2="update setting_periode_perkuliahan set id_prodi='$id_prodi1',status='1' where nama_prodi='$nama_prod' and jenjang='$jenjang'";
					$cn->query($sql2);					
				}//end jumlah lebih dari 1
			}			
		}
	}
}
	header("location:../index.php?sub=periodekuliah");	
?>							