<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select kode_mata_kuliah,nama_mata_kuliah,id_prodi,id_jenis_mata_kuliah,id_kelompok_mata_kuliah,sks_mata_kuliah,sks_tatap_muka,sks_praktek,sks_praktek_lapangan,sks_simulasi,metode_kuliah,ada_sap,ada_silabus,ada_bahan_ajar,ada_acara_praktek,ada_diktat,tanggal_mulai_efektif from insertmatakuliah where status='1'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		while ($rw=$data1->fetch_assoc()){
		$kodemk			=$rw['kode_mata_kuliah'];
		$namamk			=$rw['nama_mata_kuliah'];
		$id_prodi		=$rw['id_prodi'];


		$act		="InsertMataKuliah";
		$ws=array("act"=>$act,
					"token"=>$token,
					"record"=>$rw);
		$hasil_transfer=json_decode(RunWS($ws));
		if ($hasil_transfer->error_code==0){
				$idrg=$hasil_transfer->data->id_matkul;
				$sqldel="delete from insertmatakuliah where kode_mata_kuliah='$kodemk' and nama_mata_kuliah='$namamk' and id_prodi='$id_prodi'";
				$cn->query($sqldel);		
		}else{
			$erkode =$hasil_transfer->error_code;
			$erdesc =$cn->real_escape_string($hasil_transfer->error_desc);
			$sqlerr="update insertmatakuliah set kode_error='$erkode', deskripsi='$erdesc',status='1' where  kode_mata_kuliah='$kodemk' and nama_mata_kuliah='$namamk' and id_prodi='$id_prodi'";
			$cn->query($sqlerr);
		}
	}
	}
}
echo "<script>window.location.href='../index.php?sub=matkul';</script>";
 ?>
