<?php 
require_once("../config/koneksi.php");
$namamk=strip_tags($_GET['namamk']);
 ?>
<table class="table table-bordered">
		<tr>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>sks_mata_kuliah</td>
			<td>nama_program_studi</td>
			<td>jenjang</td>
			<td>id_jenis_mata_kuliah</td>
			<td>id_kelompok_mata_kuliah</td>
			<td>Aksi</td>
		</tr>
			<?php 
				$result1=$cn->query("select * from matakuliah where status='9' and nama_mata_kuliah like '%$namamk%' limit 200");
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 
						?>
							<tr>
								<td ><?php echo $result["kode_mata_kuliah"]; ?></td>
								<td ><?php echo $result["nama_mata_kuliah"]; ?></td>
								<td ><?php echo $result["sks_mata_kuliah"]; ?></td>
								<td ><?php echo $result["nama_program_studi"]; ?></td>
								<td ><?php echo $result["id_jenis_mata_kuliah"]; ?></td>
								<td ><?php echo $result["id_kelompok_mata_kuliah"]; ?></td>
								<td ><a href="#" class="btn btn-xs btn-success">Edit Data</a> | <a href="#" class="btn btn-xs btn-danger">Hapus</a></td>
							</tr>
						<?php
							}
					}else {//else jika tidak ada data history
								echo '<tr><td colspan="22">No data</td></tr>';
							}	
					?>
</table>