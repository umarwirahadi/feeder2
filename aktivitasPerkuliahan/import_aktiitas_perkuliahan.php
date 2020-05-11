<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select id_registrasi_mahasiswa,id_semester,id_status_mahasiswa,ips,ipk,sks_semester,total_sks,total_biaya from insertPerkuliahanMahasiswa where status='1'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$id_regmhs				=$rw['id_registrasi_mahasiswa'];
		$id_semester  			=$rw['id_semester'];
		$id_status_mahasiswa  	=$rw['id_status_mahasiswa'];
		$ips 				  	=$rw['ips'];
		$ipk 				  	=$rw['ipk'];
		$sks_semester		  	=$rw['sks_semester'];
		$total_sks			  	=$rw['total_sks'];
		$biaya_kuliah_smt		==$rw['total_biaya'];
		// $key 	= array('id_registrasi_mahasiswa' =>$id_regmhs,"id_semester"=>$id_semester);
		// $record2 = array("id_status_mahasiswa"=>$id_status_mahasiswa,"ips"=>$ips,"ipk"=>$ipk,"sks_semester"=>$sks_semester,"total_sks"=>$total_sks);
		$record = array("id_registrasi_mahasiswa"=>$id_regmhs,"id_semester"=>$id_semester,"id_status_mahasiswa"=>$id_status_mahasiswa,"ips"=>$ips,"ipk"=>$ipk,"sks_semester"=>$sks_semester,"total_sks"=>$total_sks,"biaya_kuliah_smt"=>$biaya_kuliah_smt);
		// $rec2 = array("key" =>$key,"record"=>$record);
		$act		="InsertPerkuliahanMahasiswa";
		$ws=array("token"=>$token,"act"=>$act,"record"=>$record);
		$perkuliahamhs=json_decode(RunWS($ws));
	
		if ($perkuliahamhs->error_code==0){
			$sql="delete from insertPerkuliahanMahasiswa where id_registrasi_mahasiswa='$id_regmhs' and id_status_mahasiswa='$id_status_mahasiswa' and id_semester='$id_semester'";
			$res=$cn->query($sql);
		}else{
			$erkd =$perkuliahamhs->error_code;
			$erdesc =$perkuliahamhs->error_desc;
			$ergab=$erkd."-".$erdesc;
			$sql="update insertPerkuliahanMahasiswa set  deskripsi='$ergab' where id_registrasi_mahasiswa='$id_regmhs' and id_status_mahasiswa='$id_status_mahasiswa' and id_semester='$id_semester'";
			$res=$cn->query($sql);			

		}
	}
	}	
}
	header("location:../index.php?sub=aktivitasmhs");
	$cn->close();

 ?>
