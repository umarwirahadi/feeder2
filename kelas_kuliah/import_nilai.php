<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select id_registrasi_mahasiswa,id_kelas_kuliah,nilai_angka,nilai_indeks,nilai_huruf from GetDetailNilaiPerkuliahanKelas where nilai_angka <>'' or nilai_huruf <>'' or nilai_indeks<>''";
if($data1=$cn->query($sql)){	
		while ($rec10=$data1->fetch_assoc()){
		$idregmhs		=$rec10['id_registrasi_mahasiswa'];
		$idklskul  		=$rec10['id_kelas_kuliah'];
		$nilai_angka 	=$rec10['nilai_angka'];
		$nilai_indeks	=$rec10['nilai_indeks'];
		$nilai_huruf	=$rec10['nilai_huruf'];

		$temp_key 	= array('id_registrasi_mahasiswa' =>$idregmhs,'id_kelas_kuliah'=>$idklskul);
		$temp_data 	= array('nilai_angka' =>$nilai_angka,'nilai_indeks'=>$nilai_indeks,'nilai_huruf'=>$nilai_huruf);	
		
		$updateNilai=array("act"=>"UpdateNilaiPerkuliahanKelas","token"=>$token,"key"=>$temp_key,"record"=>$temp_data);
		$result=json_decode(RunWS($updateNilai));
		$sqldel="delete from GetDetailNilaiPerkuliahanKelas where id_registrasi_mahasiswa='$idregmhs' and id_kelas_kuliah='$idklskul'";
		$cn->query($sqldel);
		}		
}
 header("location:../index.php?sub=nilaimhs");
 ?>