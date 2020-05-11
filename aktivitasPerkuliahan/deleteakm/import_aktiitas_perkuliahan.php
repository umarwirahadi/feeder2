<?php 
session_start();
include_once("../../config.php");
include_once("../../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select id_registrasi_mahasiswa,id_semester,id_status_mahasiswa,ips,ipk,sks_semester,total_sks from insertPerkuliahanMahasiswa where status='1'";
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
		$key 	= array('id_registrasi_mahasiswa' =>$id_regmhs,"id_semester"=>$id_semester);
		$record = array("id_status_mahasiswa"=>$id_status_mahasiswa,"ips"=>$ips,"ipk"=>$ipk,"sks_semester"=>$sks_semester,"total_sks"=>$total_sks);
		// $rec2 = array("key" =>$key,"record"=>$record);
		$act		="DeletePerkuliahanMahasiswa";
		$ws=array("act"=>$act,
					"token"=>$token,
					"key"=>$key);
		$perkuliahamhs=json_decode(RunWS($ws));
		// echo "<pre>";
		// print_r($perkuliahamhs);
		// echo "</pre>";		
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
	header("location:../../index.php?sub=hapusaktivitasmhs");
	$cn->close();

 ?>
