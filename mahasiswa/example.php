<form action="" method="POST" enctype="multipart/form-data">
	<input type="file" name="fileexcel" accept=".xls">
	<input type="submit" name="submit" value="Import data">
</form>
<?php
if(isset($_POST['submit'])){
// require_once("assets/PHPexcel/classes/PHPexcel/reader/Excel2007.php");
// require_once("assets/PHPexcel/classes/PHPexcel.php");
require_once("excel_reader2.php");

$lokasi		="lokasi/";
$nama_file 	=$_FILES['fileexcel']['name'];
$file_temp	=$_FILES['fileexcel']['tmp_name'];
$file_type	=$_FILES['fileexcel']['type'];
// echo "<br>";
// print_r($_FILES['fileexcel']);
// echo "</br>";
// move_uploaded_file($file_temp,$lokasi.$nama_file);


// $data =new PHPExcel_Reader_Excel2007();
// $sheet_active=$data->load($lokasi.$nama_file);
// $sh=$sheet_active->getActiveSheet(0);


$data = new  Spreadsheet_Excel_Reader($nama_file);
$row=$data->rowcount($sheet_index=0);
$sql="";
for($i=2;$i<=$row;$i++){
	$nama_lengkap=$data->val($i,1);
	$tempat_lahir=$data->val($i,2);
	$tgl_lahir=$data->val($i,3);
	$jenis_kel=$data->val($i,4);
	$id_agama=$data->val($i,5);
	$nik=$data->val($i,6);
	$nisn=$data->val($i,7);
	$npwp=$data->val($i,8);
	$kewarganegaraan=$data->val($i,9);
	$jalan=$data->val($i,10);
	$dusun=$data->val($i,11);
	$rt=$data->val($i,12);
	$rw=$data->val($i,13);
	$kelurahan=$data->val($i,14);
	$kode_pos=$data->val($i,15);
	$id_kecamatan=$data->val($i,16);
	$id_jenis_tinggal=$data->val($i,17);
	$id_alat_transportasi=$data->val($i,18);
	$telepon=$data->val($i,19);
	$handphone=$data->val($i,20);
	$email=$data->val($i,21);
	$penerima_kps=$data->val($i,22);
	$nomor_kps=$data->val($i,23);
	$nik_ayah=$data->val($i,24);
	$nama_ayah=$data->val($i,25);
	$tanggal_lahir_ayah=$data->val($i,26);
	$id_pendidikan_ayah=$data->val($i,27);
	$d_pekerjaan_ayah=$data->val($i,28);
	$id_penghasilan_ayah=$data->val($i,29);
	$nik_ibu=$data->val($i,30);
	$nama_ibu=$data->val($i,31);
	$tanggal_lahir_ibu=$data->val($i,32);
	$id_pendidikan_ibu=$data->val($i,33);
	$id_pekerjaan_ibu=$data->val($i,34);
	$id_penghasilan_ibu=$data->val($i,35);
	$nama_wali=$data->val($i,36);
	$tanggal_lahir_wali=$data->val($i,37);
	$d_pendidikan_wali=$data->val($i,38);
	$id_pekerjaan_wali=$data->val($i,39);
	$id_penghasilan_wali=$data->val($i,40);
	$id_kebutuhan_khusus_mahasiswa=$data->val($i,41);
	$id_kebutuhan_khusus_ayah=$data->val($i,42);

$sql .="insert into mahasiswa(nama_lengkap,	tempat_lahir,	tgl_lahir,	jenis_kel,	id_agama,	nik,	nisn,	npwp,	kewarganegaraan,	jalan,	dusun,	rt,	rw,	kelurahan,	kode_pos,	id_kecamatan,	id_jenis_tinggal,	id_alat_transportasi,	telepon,	handphone,	email,	penerima_kps,	nomor_kps,	nik_ayah,	nama_ayah,	tanggal_lahir_ayah,	id_pendidikan_ayah,	id_pekerjaan_ayah,	id_penghasilan_ayah,	nik_ibu,	nama_ibu,	tanggal_lahir_ibu,	id_pendidikan_ibu,	id_pekerjaan_ibu,	id_penghasilan_ibu,	nama_wali,	tanggal_lahir_wali,	id_pendidikan_wali,	id_pekerjaan_wali,	id_penghasilan_wali,	id_kebutuhan_khusus_mahasiswa,	id_kebutuhan_khusus_ayah,status) values('$nama_lengkap',	'$tempat_lahir',	'$tgl_lahir',	'$jenis_kel',	'$id_agama',	'$nik',	'$nisn',	'$npwp',	'$kewarganegaraan',	'$jalan',	'$dusun',	'$rt',	'$rw',	'$kelurahan',	'$kode_pos',	'$id_kecamatan',	'$id_jenis_tinggal',	'$id_alat_transportasi',	'$telepon',	'$handphone',	'$email',	'$penerima_kps',	'$nomor_kps',	'$nik_ayah',	'$nama_ayah',	'$tanggal_lahir_ayah',	'$id_pendidikan_ayah',	'$d_pekerjaan_ayah',	'$id_penghasilan_ayah',	'$nik_ibu',	'$nama_ibu',	'$tanggal_lahir_ibu',	'$id_pendidikan_ibu',	'$id_pekerjaan_ibu',	'$id_penghasilan_ibu',	'$nama_wali',	'$tanggal_lahir_wali',	'$d_pendidikan_wali',	'$id_pekerjaan_wali',	'$id_penghasilan_wali',	'$id_kebutuhan_khusus_mahasiswa',	'$id_kebutuhan_khusus_ayah','0');";
}
if($cn->multi_query($sql)===true){
	echo "Sukses nambah data";
}else{
	echo "ada kesalahan ".$cn->error;
}
}
 ?>