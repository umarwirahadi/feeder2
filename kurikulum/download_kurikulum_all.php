<?php 
header('Content-type:application/vnd-ms-excel');
header('Content-Disposition:attachment; filename=Kurikulum.xls');
 ?>
<table border="1">
<tr>
	<td>Nama_kurikulum</td>
	<td>kode_mata_kuliah</td>
	<td>nama_mata_kuliah</td>
	<td>sks_mata_kuliah</td>
	<td>nama_program_studi</td>
	<td>semester</td>
	<td>id_semester</td>
	<td>semester_mulai_berlaku</td>
	<td>apakah_wajib</td>
</tr>
<?php 
require_once('../config/koneksi.php');
$sql="select id_kurikulum,Nama_kurikulum,kode_mata_kuliah,nama_mata_kuliah,sks_mata_kuliah,nama_program_studi,semester,id_semester,semester_mulai_berlaku,apakah_wajib from getmatkulkurikulum";
if($res=$cn->query($sql)){
		while ($data=$res->fetch_assoc()) {
				echo '<tr>
						<td>'.$data["Nama_kurikulum"].'</td>
						<td>'.$data["kode_mata_kuliah"].'</td>
						<td>'.$data["nama_mata_kuliah"].'</td>
						<td>'.$data["sks_mata_kuliah"].'</td>
						<td>'.$data["nama_program_studi"].'</td>
						<td>'.$data["semester"].'</td>
						<td>'.$data["id_semester"].'</td>
						<td>'.$data["semester_mulai_berlaku"].'</td>
						<td>'.$data["apakah_wajib"].'</td>
						</tr>';

			}	
	}
?>
</table>