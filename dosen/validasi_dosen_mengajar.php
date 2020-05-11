<?php
session_start();
$token=$_SESSION['token'];
include_once("../config/koneksi.php");
include_once("../config.php");
$sql="select * from insertdosenpengajarkelaskuliah where status='0'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		for ($i=0; $i <$data1->num_rows ; $i++) {
			$rw=$data1->fetch_row();
			$nidn	    =$rw[0];
			$namadosen	=$rw[1];
			$id_smt 	=$rw[3];
			$jenjang	=$rw[4];
			$jurusan	=$rw[5];
			$kdmk		=trim($rw[6]," ");
			$nmmk		=trim($rw[7]," ");
			$gab		=$rw[4]." ".$rw[5];
			$renc_ttm 	=$rw[11];
			$reali_ttm 	=$rw[12];
			$nmEvaluasi =$rw[13];

			$act="GetListPenugasanDosen";
			$filter="nama_dosen='$namadosen' and nidn='$nidn' and id_tahun_ajaran='2017'";			
			$data=array("act"=>$act,
						"token"=>$token,
						"filter"=>$filter,
						"limit"=>1);
			$id_reg_dosen=json_decode(runWS($data));
			// print_r($id_reg_dosen);
			if(($id_reg_dosen->error_code==0) and (!empty($id_reg_dosen->data))){
				foreach ($id_reg_dosen->data as $key) {
							$idregdosen=$key->id_registrasi_dosen;
							$sql3="update insertdosenpengajarkelaskuliah set id_registrasi_dosen='$idregdosen',deskripsi='' where nidn='$nidn' and nama_dosen='$namadosen'";
							$cn->query($sql3);
				}
			}else{
				$kode_error=$id_reg_dosen->error_code;
				// $error_desc=$id_reg_dosen->error_desc;
				$error_desc="Data tidak ada";
				$sql3="update insertdosenpengajarkelaskuliah set error_kode='$kode_error',deskripsi='$error_desc' where nidn='$nidn' and nama_dosen='$namadosen'";
				$cn->query($sql3);
			}


			$act1="GetListKelasKuliah";
			$filteidkls="nama_program_studi='$gab' and id_semester='$id_smt' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk'";			
			// echo($filteidkls);
			$dataid_kelas=array("act"=>$act1,
						"token"=>$token,
						"filter"=>$filteidkls,
						"limit"=>1);
			$id_kls=json_decode(runWS($dataid_kelas));
			if(($id_kls->error_code==0) and (!empty($id_kls->data))){				
				foreach ($id_kls->data as $key1) {
					$res_id_kls=$key1->id_kelas_kuliah;
					$sks=$key1->sks;
					// echo($res_id_oorkls);
					$sql4="update insertdosenpengajarkelaskuliah set id_kelas_kuliah='$res_id_kls',sks_substansi_total='$sks', error_kode='',deskripsi='' where jenjang='$jenjang' and program_studi='$jurusan' and id_semester='$id_smt' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk'";
					$cn->query($sql4);
				}
			}else{
				$kode_error1=$id_kls->error_code;
				// $error_desc=$id_reg_dosen->error_desc;
				$error_desc1="id kelas kuliah tidak ada";
				$sql3="update insertdosenpengajarkelaskuliah set error_kode='$kode_error1',deskripsi='$error_desc1' where jenjang='$jenjang' and program_studi='$jurusan' and id_semester='$id_smt' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk'";
				$cn->query($sql3);
			}


		$act4="GetListSubstansiKuliah";
			$filtersubstansi="nama_program_studi='$gab' and nama_substansi='$nmmk'";			
			// echo($filteidkls);
			$idsubstansi=array("act"=>$act4,
						"token"=>$token,
						"filter"=>$filtersubstansi,
						"limit"=>1);
			$idsubs=json_decode(runWS($idsubstansi));
			if(($idsubs->error_code==0) and (!empty($idsubs->data))){				
				foreach ($idsubs->data as $key4) {
					$id_substansi=$key4->id_substansi;
					// echo($res_id_oorkls);
					$sql6="update insertdosenpengajarkelaskuliah set id_substansi='$id_substansi', error_kode='',deskripsi='' where jenjang='$jenjang' and program_studi='$jurusan' and id_semester='$id_smt' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk'";
					$cn->query($sql6);
				}
			}else{
				$kode_error6=$idsubs->error_code;
				$error_desc6=$idsubs->error_desc;
				// $error_desc1="id kelas kuliah tidak ada";
				$sql7="update insertdosenpengajarkelaskuliah set error_kode='$kode_error6',deskripsi='$error_desc6' where jenjang='$jenjang' and program_studi='$jurusan' and id_semester='$id_smt' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk'";
				$cn->query($sql7);
			}



			$act3="GetJenisEvaluasi";
			$filterev="nama_jenis_evaluasi='$nmEvaluasi'";
			$jenisev=array("act"=>$act3,
						"token"=>$token,
						"filter"=>$filterev,
						"limit"=>"1");
			$idjenisev=json_decode(runWS($jenisev));
			if(($idjenisev->error_code==0) and (!empty($idjenisev->data))){				
				foreach ($idjenisev->data as $key3) {
					$id_jenis_eval=$key3->id_jenis_evaluasi;
					$sql6="update insertdosenpengajarkelaskuliah set id_jenis_evaluasi='$id_jenis_eval', error_kode='',deskripsi='' where jenis_evaluasi='$nmEvaluasi' and nidn='$nidn' and kode_mata_kuliah='$kdmk' and jenjang='$jenjang' and program_studi='$jurusan' and id_semester='$id_smt'";
					$cn->query($sql6);
				}
			}else{
				$kode_error1=$id_kls->error_code;
				// $error_desc=$id_reg_dosen->error_desc;
				$error_desc1="Id Evaluasi kuliah tidak ada";
				$sql6="update insertdosenpengajarkelaskuliah set error_kode='$kode_error1',deskripsi='$error_desc1' where jenjang='$jenjang' and program_studi='$jurusan' and id_semester='$id_smt' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk' and jenis_evaluasi='$nmEvaluasi'";
				$cn->query($sql6);
			}

			$sql5="update insertdosenpengajarkelaskuliah set status='1', error_kode='',deskripsi='' where id_registrasi_dosen IS NOT NULL AND id_kelas_kuliah IS NOT NULL AND id_jenis_evaluasi IS NOT NULL";
			$cn->query($sql5);
					
					} //end for
				}//end if >0
			}//end if query			
	header("location:../index.php?sub=dosen");
?>							