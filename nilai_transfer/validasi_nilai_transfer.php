<?php 
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select * from nilai_transfer where status='0'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){		
		while ($rw=$data1->fetch_assoc()){
		$npm 		=$rw['nim'];
		$nama 		=$cn->real_escape_string($rw['nama_mahasiswa']);
		$a  		=$rw['jenjang'];
		$b  		=$rw['jurusan'];
		$kdmk		=$rw['kode_mata_kuliah_asal'];
		$nmmk		=$rw['nama_mata_kuliah_asal'];
		$jurusan	=$rw['jenjang']." ".$rw['jurusan'];		
		$act		="GetListMahasiswa";
		$filter		="nim='$npm' and nama_program_studi='$jurusan'";
		$order 		="";
		$limit 		="";
		$offset 	="";		
		$ws=array("act"=>$act,
					"token"=>$token,
					"filter"=>$filter,
					"order"=>$order,
					"limit"=>$limit,
					"offset"=>$offset);
		$hasil=json_decode(RunWS($ws));
		if ($hasil->error_code==0){			
			foreach ($hasil->data as $row) {
				$id_reg_mhs=$row->id_registrasi_mahasiswa;
				$sql="update nilai_transfer set id_registrasi_mahasiswa='$id_reg_mhs',eror_code='',eror_deskripsi='' where nim='$npm' and nama_mahasiswa='$nama' and jenjang='$a' and jurusan='$b'";
				$res=$cn->query($sql);

			}
		}elseif ($hasil->error_code<>0) {
			$erkode =$hasil->error_code;
			$erdesc =$hasil->error_desc;
			$sql="update nilai_transfer set eror_code='$erkode',eror_deskripsi='$erdesc' where nim='$npm' and nama_mahasiswa='$nama' and jenjang='$a' and jurusan='$b'";
			$res=$cn->query($sql);
		}

		// update mata kuliah
		$act		="GetListMataKuliah";
		$filter		="kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk'";
		$order 		="";
		$limit 		="1";
		$offset 	="";		
		$ws=array("act"=>$act,
					"token"=>$token,
					"filter"=>$filter,
					"order"=>$order,
					"limit"=>$limit,
					"offset"=>$offset);
		$id_matkul=json_decode(RunWS($ws));
		// print_r($id_matkul);
		if ($id_matkul->error_code==0){			
			foreach ($id_matkul->data as $row) {
				$id_matkul=$row->id_matkul;
				$sql="update nilai_transfer set id_matkul='$id_matkul',status='2',eror_code='',eror_deskripsi='' where nim='$npm' and nama_mahasiswa='$nama' and jenjang='$a' and jurusan='$b' and kode_mata_kuliah_asal='$kdmk' and nama_mata_kuliah_asal='$nmmk'";
				$res=$cn->query($sql);
			}
		}elseif ($hasil->error_code<>0) {
			$erkode =$hasil->error_code;
			$erdesc =$cn->real_escape_string($hasil->error_desc);
			$sql="update nilai_transfer set eror_code='$erkode',eror_deskripsi='$erdesc' where nim='$npm' and nama_mahasiswa='$nama' and jenjang='$a' and jurusan='$b' and kode_mata_kuliah_asal='$kdmk' and nama_mata_kuliah_asal='$nmmk'";
			$res=$cn->query($sql);
		}
		// }
	
	}
	}else{
		echo "error :".$cn->error;
	}
	// echo "<script>alert('Data berhasil diupload');</script>";
	$cn->close();
	header("location:../index.php?sub=nilaiTransfer");
		
}else{
	echo "error :".$cn->error;
}
 ?>
