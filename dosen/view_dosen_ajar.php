<div class="container">
<?php 
if(isset($_GET['sub2'])){
	$subkelaskuliah=$_GET['sub2'];
	// echo "subya adalah ".$subkelaskuliah;
	?>
	<div class="panel panel-default" id="content_kelaskuliah">
	<?php 
	include_once("getdetailkelaskuliah.php");
	 ?>

	</div>
<?php
}
else{
 ?>
<div class="row">
			<div class="col-md-12">
				<a href="dosen/download_dosen_ajar.php" class="label label-info">1. Download contoh Dosen mengjar *.xls</a>
				<a href="dosen/download_dosen.php" class="label label-primary">2. Download Penugasan Dosen *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="dosenajar" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="3. Upload" />
				</form>
				<p>
					<?php 
					if(isset($_POST['submit'])){
						require_once('excel_reader2.php');
						$dosen 		= $_FILES["dosenajar"]["tmp_name"];
						if (!empty($dosen)){						
						$dosen1 = new  Spreadsheet_Excel_Reader($dosen);
						$row=$dosen1->rowcount($sheet_index=0);
							
							for($i=2;$i<=$row;$i++){								
								$nidn 						=trim($dosen1->val($i,1)," ");
								$nama_dosen  				=trim($cn->real_escape_string($dosen1->val($i,2))," ");
								$id_semester 				=trim($dosen1->val($i,3)," ");
								$jenjang 		 			=trim($dosen1->val($i,4)," ");
								$prodi		 				=trim($dosen1->val($i,5)," ");
								$kode_mk 		 			=trim($dosen1->val($i,6)," ");
								$nama_mk 					=trim($dosen1->val($i,7)," ");
								$rencana_tatap_muka			=trim($dosen1->val($i,8)," ");
								$realisasi_tatap_muka 		=trim($dosen1->val($i,9)," ");
								$jenis_evaluasi				=trim($dosen1->val($i,10)," ");
								$sql=" INSERT INTO insertdosenpengajarkelaskuliah(nidn, nama_dosen,id_semester,jenjang,program_studi,kode_mata_kuliah,nama_mata_kuliah,rencana_tatap_muka,realisasi_tatap_muka,jenis_evaluasi,status) values ('$nidn','$nama_dosen','$id_semester','$jenjang','$prodi','$kode_mk','$nama_mk','$rencana_tatap_muka','$realisasi_tatap_muka','$jenis_evaluasi','0')";
								$cn->query($sql);								
							}							
						}//end if empty
					}
							?>
							<p>
							<button class="btn btn-xs btn-success" id="valid_mhs" onclick="location.href='dosen/validasi_dosen_mengajar.php';"><span class="glyphicon glyphicon-check"></span> 4. Validasi</button>
							<button class="btn btn-xs btn-info" onclick="location.href='dosen/import_dosen_mengajar.php'"><span class="glyphicon glyphicon-paperclip"></span> 5. Import ke Feeder</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=dosen'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 6.Back</button>
							<button class="btn btn-xs btn-danger" id="idtruncate"><span class="glyphicon glyphicon-remove-circle"></span> 7.Truncate Data</button>							
		 	</div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default" id="content_kelaskuliah">
  <div class="panel-heading">.:Data Mengajar Dosen:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered ">
		<tr class="xs">
			<td>nidn</td>
			<td>nama_dosen</td>
			<td>id_semester</td>
			<td>jenjang</td>
			<td>program_studi</td>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>sks_substansi_total</td>
			<td>rencana_tatap_muka</td>
			<td>realisasi_tatap_muka</td>
			<td>jenis_evaluasi</td>
			<td>deskripsi</td>
			<td>error_kode</td>			
		</tr>
			<?php 
				$color1="#88EB88";				
				$color2="white";				
				if($result1=$cn->query("select * from insertdosenpengajarkelaskuliah ")){
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 
							if(($result["id_registrasi_dosen"]=='') or ($result["id_kelas_kuliah"]=='')){
								echo "<tr bgcolor='".$color1."'>";
							}else{
								echo "<tr bgcolor='".$color2."'>";
							}						
						?>							
								<td><?php echo $result["nidn"]; ?></td>
								<td><?php echo $result["nama_dosen"]; ?></td>
								<td><?php echo $result["id_semester"]; ?></td>
								<td><?php echo $result["jenjang"]; ?></td>
								<td><?php echo $result["program_studi"]; ?></td>
								<td><?php echo $result["kode_mata_kuliah"]; ?></td>
								<td><?php echo $result["nama_mata_kuliah"]; ?></td>
								<td><?php echo $result["sks_substansi_total"]; ?></td>
								<td><?php echo $result["rencana_tatap_muka"]; ?></td>
								<td><?php echo $result["realisasi_tatap_muka"]; ?></td>
								<td><?php echo $result["jenis_evaluasi"]; ?></td>
								<td><?php echo $result["deskripsi"]; ?></td>
								<td><?php echo $result["error_kode"]; ?></td>			
								<td><a href="#" class="btn btn-xs btn-success">Edit Data</a> | <a href="#" class="btn btn-xs btn-danger">Hapus</a></td>
							</tr>

						<?php
							}
					}else {//else jika tidak ada data history
								echo '<tr><td colspan="22">No data</td></tr>';
							}
					}
					?>
	</table>
</div><!-- end table responsive-->
</div>
</div>
<div id="hasildata">
	
</div>
</div>
<?php 
}
 ?>
<script>
	$(document).ready(function(){
		$("#valid_mhs").click(function(){
			$("#hasildata").load("piksi/../history_pendidikan/validasi_feeder_history_mahasiswa.php");
		});

		$("#idtruncate").click(function(){
			kosong_data()
		});
		function kosong_data(){
			if(confirm('Yakin data Kelas kuliah akan dikosongkan')==true){
				location.href='dosen/truncate_data_dosen.php';
			}
		}
		function getdetailkelaskuliah(){
			// $("#content_kelaskuliah").load("kelas_kuliah/getdetailkelaskuliah.php");
			location.href="kelas_kuliah/getdetailkelaskuliah.php";
		}
	});
</script>