<?php
session_start();
$token=$_SESSION['token'];
if(isset($_POST['nama_kurikulum']) AND isset($_POST['jurusan']) AND (isset($_POST['idsmt']) AND (isset($_POST['jml_SKS_Lulus'])))){
require_once('../config.php');
require_once('../config/koneksi.php');
$token=$_SESSION['token'];
$nama_kurikulum=$_POST['nama_kurikulum'];
$id_prodi=$_POST['jurusan'];
$id_semester=$_POST['idsmt'];
$jumlah_sks_lulus=$_POST['jml_SKS_Lulus'];
$jumlah_sks_wajib=$_POST['jml_SKS_wajib'];
$jumlah_sks_pilihan=$_POST['jml_SKS_pilihan'];
$aksi='InsertKurikulum';
$row = array('nama_kurikulum'=>$nama_kurikulum,'id_prodi'=>$id_prodi,'id_semester'=>$id_semester,'jumlah_sks_lulus'=>$jumlah_sks_lulus,'jumlah_sks_wajib'=>$jumlah_sks_wajib,'jumlah_sks_pilihan'=>$jumlah_sks_pilihan);
$data = array('act'=>$aksi,'token'=>$token,'record'=>$row);
$result=json_decode(runWS($data));
if($result->error_code==0){
	$_SESSION['pesan'] 	    	="Kurikulum berhasil didaftarkan..!";
	$_SESSION['id_kurikulum']	=$result->data->id_kurikulum;
	header('location:../index.php?sub=Kurikulum&idkurikulum=input-matkul-kurikulum');
}else{
header('location:../index.php?sub=Kurikulum&idkurikulum=input-matkul-kurikulum');	
	$_SESSION['pesan']="Data Kurikulum sudah..!";
}
}
 ?>