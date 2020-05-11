<?php 
session_start();
require_once("../config/koneksi.php");
require_once("../config.php");
$token=$_SESSION['token'];
$data2 =["act"=>"GetListMataKuliah","token"=>$token,"filter"=>"","limit"=>""];
$result2=json_decode(runWS($data2));
foreach ($result2->data as $row) {
$id_matkul=$row->id_matkul;
$kode_mata_kuliah	=$row->kode_mata_kuliah;
$nama_mata_kuliah	=$row->nama_mata_kuliah;
$sks_mata_kuliah	=$row->sks_mata_kuliah;
$id_prodi 			=$row->id_prodi;
$nama_program_studi	=$row->nama_program_studi;
$id_jenis_mata_kuliah=$row->id_jenis_mata_kuliah;
$id_kelompok_mata_kuliah=$row->id_kelompok_mata_kuliah;

$sql1="select * from getlistmatakuliah where id_matkul='$id_matkul'";
if($res1=$cn->query($sql1)){
	if($res1->num_rows==0){
		$sql="insert into getlistmatakuliah(id_matkul,kode_mata_kuliah,nama_mata_kuliah,sks_mata_kuliah,id_prodi,nama_program_studi,id_jenis_mata_kuliah,id_kelompok_mata_kuliah,status)values('$id_matkul','$kode_mata_kuliah','$nama_mata_kuliah','$sks_mata_kuliah','$id_prodi','$nama_program_studi','$id_jenis_mata_kuliah','$id_kelompok_mata_kuliah','9')";
		$cn->query($sql);	
	}else{
		$sql2="update getlistmatakuliah set kode_mata_kuliah='$kode_mata_kuliah',nama_mata_kuliah='$nama_mata_kuliah',sks_mata_kuliah='$sks_mata_kuliah',id_jenis_mata_kuliah='$id_jenis_mata_kuliah',nama_program_studi='$nama_program_studi',id_kelompok_mata_kuliah='$id_kelompok_mata_kuliah' WHERE id_matkul='$id_matkul'";
		$cn->query($sql2);
	}
}
}
header('location:../index.php?sub=matkul&submatkul=viewmk');
 ?>
