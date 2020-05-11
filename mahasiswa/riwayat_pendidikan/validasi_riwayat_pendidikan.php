<?php
// define("site_root", __DIR__);
session_start();
$token =$_SESSION['token'];
require_once "../../config.php";
require_once "/config/koneksi.php";

//proses update data prodi 		
$sql="select id_prodi,nama_program_studi,nama_jenjang_pendidikan from prodipt";
if($record=$cn->query($sql)){
	if($record->num_rows>0){
		while ($row=$record->fetch_assoc()) {
			$idprodi 	=$row['id_prodi'];
			$namaprodi  =$row['nama_program_studi'];
			$jenjang    =$row['nama_jenjang_pendidikan'];
			$sql1="update updateriwayatpendidikanmahasiswa set id_prodi='$idprodi',deskripsi='',status='1' where nama_prodi='$namaprodi' and jenjang='$jenjang'";
			$cn->query($sql1);
			echo $cn->error;
		}
	}
} //end update prodi



//proses update data PT
$sql2="select id_perguruan_tinggi from profilePT limit 1";
if($record1=$cn->query($sql2)){ 
	if($record1->num_rows==1){
		while ($row1=$record1->fetch_row()) {
			$id_pt 	=$row1[0];
			// echo "id pt :".$id_pt;
			$sql3="update updateriwayatpendidikanmahasiswa set id_perguruan_tinggi='$id_pt',deskripsi='',status='2'";
			$cn->query($sql3);			
			}
		}
	} //end of cari nama_prodi

// $sql3="select nama_mahasiswa,jenis_kelamin,tempat_lahir,tanggal_lahir,id_agama,nik,nisn,npwp,kewarganegaraan,jalan,dusun,rt,rw,kelurahan,kode_pos,id_wilayah,id_jenis_tinggal,	id_alat_transportasi,telepon,handphone,email,penerima_kps,nomor_kps,nik_ayah,nama_ayah,id_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah,nik_ibu,nama_ibu_kandung,id_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,nama_wali,id_pendidikan_wali,id_pekerjaan_wali,id_penghasilan_wali,id_kebutuhan_khusus_mahasiswa,id_kebutuhan_khusus_ayah,id_kebutuhan_khusus_ibu from mahasiswa where status='3'";
$sql3="select nama_mahasiswa,jenis_kelamin,tempat_lahir,tanggal_lahir,id_agama,nik,nisn,npwp,kewarganegaraan,jalan,dusun,rt,rw,kelurahan,kode_pos,id_wilayah,id_jenis_tinggal,id_alat_transportasi,telepon,handphone,email,penerima_kps,nomor_kps,nik_ayah,nama_ayah,tanggal_lahir_ayah,id_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah,nik_ibu,nama_ibu_kandung,tanggal_lahir_ibu,id_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,nama_wali,tanggal_lahir_wali,id_pendidikan_wali,id_pekerjaan_wali,id_penghasilan_wali,id_kebutuhan_khusus_mahasiswa,id_kebutuhan_khusus_ayah,id_kebutuhan_khusus_ibu from mahasiswa where status='3'";



if($data=$cn->query($sql3)){
	if($data->num_rows >0){
		while($row=$data->fetch_assoc()){
			
		$ws=array("act"=>'InsertBiodataMahasiswa',
					"token"=>$token,
					"record"=>$row);

		$result_insert=json_decode(runWS($ws));


	
		}
}//end jumlah record
}else{
	echo "<br>Error Proses Eksekusi : ".$cn->error;
}
header("location:../index.php?sub=list_mahasiswa&list=1");



// jika muncul code error SQL error 103 itu menunjukan field disi dengan record yang tidak sesuai contoh : id wilayah harusnya 0122373 tp malah diisi 122373
?>