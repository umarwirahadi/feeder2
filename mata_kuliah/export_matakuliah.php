<table border="1">
	<tr>
		<td>kode_mata_kuliah</td>
		<td>nama_mata_kuliah</td>
		<td>sks_mata_kuliah</td>
		<td>nama_program_studi</td>
		<td>id_jenis_mata_kuliah</td>
		<td>id_kelompok_mata_kuliah</td>
	</tr>
	<?php 
	require_once("../config/koneksi.php");
	$sql="select kode_mata_kuliah,nama_mata_kuliah,sks_mata_kuliah,nama_program_studi,id_jenis_mata_kuliah,id_kelompok_mata_kuliah from getlistmatakuliah order by nama_program_studi";
	if($rs=$cn->query($sql)){
		while ($row=$rs->fetch_assoc()) {
	?>
	<tr>
		<td><?php echo $row['kode_mata_kuliah'];?></td>
		<td><?php echo $row['nama_mata_kuliah'];?></td>
		<td><?php echo $row['sks_mata_kuliah'];?></td>
		<td><?php echo $row['nama_program_studi'];?></td>
		<td><?php echo $row['id_jenis_mata_kuliah'];?></td>
		<td><?php echo $row['id_kelompok_mata_kuliah'];?></td>
	</tr>
	<?php
		}
	}
	 ?>	
</table>
