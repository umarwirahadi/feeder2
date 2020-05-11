<?php
session_start();
$token=$_SESSION['token'];
include_once("../config/koneksi.php");
include_once("../config.php");
$sql="select * from kelas_kuliah where status='0'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		for ($i=0; $i <$data1->num_rows ; $i++) {
			$rw=$data1->fetch_array();
			$nama_prod	=$rw['nama_prodi'];
			$jenjang	=$rw['jenjang'];
			$id_smt 	=$rw['id_semester'];
			$namakur	=$rw['nama_kurikulum'];
			$kdmk		=$rw['kode_mata_kuliah'];
			$nmmk		=$rw['nama_mata_kuliah'];
			$nmklskul	=$rw['nama_kelas_kuliah'];
			$gab		=$jenjang." ".$nama_prod;

			//fill id prodi from feeder
			$id_prodi=array("act"=>"GetProdi",
			"token"=>$token,
			"filter"=>"nama_program_studi='$nama_prod' AND nama_jenjang_pendidikan='$jenjang' AND status='A'",
			"limit"=>1);
			$res_id_prodi=json_decode(runWS($id_prodi));
			if ($res_id_prodi->error_code=='0'){				
				foreach ($res_id_prodi->data as $value) {
					$id_prodi=$value->id_prodi;
					if($id_prodi==''){
						$sql_update_id_prodi_error="update kelas_kuliah set desk='$gabungan_error' where nama_prodi='$nama_prod' and jenjang='$jenjang' and status='0'";
						$cn->query($sql_update_id_prodi_error);
					}else{
						$sql_update_id_prodi="update kelas_kuliah set id_prodi='$id_prodi' where nama_prodi='$nama_prod' and jenjang='$jenjang' and status='0'";
						$cn->query($sql_update_id_prodi);
					}
				}	
			}else{
				$kode_error=$cn->real_escape_string($res_id_prodi->error_code);
				$kode_desk=$cn->real_escape_string($res_id_prodi->error_desc);
				$gabungan_error=$kode_error."-".$kode_desk;
				$sql_update_id_prodi_error="update kelas_kuliah set desk='$gabungan_error' where nama_prodi='$nama_prod' and jenjang='$jenjang' and status='0'";
				$cn->query($sql_update_id_prodi_error);
			}
						
		//fill id_matkul
			$id_matkul=array("act"=>"GetMatkulKurikulum",
			"token"=>$token,
			"filter"=>"nama_kurikulum='$namakur' AND kode_mata_kuliah='$kdmk' AND nama_mata_kuliah='$nmmk' ",
			"limit"=>1);
			$res_id_matkul=json_decode(runWS($id_matkul));
			// echo("<pre>");
			// print_r($res_id_matkul);
			// echo("</pre>");
			if ($res_id_matkul->error_code=='0'){
				foreach ($res_id_matkul->data as $value) {
					$id_matkul=$value->id_matkul;
					if ($id_matkul=='' or is_null($id_matkul)) {
						$sql_update_id_prodi_error="update kelas_kuliah set desk='Data Matakuliah tidak ditemukan' where where nama_kurikulum='$namakur' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk' and status='0'";
						$cn->query($sql_update_id_prodi_error);		
					} else {
						$sql_update_id_matkul="update kelas_kuliah set id_matkul='$id_matkul' where nama_kurikulum='$namakur' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk' and status='0'";
						$cn->query($sql_update_id_matkul);
					}
				}	
			}else{
				$kode_error_id_matkul=$res_id_matkul->error_code;
				$kode_desk_id_matkul=$cn->real_escape_string($res_id_matkul->error_desc);
				$gabungan_error=$kode_error."-".$kode_desk;
				$sql_update_id_prodi_error="update kelas_kuliah set desk='$gabungan_error' where where nama_kurikulum='$namakur' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk' and status='0'";
				$cn->query($sql_update_id_prodi_error);
			}
			$sql_update_status="update kelas_kuliah set status='1' where id_matkul IS NOT NULL AND id_prodi IS NOT NULL";
			$cn->query($sql_update_status);
		}
	}
}
	header("location:../index.php?sub=kelaskuliah");
?>							