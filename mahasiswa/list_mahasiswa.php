<?php 
// session_start();
// if(isset($_SESSION['token'])){
$token=$_SESSION['token'];
 ?>
<div class="row">
<div class="col-md-12">
	<button class="btn btn-info btn-xs" onclick="window.location.href='index.php?sub=list_mahasiswa&list=2'"><span class="glyphicon glyphicon-plus"></span> Import Mahasiswa</button>
	<button class="btn btn-success btn-xs" onclick="window.location.href='index.php?sub=list_mahasiswa&list=1'"><span class="glyphicon glyphicon-plus"></span> Update Riwayat Pendidikan</button>
	<button class="btn btn-primary btn-xs" onclick="window.location.href='mahasiswa/update_fromfeeder.php';"><span class="glyphicon glyphicon-download-alt"></span> Update dari Feeder</button>
	<button class="btn btn-danger btn-xs" onclick="window.location.href='mahasiswa/delete_get_listmahasiswa.php';"><span class="glyphicon glyphicon-download-alt"></span> Delete All</button>
	<button class="btn btn-warning btn-xs" onclick="window.location.href='mahasiswa/download_list_mahasiswa.php';"><span class="glyphicon glyphicon-download-alt"></span> Export to Excel</button>
</div>
</div>
<br>
<?php 
$sql="select nim,nama_mahasiswa,tanggal_lahir,jenis_kelamin,nama_agama,nama_program_studi,nama_status_mahasiswa from getListmahasiswa limit 1000";
if($res=$cn->query($sql)){
?>
<div class="table-responsive" style="height: 350px">
<table class="table table-bordered">
	<tr>
		<td>NPM</td>
		<td>Nama Mahasiswa</td>
		<td>Tgl. Lahir</td>
		<td>Jenis Kel</td>
		<td>Agama</td>
		<td>Prodi</td>
		<td>Status</td>
	</tr>
	<?php
		while ($key=$res->fetch_assoc()) {
			echo "<tr>";
			echo "<td>".$key['nim']."</td>";
			echo "<td>".$key['nama_mahasiswa']."</td>";
			echo "<td>".$key['tanggal_lahir']."</td>";
			echo "<td>".$key['jenis_kelamin']."</td>";
			echo "<td>".$key['nama_agama']."</td>";
			echo "<td>".$key['nama_program_studi']."</td>";
			echo "<td>".$key['nama_status_mahasiswa']."</td>";
			echo "</tr>";			
		}
	//}
	?>	
</table>
</div>
<?php
}elseif ($result2->error_code<>0) {
	echo "error code :".$result2->error_code."-".$result2->error_desc;
}
 ?>

