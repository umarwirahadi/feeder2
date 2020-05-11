<table class="table table-bordered table-hover">
		<tr>
			<td>No</td>
			<td>id_status_mahasiswa</td>
			<td>nama_status_mahasiswa</td>
		</tr>
		<?php
		require_once("../config/koneksi.php");
		$ak=strip_tags($_GET['statusmhs']);
		$result1=$cn->query("select * from getstatusmahasiswa where nama_status_mahasiswa like '$ak%'");
		if($result1->num_rows>0){
		$no=1;
		while ($row=$result1->fetch_assoc()){
		?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $row['id_status_mahasiswa']; ?></td>
			<td><?php echo $row['nama_status_mahasiswa']; ?></td>
		</tr>
		<?php
		$no++;
		}
		 ?>
</table>
<?php 
}else{
	echo "<tr><td colspan='2'>No Data</td></tr>";
}
 ?>	