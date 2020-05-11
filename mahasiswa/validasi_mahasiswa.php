<?php
session_start();
include_once("../config.php");
$token =$_SESSION['token'];
include_once("../config/koneksi.php");

//proses update data prodi 		
$sql="select id_prodi,nama_program_studi,nama_jenjang_pendidikan from prodipt";
if($record=$cn->query($sql)){ //jalankan proses update id prodi di tbl mahasiswa dari tbl prodipt
	if($record->num_rows>0){
		while ($row=$record->fetch_assoc()) {
			$idprodi 	=$row['id_prodi'];
			$namaprodi  =$row['nama_program_studi'];
			$jenjang    =$row['nama_jenjang_pendidikan'];
			$sql1="update mahasiswa set id_prodi='$idprodi',deskripsi='',status='2' where nama_prodi='$namaprodi' and jenjang='$jenjang'";
			$cn->query($sql1);
		}
	}
} //end update prodi



//proses update data PT
$sql2="select id_perguruan_tinggi from getprofilPT limit 1";
if($record1=$cn->query($sql2)){ 
	if($record1->num_rows==1){
		while ($row1=$record1->fetch_row()) {
			$id_pt 	=$row1[0];
			// echo "id pt :".$id_pt;
			$sql3="update mahasiswa set id_perguruan_tinggi='$id_pt',deskripsi='',status='3'";
			$cn->query($sql3);			
			}
		}
	} //end of cari nama_prodi

// $sql3="select nama_mahasiswa,jenis_kelamin,tempat_lahir,tanggal_lahir,id_agama,nik,nisn,npwp,kewarganegaraan,jalan,dusun,rt,rw,kelurahan,kode_pos,id_wilayah,id_jenis_tinggal,	id_alat_transportasi,telepon,handphone,email,penerima_kps,nomor_kps,nik_ayah,nama_ayah,id_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah,nik_ibu,nama_ibu_kandung,id_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,nama_wali,id_pendidikan_wali,id_pekerjaan_wali,id_penghasilan_wali,id_kebutuhan_khusus_mahasiswa,id_kebutuhan_khusus_ayah,id_kebutuhan_khusus_ibu from mahasiswa where status='3'";
$sqlinst="select nama_mahasiswa,jenis_kelamin,tempat_lahir,tanggal_lahir,id_agama,nik,nisn,npwp,kewarganegaraan,jalan,dusun,rt,rw,kelurahan,kode_pos,id_wilayah,id_jenis_tinggal,
		  id_alat_transportasi,telepon,handphone,email,penerima_kps,nomor_kps,nik_ayah,nama_ayah,tanggal_lahir_ayah,id_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah,nik_ibu,
		  nama_ibu_kandung,tanggal_lahir_ibu,id_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,nama_wali,tanggal_lahir_wali,id_pendidikan_wali,id_pekerjaan_wali,id_penghasilan_wali,
		  id_kebutuhan_khusus_mahasiswa,id_kebutuhan_khusus_ayah,id_kebutuhan_khusus_ibu from mahasiswa where status='3'";
if($data=$cn->query($sqlinst)){
	if($data->num_rows >0){
		while($row=$data->fetch_assoc()){			
		$ws=array("act"=>'InsertBiodataMahasiswa',
					"token"=>$token,
					"record"=>$row);

		$result_insert=json_decode(runWS($ws));
		$nama_siswa=trim($cn->real_escape_string($row['nama_mahasiswa']));
		$tgl_lahir=$row['tanggal_lahir'];		
		$ibu_kandung=$cn->real_escape_string($row['nama_ibu_kandung']);
		print_r($result_insert);
			if($result_insert->error_code==0){	
				$id_mhs=$result_insert->data->id_mahasiswa;
				$sql4="update mahasiswa set id_mahasiswa='$id_mhs',status='4' where nama_mahasiswa='$nama_siswa' and tanggal_lahir='$tgl_lahir' and nama_ibu_kandung='$ibu_kandung'";
				$cn->query($sql4);
			}elseif($result_insert->error_code<>0){				
				if ($result_insert->error_code==200) {
					$filter_sudah_ada="nama_mahasiswa ilike '%$nama_siswa%' and tanggal_lahir='$tgl_lahir'";
					$data3 =["act"=>"GetListMahasiswa",
							  "token"=>$token,
							  "filter"=>$filter_sudah_ada,
							  "limit"=>1];
					$id_mhs2=json_decode(runWS($data3));
					foreach ($id_mhs2->data as $value){
						$id_mhs3=$value->id_mahasiswa;
						$sql1="update mahasiswa set id_mahasiswa='$id_mhs3',deskripsi='',status='4' where nama_mahasiswa='$nama_siswa' and tanggal_lahir='$tgl_lahir' and nama_ibu_kandung='$ibu_kandung'";
						$cn->query($sql1);
					}
				}
				else{
					$error_descc=$cn->real_escape_string($result_insert->error_desc);
					$error_codee=$cn->real_escape_string($result_insert->error_code);
					$sql1="update mahasiswa set deskripsi='$error_codee - $error_descc',status='3' where nama_mahasiswa='$nama_siswa' and tanggal_lahir='$tgl_lahir' and nama_ibu_kandung='$ibu_kandung'";
					$cn->query($sql1);
				}
				}
		}
}//end jumlah record
}else{
	//header("location:../index.php?sub=list_mahasiswa&list=2");
}
//header("location:../index.php?sub=list_mahasiswa&list=2");



// jika muncul code error SQL error 103 itu menunjukan field disi dengan record yang tidak sesuai contoh : id wilayah harusnya 0122373 tp malah diisi 122373
?>