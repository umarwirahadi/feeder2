<?php 
header('Content-type:application/vnd-ms-excel');
header('Content-Disposition:attachment; filename=export_kelas_kuliah.xls');
 ?>
<table border="1">
		<tr>
			<td>nama_program_studi</td>
			<td>id_semester</td>
			<td>nama_semester</td>
			<td>id_matkul</td>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>bahasan</td>
			<td>tanggal_mulai_efektif</td>
			<td>tanggal_akhir_efektif</td>						
		</tr>
			<?php
			require_once("../config/koneksi.php");
				if($result1=$cn->query("select * from getdetailkelaskuliah order by nama_program_studi")){
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 						
						?>
						<tr>
								<td><?php echo $result["nama_program_studi"]; ?></td>
								<td><?php echo $result["id_semester"]; ?></td>
								<td><?php echo $result["nama_semester"]; ?></td>
								<td><?php echo $result["kode_mata_kuliah"]; ?></td>
								<td><?php echo $result["nama_mata_kuliah"]; ?></td>
								<td><?php echo $result["bahasan"]; ?></td>
								<td><?php echo $result["tanggal_mulai_efektif"]; ?></td>
								<td><?php echo $result["tanggal_akhir_efektif"]; ?></td>
							</tr>

						<?php
							}
					}else {//else jika tidak ada data history
								echo '<tr><td colspan="22">No record</td></tr>';
							}
					}
					?>
	</table>