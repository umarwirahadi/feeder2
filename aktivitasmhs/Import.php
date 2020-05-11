<?php
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token = $_SESSION['token'];

// input data judul	
$sql = "select jenis_anggota,id_jenis_aktivitas,id_prodi,id_semester,judul,keterangan,lokasi,sk_tugas,tanggal_sk_tugas from aktivitasmahasiswa where status='3'";
if ($data = $cn->query($sql)) {
	if ($data->num_rows > 0) {
		while ($row = $data->fetch_assoc()) {
			$jenis_anggota = $row['jenis_anggota'];
			$id_jenis_aktivitas = $row['id_jenis_aktivitas'];
			$id_prodi = $row['id_prodi'];
			$id_semester = $row['id_semester'];
			$judul = mysqli_escape_string($cn, $row['judul']);

			$filter_cari = "id_jenis_aktivitas='$id_jenis_aktivitas' and id_semester='$id_semester' and id_prodi='$id_prodi' and judul='$judul'";
			$ws_cek = array(
				"act" => "GetListAktivitasMahasiswa",
				"token" => $token,
				"filter" => $filter_cari
			);
			$result_cek_data = json_decode(runWS($ws_cek));
			if (count($result_cek_data->data) == 0) {
				$ws = array(
					"act" => "InsertAktivitasMahasiswa",
					"token" => $token,
					"record" => $row
				);
				$result_insert = json_decode(runWS($ws));
				if ($result_insert->error_code == 0) {
					$id_aktivitas = $result_insert->data->id_aktivitas;
					$sql = "update aktivitasmahasiswa set id_aktivitas='$id_aktivitas',deskripsi='',status='4' where jenis_anggota='$jenis_anggota' 
								and id_prodi='$id_prodi' and id_jenis_aktivitas='$id_jenis_aktivitas' and id_semester='$id_semester' and id_prodi='$id_prodi' and judul='$judul' and status='3'";
					$cn->query($sql);
				} elseif ($result_insert->error_code <> 0) {
					$error_desc = mysqli_real_escape_string($cn, $result_insert->error_desc);
					$error_code = $result_insert->error_code;
					$sql1 = "update aktivitasmahasiswa set deskripsi='$error_code - $error_desc',status='3' where jenis_anggota='$jenis_anggota' 
								and id_prodi='$id_prodi' and id_jenis_aktivitas='$id_jenis_aktivitas' and id_semester='$id_semester' and status='3'";
					$cn->query($sql1);
				}
			} else {
				foreach ($result_cek_data->data as $id) {
					$sql1 = "update aktivitasmahasiswa set id_aktivitas='$id->id_aktivitas',deskripsi='',status='4' where jenis_anggota='$jenis_anggota' 
									and id_prodi='$id_prodi' and id_jenis_aktivitas='$id_jenis_aktivitas' and id_semester='$id_semester' and judul='$judul' and status='3'";
					$cn->query($sql1);
				}
			}
		}
	}
}

// input data InsertAnggotaAktivitasMahasiswa	
$sql2 = "select id_aktivitas,id_registrasi_mahasiswa,jenis_peran from aktivitasmahasiswa where status='4'";
if ($data = $cn->query($sql2)) {
	if ($data->num_rows > 0) {
		while ($row2 = $data->fetch_assoc()) {
			$id_aktivitas 			 = $row2['id_aktivitas'];
			$id_registrasi_mahasiswa = $row2['id_registrasi_mahasiswa'];
			$jenis_peran 			 = $row2['jenis_peran'];
			
			// cek jika data ada 
			$filter_cari2 = "id_aktivitas='$id_aktivitas' and id_registrasi_mahasiswa='$id_registrasi_mahasiswa'";
			$ws_cek2 = array(
				"act" => "GetListAnggotaAktivitasMahasiswa",
				"token" => $token,
				"filter" => $filter_cari2
			);
			$result_cek_data = json_decode(runWS($ws_cek2));
		

			if (count($result_cek_data->data) == 0) {
				$ws = array(
					"act" => "InsertAnggotaAktivitasMahasiswa",
					"token" => $token,
					"record" => $row2
				);
				$id_anggota = json_decode(runWS($ws));
				if ($id_anggota->error_code == 0) {
					$id_anggota2 = $id_anggota->data->id_anggota;
					$sqlupdateidanggota = "update aktivitasmahasiswa set id_anggota='$id_anggota2',deskripsi='',status='5' where id_aktivitas='$id_aktivitas'";
					$cn->query($sqlupdateidanggota);
				} elseif ($id_anggota->error_code <> 0) {
					$error_desc = mysqli_real_escape_string($cn, $id_anggota->error_desc);
					$error_code = $id_anggota->error_code;
					$sqlupdateidanggota = "update aktivitasmahasiswa set deskripsi='$error_code - $error_desc',status='4' where id_aktivitas='$id_aktivitas'";
					$cn->query($sqlupdateidanggota);
					
				}
			}else{				
				foreach ($result_cek_data->data as $keys) {
					$sql1 = "update aktivitasmahasiswa set id_anggota='$keys->id_anggota',deskripsi='',status='5' where id_aktivitas='$id_aktivitas' and id_registrasi_mahasiswa='$id_registrasi_mahasiswa'";
					$cn->query($sql1)  or die(mysqli_error($cn));
				}
			}
		}
	}
}


// input data InsertBimbingMahasiswa	
$sql2 = "select id_aktivitas,id_kategori_kegiatan,id_dosen_pembimbing as id_dosen,pembimbing_ke from aktivitasmahasiswa where status='5'";
if ($data = $cn->query($sql2)) {
	if ($data->num_rows > 0) {
		while ($row3 = $data->fetch_assoc()) {
			$id_aktivitas 			 	= $row3['id_aktivitas'];
			$id_kategori_kegiatan 		= $row3['id_kategori_kegiatan'];
			$id_dosen 					= $row3['id_dosen'];
			$pembimbing_ke 				= $row3['pembimbing_ke'];
			
			// cek jika data ada 
			$filter_cari2 = "id_aktivitas='$id_aktivitas' and id_kategori_kegiatan='$id_kategori_kegiatan' and id_dosen='$id_dosen'";
			$ws_cek2 = array(
				"act" => "GetListBimbingMahasiswa",
				"token" => $token,
				"filter" => $filter_cari2
			);
			$result_cek_data = json_decode(runWS($ws_cek2));			
			if (count($result_cek_data->data) == 0) {
				$ws = array(
					"act" => "InsertBimbingMahasiswa",
					"token" => $token,
					"record" => $row3
				);
				$id_bimbing_mahasiswa = json_decode(runWS($ws));
				if ($id_bimbing_mahasiswa->error_code == 0) {
					$id_bimbing_mahasiswa2 = $id_bimbing_mahasiswa->data->id_bimbing_mahasiswa;
					$sqlid_bimbing_mahasiswa = "update aktivitasmahasiswa set id_bimbing_mahasiswa='$id_bimbing_mahasiswa2',deskripsi='',status='6' where id_aktivitas='$id_aktivitas'";
					$cn->query($sqlid_bimbing_mahasiswa) or die(mysqli_error($cn));
				} elseif ($id_bimbing_mahasiswa->error_code <> 0) {
					$error_desc = mysqli_real_escape_string($cn, $id_bimbing_mahasiswa->error_desc);
					$error_code = $id_bimbing_mahasiswa->error_code;
					$sqlid_bimbing_mahasiswa = "update aktivitasmahasiswa set deskripsi='$error_code - $error_desc',status='5' where id_aktivitas='$id_aktivitas'";
					$cn->query($sqlid_bimbing_mahasiswa);					
				}
			}else{			
				foreach ($result_cek_data->data as $keys) {
					$sql1 = "update aktivitasmahasiswa set id_bimbing_mahasiswa='$keys->id_bimbing_mahasiswa',deskripsi='',status='6' where id_aktivitas='$id_aktivitas'";
					$cn->query($sql1)  or die(mysqli_error($cn));
				}
			}
		}
	}
}

// input data penguji	
$sql2 = "select id_aktivitas,id_kategori_kegiatan,id_dosen_penguji as id_dosen,penguji_ke from aktivitasmahasiswa where status='6'";
if ($data = $cn->query($sql2)) {
	if ($data->num_rows > 0) {
		while ($row3 = $data->fetch_assoc()) {
			$id_aktivitas 			 	= $row3['id_aktivitas'];
			$id_kategori_kegiatan 		= $row3['id_kategori_kegiatan'];
			$id_dosen 					= $row3['id_dosen'];
			$penguji_ke 				= $row3['penguji_ke'];
			
			// cek jika data ada 
			$filter_cari2 = "id_aktivitas='$id_aktivitas' and id_kategori_kegiatan='$id_kategori_kegiatan' and id_dosen='$id_dosen'";
			$ws_cek2 = array(
				"act" => "GetListUjiMahasiswa",
				"token" => $token,
				"filter" => $filter_cari2
			);
			$result_cek_data = json_decode(runWS($ws_cek2));			
			if (count($result_cek_data->data) == 0) {
				$ws = array(
					"act" => "InsertUjiMahasiswa",
					"token" => $token,
					"record" => $row3
				);
				$id_uji_mahasiswa = json_decode(runWS($ws));
				if ($id_uji_mahasiswa->error_code == 0) {
					$id_uji_mahasiswa2 = $id_uji_mahasiswa->data->id_uji;
					$sqlid_bimbing_mahasiswa = "update aktivitasmahasiswa set id_uji='$id_uji_mahasiswa2',deskripsi='',status='7' where id_aktivitas='$id_aktivitas'";
					$cn->query($sqlid_bimbing_mahasiswa) or die(mysqli_error($cn));
				} elseif ($id_uji_mahasiswa->error_code <> 0) {
					$error_desc = mysqli_real_escape_string($cn, $id_uji_mahasiswa->error_desc);
					$error_code = $id_uji_mahasiswa->error_code;
					$sqlid_bimbing_mahasiswa = "update aktivitasmahasiswa set deskripsi='$error_code - $error_desc',status='6' where id_aktivitas='$id_aktivitas'";
					$cn->query($sqlid_bimbing_mahasiswa);					
				}
			}else{			
				foreach ($result_cek_data->data as $keys) {
					$sql1 = "update aktivitasmahasiswa set id_uji='$keys->id_uji',deskripsi='',status='7' where id_aktivitas='$id_aktivitas'";
					$cn->query($sql1)  or die(mysqli_error($cn));
				}
			}
		}
	}
}


// jika menggunakan Href
header("location:../index.php?sub=aktivitasmhs");
