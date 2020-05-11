<?php 
session_start();
include_once("../config/koneksi.php");
require_once('../config.php');
$token=$_SESSION['token'];

$sql="select * from krs_mahasiswa where status='0'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		for ($i=0; $i <$data1->num_rows ; $i++) {
			$rw=$data1->fetch_row();
			$nama_prod	=$rw[5];
			$jenjang	=$rw[4];
			$kdmk		=$rw[7];
			$nmmk		=$rw[8];
			$gab		=$rw[4]." ".$rw[5];
			$id 		=$rw[0];
			$nm_kel_kul =$rw[9];
			$id_smt 	=$rw[11]; //20171
			$nim =$rw[1];
			$nama =$rw[2];
			$filterprod="nama_program_studi='$nama_prod' and nama_jenjang_pendidikan='$jenjang'";
			$pprodi=array("act"=>"GetProdi","token"=>$token,"filter"=>$filterprod,"limit"=>1);
			$idprodi=json_decode(runWS($pprodi));
			if(($idprodi->error_code==0) and (!empty($idprodi->data))){
				foreach ($idprodi->data as $validprod) {
				$id_prodi=$validprod->id_prodi;
				$cn->query("update krs_mahasiswa set id_prodi='$id_prodi',desk='' where id='$id'");
				}
			}else{
				$erkd=$idprodi->error_code;
				$erds=$idprodi->error_desc;
				$tem=$erkd."-".$erds;
				$cn->query("update krs_mahasiswa set desk='$tem' where id='$id'");
			}
			$filter="nim ='$nim' and nama_program_studi='$gab'";
			$data=array("act"=>"GetListMahasiswa",
						"token"=>$token,
						"filter"=>$filter,
						"limit"=>1);
			$id_reg_mhs=json_decode(runWS($data));
			if(($id_reg_mhs->error_code==0) and (!empty($id_reg_mhs->data))){
				foreach ($id_reg_mhs->data as  $value) {
				$id_rg=$value->id_registrasi_mahasiswa;
				$cn->query("update krs_mahasiswa set id_registrasi_mahasiswa='$id_rg',desk='' where id='$id'");
				}
			}else{
				$erkdmhs=$id_reg_mhs->error_code;
				$erdsmhs=$id_reg_mhs->error_desc;
				$temmhs=$erkdmhs."-".$erdsmhs;
				$cn->query("update krs_mahasiswa set desk='$temmhs' where id='$id'");
			}
			$filteridkls="id_semester='$id_smt' and id_prodi='$id_prodi' and kode_mata_kuliah='$kdmk' and nama_kelas_kuliah='$nm_kel_kul'";
					$dataidkls=array("act"=>"GetDetailKelasKuliah",
						"token"=>$token,
						"filter"=>$filteridkls,
						"limit"=>1);
					$id_kelas_kul=json_decode(runWS($dataidkls));
					if(($id_kelas_kul->error_code==0) and (!empty($id_kelas_kul->data))){
						foreach ($id_kelas_kul->data as $key) {
							$res_id_kelas_kul=$key->id_kelas_kuliah;
							$sql_updateidkls="update krs_mahasiswa set id_kelas_kuliah='$res_id_kelas_kul' where id='$id'";
							$cn->query($sql_updateidkls);							
						}
					}else{
						$erkdidkls=$id_kelas_kul->error_code;
						$erdsidkls=$id_kelas_kul->error_desc;
						$temidkls=$erkdidkls."-".$erdsidkls;
						$cn->query("update krs_mahasiswa set desk='$temidkls' where id='$id'");
					}
				$qstatus="update krs_mahasiswa set status='1' where id_kelas_kuliah IS NOT NULL and id_registrasi_mahasiswa IS NOT NULL ";
				$cn->query($qstatus);
			}
	}
}
$cn->close();	
header("location:../index.php?sub=krs");
// echo "<script>window.location.href='../index.php?sub=krs'</script>";
?>							