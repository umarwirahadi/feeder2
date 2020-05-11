<?php 
session_start();
include_once("../../config/koneksi.php");
include_once("../../config.php");
$token=$_SESSION['token'];
$sql="select * from insertPerkuliahanMahasiswa where status='0'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		for ($i=0; $i <$data1->num_rows ; $i++) {
			$rw=$data1->fetch_array();
			$id			=$rw['id'];
			$nim		=$rw['nim'];
			$namamhs	=$rw['nama_mahasiswa'];		
			$statusmhs	=$rw['id_status_mahasiswa'];
			$jenjang	=$rw['jenjang'];
			$prodi 		=$rw['program_studi'];
			$gab		=$jenjang." ".$prodi;
			$filter_mhs="nim='$nim' and nama_program_studi='$gab'";
			$data=array("act"=>"GetListMahasiswa",
						"token"=>$token,
						"filter"=>$filter_mhs,
						"limit"=>1);
			$id_reg_mhs=json_decode(runWS($data));
			if ($id_reg_mhs->error_code==0) {
				foreach ($id_reg_mhs->data as $value) {
					$id_reg=$value->id_registrasi_mahasiswa;
					$sqlupdate="update insertPerkuliahanMahasiswa set id_registrasi_mahasiswa='$id_reg' where id='$id'";
					$cn->query($sqlupdate);
				}
			}else{
				$errcodeidreg=$id_reg_mhs->error_code;
				$errdesc=$cn->real_escape_string($hasil->error_desc);
				$gb=$errcodeidreg."-".$errdesc;
				$sqler="update insertPerkuliahanMahasiswa set deskripsi='$gb'where nim='$nim' and nama_mahasiswa='$namamhs'";
				$cn->query($sqler);
			}

			$filter_status="id_status_mahasiswa='$statusmhs'";
			$data=array("act"=>"GetStatusMahasiswa",
						"token"=>$token,
						"filter"=>$filter_status,
						"limit"=>1);
			$nm_status_mhs=json_decode(runWS($data));
			if ($nm_status_mhs->error_code==0) {
				foreach ($nm_status_mhs->data as $value1) {
					$nmstatus_mhs=$value1->nama_status_mahasiswa;
					$sqlupdate="update insertPerkuliahanMahasiswa set status_mahasiswa='$nmstatus_mhs' where id='$id'";
					$cn->query($sqlupdate);
				}
			}else{
				$err1=$nm_status_mhs->error_code;
				$err2=$cn->real_escape_string($nm_status_mhs->error_desc);
				$gb1=$err1."-".$err2;
				$sqler="update insertPerkuliahanMahasiswa set deskripsi='$gb1'where id='$id'";
				$cn->query($sqler);
			}
			$sqlupdatestat="update insertPerkuliahanMahasiswa set status='1' where id_registrasi_mahasiswa IS NOT NULL AND id_status_mahasiswa IS NOT NULL";
			$cn->query($sqlupdatestat);
		}
	}
			
		}
	header("location:../../index.php?sub=hapusaktivitasmhs");	

?>							