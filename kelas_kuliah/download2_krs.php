<?php 
header('Content-type:application/vnd-ms-excel');
header('Content-Disposition:attachment; filename=krs_mahasiswa.xls');
// include('download_krs_mahasiswa_from_feeder.php');
 ?>

 <table border="1">
<tr>
	<td>id_semester</td>
	<td>nim</td>
	<td>nama_mahasiswa</td>
	<td>kode_mata_kuliah</td>
	<td>nama_mata_kuliah</td>
	<td>nilai_angka</td>
	<td>nilai_indeks</td>
	<td>nilai_huruf</td>
</tr>
<?php 
require_once('../config/koneksi.php');
if(isset($_POST['id_semester']) && isset($_POST['id_jurusan'])){
$smt=strip_tags($_POST['id_semester']);
$jur=strip_tags($_POST['id_jurusan']);
$sql="select nama_program_studi,id_semester,nim,nama_mahasiswa,kode_mata_kuliah,nama_mata_kuliah,nilai_angka,nilai_indeks,nilai_huruf from getdetailnilaiperkuliahankelas where id_semester='$smt' and id_prodi='$jur'";
if($res=$cn->query($sql)){
		while ($data=$res->fetch_assoc()) {
				echo '<tr>
						<td>'.$data["id_semester"].'</td>
						<td>'.$data["nim"].'</td>
						<td>'.$data["nama_mahasiswa"].'</td>
						<td>'.$data["kode_mata_kuliah"].'</td>
						<td>'.$data["nama_mata_kuliah"].'</td>
						<td>'.$data["nilai_angka"].'</td>
						<td>'.$data["nilai_indeks"].'</td>
						<td>'.$data["nilai_huruf"].'</td>
						</tr>';

			}	
	}
}
?>
</table>