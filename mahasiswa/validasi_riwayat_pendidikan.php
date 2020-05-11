<?php
session_start();
$token =$_SESSION['token'];
require_once("../config.php");
require_once ("../config/koneksi.php");

//proses update data prodi 		
$sql="select id_prodi,nama_program_studi,nama_jenjang_pendidikan from prodipt";
if($record=$cn->query($sql)){
	if($record->num_rows>0){
		while ($row=$record->fetch_assoc()) {
			$idprodi 	=$row['id_prodi'];
			$namaprodi  =$row['nama_program_studi'];
			$jenjang    =$row['nama_jenjang_pendidikan'];
			$sql1="update updateriwayatpendidikanmahasiswa set id_prodi='$idprodi',desk='', status='1' where prodi='$namaprodi' and jenjang='$jenjang'";
			$cn->query($sql1);			
		}
	}
} //end update prodi

//proses update data PT
$sql2="select id_perguruan_tinggi from getprofilpt limit 1";
if($record1=$cn->query($sql2)){ 
	if($record1->num_rows==1){
		while ($row1=$record1->fetch_row()) {
			$id_pt 	=$row1[0];
			$sql3="update updateriwayatpendidikanmahasiswa set id_perguruan_tinggi='$id_pt',desk='',status='2'";
			$cn->query($sql3);			
			}
		}
	} //end of cari nama_prodi

//proses update data PT Asal
$sql4="select nama_pt_asal from updateriwayatpendidikanmahasiswa";
if($record4=$cn->query($sql4)){
	if($record4->num_rows>=1){
		while ($row4=$record4->fetch_row()) {
			$nama_pt_asal 	= ucwords($row4[0]);
			$filter_pt_asal="nama_perguruan_tinggi='$nama_pt_asal'";
			$data_pt_asal=["act"=>"GetAllPT","token"=>$token,"filter"=>$filter_pt_asal,"limit"=>"1"];
			$id_pt_asal=json_decode(runWS($data_pt_asal));
			if ($id_pt_asal->error_code==0 && (!empty($id_pt_asal->data))){
				foreach ($id_pt_asal->data as $key2) {
					$id_pt_asal=$key2->id_perguruan_tinggi;
				}
			}
			$sql3="update updateriwayatpendidikanmahasiswa set id_perguruan_tinggi_asal='$id_pt',desk='',status='2'";
			$cn->query($sql3);			
			}
		}
	} //end of cari nama_prodi

//proses update data Prodi Asal
$sql4="select jenjang_asal,nama_prodi_asal from updateriwayatpendidikanmahasiswa";
if($record4=$cn->query($sql4)){
	if($record4->num_rows>=1){
		while ($row4=$record4->fetch_row()) {
			$jenjang_asal 	= $row4[0];
			$prodi_asal 	= ucwords($row4[1]);
			$filter_prodi_asal="nama_jenjang_pendidikan='$jenjang_asal' and nama_program_studi='$prodi_asal'";
			$data_prodi_asal=["act"=>"GetProdi","token"=>$token,"filter"=>$filter_prodi_asal,"limit"=>"1"];
			$id_prodi_asal=json_decode(runWS($data_prodi_asal));
			if ($id_prodi_asal->error_code==0 && (!empty($id_prodi_asal->data))){
				foreach ($id_prodi_asal->data as $key5) {
					$id_prodi_asal_ok=$key5->id_prodi;
					$sql3="update updateriwayatpendidikanmahasiswa set id_prodi_asal='$id_prodi_asal_ok',desk='',status='3'";
					$cn->query($sql3);
				}
			}
			}
		}
	} //end of cari nama_prodi

$sql3="select nama_mahasiswa,tempat_lahir,tgl_lahir,nama_ibu from updateriwayatpendidikanmahasiswa where status='3'";
if($data=$cn->query($sql3)){
	if($data->num_rows>0){
		while($row=$data->fetch_assoc()){

			$namamhs=$row['nama_mahasiswa'];
			$templahir=$row['tempat_lahir'];
			$tgllahir=$row['tgl_lahir'];
			$namaibu=$row['nama_ibu'];
			
			$filter_ada="nama_mahasiswa='$namamhs' and tempat_lahir='$templahir' and tanggal_lahir='$tgllahir'";
					$data3 =["act"=>"GetBiodataMahasiswa",
							  "token"=>$token,
							  "filter"=>$filter_ada,
							  "limit"=>1];
					$id_mhs2=json_decode(runWS($data3));
					if($id_mhs2->error_code==0 && (!empty($id_mhs2->data))){
						foreach ($id_mhs2->data as $key) {
						$idmhs=$key->id_mahasiswa;
						$queryy="update updateriwayatpendidikanmahasiswa set status='3',id_mahasiswa='$idmhs' where nama_mahasiswa='$namamhs' and tempat_lahir='$templahir' and tgl_lahir='$tgllahir'";
						$cn->query($queryy);
						}						
					}else{
						$queryy="update updateriwayatpendidikanmahasiswa set status='2',desk='Mahasiswa tidak ditemukan, periksa kembali Nama, tempat lahir, tgl lahirnya' where nama_mahasiswa='$namamhs' and tempat_lahir='$templahir' and tgl_lahir='$tgllahir'";
						$cn->query($queryy);
					}	
		}
}//end jumlah record
}
header("location:../index.php?sub=list_mahasiswa&list=1");
// jika muncul code error SQL error 103 itu menunjukan field disi dengan record yang tidak sesuai contoh : id wilayah harusnya 0122373 tp malah diisi 122373
?>