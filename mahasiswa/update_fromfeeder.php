 <?php
session_start();       		
require_once("../config/koneksi.php");
require_once("../config.php");
$token=$_SESSION['token'];
$data2 =["act"=>"GetListMahasiswa","token"=>$token,"filter"=>"","limit"=>""];
$result2=json_decode(runWS($data2));
if($result2->error_code==0){
foreach ($result2->data as $res3) {
  	$nama_mahasiswa			=$cn->real_escape_string($res3->nama_mahasiswa);
	$jenis_kelamin			=$res3->jenis_kelamin;
	$tanggal_lahir			=$res3->tanggal_lahir;
	$id_perguruan_tinggi	=$res3->id_perguruan_tinggi;
	$id_mahasiswa			=$res3->id_mahasiswa;
	$id_agama				=$res3->id_agama;
	$nama_agama				=$res3->nama_agama;
	$id_prodi				=$res3->id_prodi;
	$nama_program_studi		=$res3->nama_program_studi;
	$nama_status_mahasiswa	=$res3->nama_status_mahasiswa;
	$nim					=$res3->nim;
	$id_periode				=$res3->id_periode;
	$nama_periode_masuk		=$res3->nama_periode_masuk;
	$id_registrasi_mahasiswa=$res3->id_registrasi_mahasiswa;

	$sql="insert into GetListMahasiswa (nama_mahasiswa,jenis_kelamin,tanggal_lahir,id_perguruan_tinggi,id_mahasiswa,id_agama,nama_agama,id_prodi,nama_program_studi,nama_status_mahasiswa,nim,id_periode,nama_periode_masuk,id_registrasi_mahasiswa) values('$nama_mahasiswa','$jenis_kelamin','$tanggal_lahir','$id_perguruan_tinggi','$id_mahasiswa','$id_agama','$nama_agama','$id_prodi','$nama_program_studi','$nama_status_mahasiswa','$nim','$id_periode','$nama_periode_masuk','$id_registrasi_mahasiswa')";
  	$cn->query($sql);
}
}
header("location:../index.php?sub=list_mahasiswa");
?>