<?php
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token = $_SESSION['token'];

// input data judul	
$sql = "select * from aktivitasmahasiswa";
if ($data = $cn->query($sql)) {
	if ($data->num_rows > 0) {
		while ($row = $data->fetch_assoc()) {
			$id_anggota = $row['id_anggota'];
			
			$key = "id_anggota='$id_anggota'";
			$ws_cek = array(
				"act" => "DeleteAnggotaAktivitasMahasiswa",
				"token" => $token,
				"key" => $key
			);
            $result_cek_data = json_decode(runWS($ws_cek));
            echo "<pre>";
            print_r($result_cek_data);
            echo "</pre>";
		}
	}
}



// jika menggunakan Href
header("location:../index.php?sub=aktivitasmhs");



