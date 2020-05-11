<?php 
session_start();
include_once("../config/koneksi.php");
include_once("../config.php");
header('Content-type:application/vnd-ms-excel');
header('Content-Disposition:attachment; filename=kelas_kuliah.xls');
$token=$_SESSION['token'];
$semester=$_POST['tahun'];
echo "Semester ".$semester;
$id_prodi=array("act"=>"GetListKelasKuliah",
			"token"=>$token,
			"filter"=>"id_semester='$semester'",
			"limit"=>"");
            $list_kelas_kuliah=json_decode(runWS($id_prodi));
            
 ?>
<table border="1">
<tr>
	<td>nama_program_studi</td>
	<td>id_semester</td>
	<td>kode_mata_kuliah</td>
	<td>nama_mata_kuliah</td>
	<td>nama_kelas_kuliah</td>
	<td>sks</td>
	<td>jumlah_mahasiswa</td>
</tr>
<?php 
foreach ($list_kelas_kuliah->data as $data) {    
			    echo    '<tr>
						<td>'.$data->nama_program_studi.'</td>
						<td>'.$data->id_semester.'</td>
						<td>'.$data->kode_mata_kuliah.'</td>
						<td>'.$data->nama_mata_kuliah.'</td>
						<td>'.$data->nama_kelas_kuliah.'</td>
						<td>'.$data->sks.'</td>
						<td>'.$data->jumlah_mahasiswa.'</td>
						</tr>';

			}
?>
</table>