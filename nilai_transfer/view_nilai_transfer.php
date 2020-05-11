<?php
if(isset($_GET['sub2'])){
$sub=$_GET['sub2'];
if($sub=='riwayatnilaisebelumnya'){
	include_once('nilai_transfer/GetRiwayatNilaiMahasiswa.php');
}else{
	echo("belum ada");
}
}else{
 ?> 
<div class="row">
			<div class="col-md-12">
				<a href="nilai_transfer/download_nilai_transfer.php" class="label label-info">1. Download contoh Nilai Transfer *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="xlnilai1" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="2. Upload" />
				</form>
					<?php 
					if(isset($_POST['submit'])){
						require_once('excel_reader2.php');
						$xlnilai2 		= 	$_FILES["xlnilai1"]["tmp_name"];
						if (!empty($xlnilai2)){						
						$xlnilai = new  Spreadsheet_Excel_Reader($xlnilai2);
						$row=$xlnilai->rowcount($sheet_index=0);
							for($i=2;$i<=$row;$i++){								
								$nim 					=$xlnilai->val($i,1);
								$nama 					=$cn->real_escape_string($xlnilai->val($i,2));
								$jenj 					=$xlnilai->val($i,3);
								$jur 					=$xlnilai->val($i,4);
								$kode_mata_kuliah_asal 	=$xlnilai->val($i,5);
								$nama_mata_kuliah_asal 	=$xlnilai->val($i,6);
								$sks_mata_kuliah_asal 	=$xlnilai->val($i,7);
								$nilai_huruf_asal 		=$xlnilai->val($i,8);
								$sks_mata_kuliah_diakui	=$xlnilai->val($i,9);
								$nilai_huruf_diakui 	=$xlnilai->val($i,10);
								$nilai_angka_diakui 	=$xlnilai->val($i,11);								
								$sql="insert into nilai_transfer (nim,nama_mahasiswa,jenjang,jurusan,kode_mata_kuliah_asal,nama_mata_kuliah_asal,sks_mata_kuliah_asal,nilai_huruf_asal,sks_mata_kuliah_diakui,nilai_huruf_diakui,nilai_angka_diakui,status)values ('$nim','$nama','$jenj','$jur','$kode_mata_kuliah_asal','$nama_mata_kuliah_asal','$sks_mata_kuliah_asal','$nilai_huruf_asal','$sks_mata_kuliah_diakui','$nilai_huruf_diakui','$nilai_angka_diakui','0')";
								$cn->query($sql);
								// print_r($cn);
							} 
				}
			}
							?>
							<button class="btn btn-xs btn-success" id="valid_mhs" onclick="location.href='nilai_transfer/validasi_nilai_transfer.php';"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
							<button class="btn btn-xs btn-info" onclick="location.href='nilai_transfer/import_nilai_transfer.php'"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=nilaiTransfer'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5.Back</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=nilaiTransfer&sub2=lihatdata'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 6.View KRS(untuk Referensi)</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=nilaiTransfer&sub2=riwayatnilaisebelumnya'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 7.View Riwayat Nilai Mahasiswa Sebelumnya</button>

		 	</div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default">
  <div class="panel-heading">.:Data Nilai Transfer:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered ">
		<tr class="xs">
			<td>NPM</td>
			<td>nama_mahasiswa</td>
			<td>kode_mata_kuliah_asal</td>
			<td>nama_mata_kuliah_asal</td>
			<td>sks_mata_kuliah_asal</td>
			<td>nilai_huruf_asal</td>
			<td>sks_mata_kuliah_diakui</td>
			<td>nilai_huruf_diakui</td>
			<td>nilai_angka_diakui</td>
			<td>error_code</td>
			<td>error_desc</td>
			<td>Opsi</td>
		</tr>
			<?php 
				$color1="#88EB88";				
				$color2="white";				
				$result1=$cn->query("select * from nilai_transfer");
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 
							if($result["id_matkul"]==''){
								echo "<tr bgcolor='".$color1."'>";
							}else{
								echo "<tr bgcolor='".$color2."'>";
							}						
						?>							
								<td><?php echo $result["nim"]; ?></td>
								<td><?php echo $result["nama_mahasiswa"]; ?></td>
								<td><?php echo $result["kode_mata_kuliah_asal"]; ?></td>
								<td><?php echo $result["nama_mata_kuliah_asal"]; ?></td>
								<td><?php echo $result["sks_mata_kuliah_asal"]; ?></td>
								<td><?php echo $result["nilai_huruf_asal"]; ?></td>
								<td><?php echo $result["sks_mata_kuliah_diakui"]; ?></td>
								<td><?php echo $result["nilai_huruf_diakui"]; ?></td>
								<td><?php echo $result["nilai_angka_diakui"]; ?></td>
								<td><?php echo $result["eror_code"]; ?></td>
								<td><?php echo $result["eror_deskripsi"]; ?></td>
								<td><a href="#" class="btn btn-xs btn-success">Edit Data</a> | <a href="index.php?sub=nilaiTransfer?id=1" class="btn btn-xs btn-danger">Hapus</a></td>
							</tr>

						<?php
							}
					}else {//else jika tidak ada data history
								echo '<tr><td colspan="22">No data</td></tr>';
							}	
					?>
	</table>
</div><!-- end table responsive-->
</div>
</div>
<div id="hasildata">
	
</div>
<?php 
} 
?>
<script>
	$(document).ready(function(){
		$("#valid_mhs").click(function(){
			$("#hasildata").load("piksi/../history_pendidikan/validasi_feeder_history_mahasiswa.php");
		});
	});

</script>