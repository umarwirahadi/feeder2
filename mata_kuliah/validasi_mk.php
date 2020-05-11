<?php
session_start();
$token=$_SESSION['token'];
include_once("../config/koneksi.php");
include_once("../config.php");
$sql="select * from insertmatakuliah where status='0'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		for ($i=0; $i <$data1->num_rows ; $i++) {
			$rw=$data1->fetch_array();
			$id	        =$rw['id'];
			$nama_prod	=$rw['nama_program_studi'];
			$jenjang	=$rw['jenjang'];			
			$sqlprodi="select id_prodi from prodipt where nama_program_studi='$nama_prod' and nama_jenjang_pendidikan='$jenjang'";
			if($resultprodi=$cn->query($sqlprodi)){
				if($resultprodi->num_rows>=1){
					$id_prodi=$resultprodi->fetch_row();
					$id_prodi1=$id_prodi[0];
					$sql2="update insertmatakuliah set id_prodi='$id_prodi1',status='1' where id='$id'";
					$resupdateprodi=$cn->query($sql2);					
					}		
				}else{
					$sql2="update insertmatakuliah set deskripsi='Periksa data Prodi' where id='$id'";
					$resupdateprodi=$cn->query($sql2);					
				
				}//end jumlah lebih dari 1
			}			
		}
	}else{
		echo $cn->error;
	}
	header("location:../index.php?sub=matkul");
?>