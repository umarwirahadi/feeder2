<?php 
header('Content-type:application/vnd-ms-excel');
header('Content-Disposition:attachment; filename=list_mahasiswa.xls');
 ?>
<table border="1">
<tr>
		<td>NPM</td>
		<td>Nama Mahasiswa</td>
		<td>Tgl. Lahir</td>
		<td>Jenis Kel</td>
		<td>Agama</td>
		<td>Prodi</td>
		<td>periode</td>
		<td>Status</td>
</tr>
<?php 
require_once('../config/koneksi.php');
$sql="select nim,nama_mahasiswa,tanggal_lahir,jenis_kelamin,nama_agama,nama_program_studi,id_periode,nama_status_mahasiswa from getListmahasiswa";
if($res=$cn->query($sql)){
		while ($data=$res->fetch_assoc()) { ?>
			<tr>
			<td><?php  echo $data['nim']; ?></td>
			<td><?php  echo $data['nama_mahasiswa']; ?></td>
			<td><?php  echo $data['tanggal_lahir']; ?></td>
			<td><?php  echo $data['jenis_kelamin']; ?></td>
			<td><?php  echo $data['nama_agama']; ?></td>
			<td><?php  echo $data['nama_program_studi']; ?></td>
			<td><?php  echo $data['id_periode']; ?></td>
			<td><?php  echo $data['nama_status_mahasiswa']; ?></td>
			</tr>
			<?php }	
	}
?>
</table>