<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select * from insertmahasiswalulusdo where status='0'";
if($data=$cn->query($sql)){
	if($data->num_rows>=1){
		while ($rw=$data->fetch_assoc()){
		$nim 		=$rw['nim'];
		$nama 		=$cn->real_escape_string($rw['nama_mahasiswa']);
		$act		="GetListMahasiswa";
		$filter		="nim='$nim'";
		$order 		="";
		$limit 		="";
		$offset 	="";
		$ws=array("act"=>$act,
					"token"=>$token,
					"filter"=>$filter,
					"order"=>$order,
					"limit"=>$limit,
					"offset"=>$offset);
		$hasil=json_decode(RunWS($ws));
		if($hasil->error_code==0){
			foreach ($hasil->data as $key) {
			$idreg=$key->id_registrasi_mahasiswa;	
			}
			$sql="update insertmahasiswalulusdo set id_registrasi_mahasiswa='$idreg' where nim='$nim'";
			$cn->query($sql);			
		}else{
			$errcode=$hasil->error_code;
			$errdesc=$cn->real_escape_string($hasil->error_desc);
			$sql="update insertmahasiswalulusdo set status='0',deskripsi='$errdesc',kode_error='$errcode' where nim='$nim'";
			$cn->query($sql);
		}
		$jenis_kel=$cn->real_escape_string($rw['jenis_keluar']);
				$act2		="GetJenisKeluar";
				$filter1	="jenis_keluar='$jenis_kel'";
				$order 		="";
				$limit 		="1";
				$offset 	="";
				$ws=array("act"=>$act2,
							"token"=>$token,
							"filter"=>$filter1,
							"order"=>$order,
							"limit"=>$limit,
							"offset"=>$offset);
				$res_jenis_keluar=json_decode(RunWS($ws));				
				// print_r($res_jenis_keluar);
				if($res_jenis_keluar->error_code==0){
					foreach ($res_jenis_keluar->data as $key2) {
						$id_jenis_keluar=$key2->id_jenis_keluar;
						$sqljeniskel="update insertmahasiswalulusdo set id_jenis_keluar='$id_jenis_keluar',status='1' where nim='$nim' and nama_mahasiswa='$nama'";
						$cn->query($sqljeniskel);
					}					
				}

		}
		echo "<script>location.href='../index.php?sub=mhs_lulus';</script>";
	}else{
	echo "<script>location.href='../index.php?sub=mhs_lulus';</script>";
	}
}
 ?>