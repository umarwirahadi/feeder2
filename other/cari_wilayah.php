<table class="table table-bordered table-hover">
		<tr>
			<td>No</td>
			<td>id_wilayah</td>
			<td>nama_wilayah</td>
		</tr>
		<?php
		require_once("../config/koneksi.php");
		$wil=strip_tags($_GET['wil']);
		$result1=$cn->query("select * from ms_wilayah where nama_wilayah like '%$wil%' limit 200");
		if($result1->num_rows>0){
		$no=1;
		while ($row=$result1->fetch_assoc()){
		?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $row['id_wilayah']; ?></td>
			<td><?php echo $row['nama_wilayah']; ?></td>
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