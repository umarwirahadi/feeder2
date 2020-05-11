<?php 
session_start();
if ((isset($_GET['id_reg_mhs'])) && (isset($_GET['id_kls']))) {
	$id_reg =$_GET['id_reg_mhs'];
	$id_kelas =$_GET['id_kls'];
	$token=$_SESSION['token'];
	include_once("../config/koneksi.php");
	include_once("../config.php");
	$data = array('id_registrasi_mahasiswa'=>$id_reg ,'id_kelas_kuliah'=>$id_kelas);
	$delpesertakelaskuliah=["act"=>"DeletePesertaKelasKuliah","token"=>$token,"key"=>$data];
	$resuldelete=json_decode(runWS($delpesertakelaskuliah));
	$sqldelperrecord="delete from GetDetailNilaiPerkuliahanKelas where id_registrasi_mahasiswa='$id_reg' and id_kelas_kuliah='$id_kelas'";
		$cn->query($sqldelperrecord);
	}
	header("location:../index.php?sub=nilaimhs");	
 ?>