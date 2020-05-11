<?php
// define("site_root", __DIR__);
session_start();
$token = $_SESSION['token'];
require_once "../config.php";
require_once "../config/koneksi.php";

//proses update data prodi 		
$sql = "select id_prodi,nama_program_studi,nama_jenjang_pendidikan from prodipt";
if ($record = $cn->query($sql)) {
	if ($record->num_rows > 0) {
		while ($row = $record->fetch_assoc()) {
			$idprodi 	= $row['id_prodi'];
			$namaprodi  = $row['nama_program_studi'];
			$jenjang    = $row['nama_jenjang_pendidikan'];
			$sql1 = "update aktivitasmahasiswa set id_prodi='$idprodi',deskripsi='',status='1' where prodi='$namaprodi' and jenjang='$jenjang'";
			$cn->query($sql1);
			echo $cn->error;
		}
	}
} //end update prodi


$sql4 = "select jenis_aktivitas,nama_kategori_kegiatan,nidn,nidn_penguji,id from aktivitasmahasiswa";
if ($record1 = $cn->query($sql4)) {
	if ($record1->num_rows >= 1) {
		while ($row1 = $record1->fetch_row()) {
			
			$id 	= $row1[4];
			$jenis 	= $row1[0];
			$filter = "nama_jenis_aktivitas_mahasiswa='$jenis'";
			$data = array(
				'act' => 'GetJenisAktivitasMahasiswa',
				'token' => $token,
				'filter' => $filter,
				'limit' => ''
			);
			$res = json_decode(runWS($data));

			foreach ($res->data as $key) {
				$sql3 = "update aktivitasmahasiswa set id_jenis_aktivitas='$key->id_jenis_aktivitas_mahasiswa',deskripsi='',status='2' where id=$id";
				$cn->query($sql3) or die(mysqli_error($cn));
			}
			
			// validasi kategori
			$kategori 	= $row1[1];
			$filter2 = "nama_kategori_kegiatan lik'$kategori'";
			$data5 = array(
				'act' => 'GetKategoriKegiatan',
				'token' => $token,
				'filter' => '',
				'limit' => ''
			);
			$reskategori = json_decode(runWS($data5));
			foreach ($reskategori->data as $key5) {
				$qupdatekategori = "update aktivitasmahasiswa set id_kategori_kegiatan='$key5->id_kategori_kegiatan',deskripsi='',status='2' where id=$id";
				$cn->query($qupdatekategori) or die(mysqli_error($cn));
			}
			// validasi dosen pembimbing
			$nidn 	= $row1[2];
			$filter3 = "nidn ='$nidn'";
			$data6 = array(
				'act' => 'GetListDosen',
				'token' => $token,
				'filter' => $filter3,
				'limit' => ''
			);
			$iddos = json_decode(runWS($data6));
			foreach ($iddos->data as $key6) {
				$sqlnidn = "update aktivitasmahasiswa set id_dosen_pembimbing='$key6->id_dosen',deskripsi='',status='2' where id=$id";
				$cn->query($sqlnidn) or die(mysqli_error($cn));
			}

			//validasi dosen penguji
			$nidnpenguji 	= $row1[3];
			$filter4 = "nidn ='$nidnpenguji'";
			$data7 = array(
				'act' => 'GetListDosen',
				'token' => $token,
				'filter' => $filter4,
				'limit' => ''
			);
			$iddospenguji = json_decode(runWS($data7));
			foreach ($iddospenguji->data as $key7) {
				$sqlnidnpenguji = "update aktivitasmahasiswa set id_dosen_penguji='$key7->id_dosen',deskripsi='',status='2' where id=$id";
				$cn->query($sqlnidnpenguji) or die(mysqli_error($cn));
			}

		}
	}
}

// validasi kategori 
// $sql6="select nama_kategori_kegiatan from aktivitasmahasiswa";
// if($record1=$cn->query($sql6)){ 
// 	if($record1->num_rows>=1){
// 		while ($row1=$record1->fetch_row()) {
// 			$kategori 	=$row1[0];
//             $filter="nama_kategori_kegiatan='$kategori'";
//             $data=array('act'=>'GetKategoriKegiatan',
//             'token'=>$token,
//             'filter'=>$filter,
//             'limit'=>'');
//             $reskategori=json_decode(runWS($data));

//             foreach ($reskategori->data as $key) {                
//                 $qupdatekategori="update aktivitasmahasiswa set id_kategori_kegiatan='$key->id_kategori_kegiatan',deskripsi='',status='4' where nama_kategori_kegiatan='$jenis'";
//                 $cn->query($qupdatekategori) or die(mysqli_error($cn));
//             }

// 			}
// 		}
// 	}


// validasi mahasiswa 


$sql5 = "select nim,nama_mahasiswa,id_prodi from aktivitasmahasiswa";
if ($record1 = $cn->query($sql5)) {
	if ($record1->num_rows >= 1) {
		while ($row1 = $record1->fetch_row()) {

			$nim 		= $row1[0];
			$nama 		= $cn->real_escape_string($row1[1]);
			$id_prodi 	= $row1[2];

			$act		= "GetListMahasiswa";
			$filter		= "nim='$nim' and id_prodi='$id_prodi'";
			$order 		= "";
			$limit 		= "";
			$offset 	= "";
			$ws = array(
				"act" => $act,
				"token" => $token,
				"filter" => $filter,
				"order" => $order,
				"limit" => $limit,
				"offset" => $offset
			);
			$hasil = json_decode(RunWS($ws));
			if ($hasil->error_code == 0) {
				foreach ($hasil->data as $key) {
					$idreg = $key->id_registrasi_mahasiswa;
				}
				$sql = "update aktivitasmahasiswa set id_registrasi_mahasiswa='$idreg',status='3' where nim='$nim' and id_prodi='$id_prodi'";
				$cn->query($sql);
			} else {
				$errcode = $hasil->error_code;
				$errdesc = $cn->real_escape_string($hasil->error_desc);
				$sql = "update aktivitasmahasiswa set status='2',deskripsi='$errdesc',kode_error='$errcode' where nim='$nim' and id_prodi='$id_prodi'";
				$cn->query($sql);
			}
		}
	}
}





header("location:../index.php?sub=aktivitasmhs");



// jika muncul code error SQL error 103 itu menunjukan field disi dengan record yang tidak sesuai contoh : id wilayah harusnya 0122373 tp malah diisi 122373
