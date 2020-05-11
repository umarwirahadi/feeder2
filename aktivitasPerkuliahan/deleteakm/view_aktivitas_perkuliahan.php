<div class="container">
<?php 
if(isset($_GET['sub2'])){
	$subkelaskuliah=$_GET['sub2'];
	// echo "subya adalah ".$subkelaskuliah;
	?>
	<div class="panel panel-default" id="content_kelaskuliah">
	<?php 
	// include_once("getdetailkelaskuliah.php");
	 ?>

	</div>
<?php
}
else{
 ?>
<div class="row">
			<div class="col-md-12">
				<a href="aktivitasPerkuliahan/deleteakm/DownloadAktivitasPerkuliahan.php" class="label label-info">1. Download contoh Aktivitas Kuliah *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="aktivitas_kuliah" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="2. Upload" />
				</form>
				<p>
					<?php 
					if(isset($_POST['submit'])){
						require_once('excel_reader2.php');
						$aktivitas_kul 		= 	$_FILES["aktivitas_kuliah"]["tmp_name"];
						if (!empty($aktivitas_kul)){						
						// echo "nilainya : ".$xlnilai;
						$aktivitas_kul1 = new  Spreadsheet_Excel_Reader($aktivitas_kul);
						$row=$aktivitas_kul1->rowcount($sheet_index=0);
							for($i=2;$i<=$row;$i++){								
								$npm 					=trim($aktivitas_kul1->val($i,1)," ");
								$nama					=trim($aktivitas_kul1->val($i,2)," ");
								$jenjang				=trim($aktivitas_kul1->val($i,3)," ");
								$program_studi			=trim($aktivitas_kul1->val($i,4)," ");
								$id_semester			=trim($aktivitas_kul1->val($i,5)," ");
								$status_mhs				=trim($aktivitas_kul1->val($i,6)," ");
								$ips 					=trim($aktivitas_kul1->val($i,7)," ");
								$ipk 				 	=trim($aktivitas_kul1->val($i,8)," ");
								$sks_smt	 			=trim($aktivitas_kul1->val($i,9)," ");
								$sks_total			 	=trim($aktivitas_kul1->val($i,10)," ");								
								$sql="insert into Insertperkuliahanmahasiswa (nim,nama_mahasiswa,jenjang,program_studi,id_semester,id_status_mahasiswa,ips,ipk,sks_semester,total_sks,status) values('$npm','$nama','$jenjang','$program_studi','$id_semester','$status_mhs','$ips','$ipk','$sks_smt','$sks_total','0')";
								$cn->query($sql);								
							}
						}//end if empty
					}
							?>
							<p>
							<button class="btn btn-xs btn-success" id="valid_mhs" onclick="location.href='aktivitasPerkuliahan/validasi_aktivitasPerkuliahan.php';"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
							<button class="btn btn-xs btn-info" onclick="location.href='aktivitasPerkuliahan/deleteakm/import_aktiitas_perkuliahan.php'"><span class="glyphicon glyphicon-paperclip"></span> 4. Hapus AKM</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=nilai_transfer'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5.Back</button>
							<button class="btn btn-xs btn-danger" id="idtruncate"><span class="glyphicon glyphicon-remove-circle"></span> 6.Truncate Data</button>							
		 	</div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default" id="content_kelaskuliah">
  <div class="panel-heading">.:Data Aktivitas Perkuliahan Mahasiswa:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered ">
		<tr class="xs">
			<td>nim</td>
			<td>nama_mahasiswa</td>
			<td>id_semester</td>
			<td>id_status_mahasiswa</td>
			<td>status_mahasiswa</td>
			<td>ips</td>
			<td>ipk</td>
			<td>sks_semester</td>
			<td>sks_total</td>			
			<td>deskripsi</td>			
			<!-- <td>Option</td> -->
		</tr>
			<?php 
				$color1="#88EB88";				
				$color2="white";				
				if($result1=$cn->query("select * from Insertperkuliahanmahasiswa")){
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 
							if(($result["id_registrasi_mahasiswa"]=='')){
								echo "<tr bgcolor='".$color1."'>";
							}else{
								echo "<tr bgcolor='".$color2."'>";
							}						
						?>							
								<td><?php echo $result["nim"]; ?></td>
								<td><?php echo $result["nama_mahasiswa"]; ?></td>
								<td><?php echo $result["id_semester"]; ?></td>
								<td><?php echo $result["id_status_mahasiswa"]; ?></td>
								<td><?php echo $result["id_status_mahasiswa"]; ?></td>
								<td><?php echo $result["ips"]; ?></td>
								<td><?php echo $result["ipk"]; ?></td>
								<td><?php echo $result["sks_semester"]; ?></td>
								<td><?php echo $result["total_sks"]; ?></td>
								<td><?php echo $result["desk"]; ?></td>
								<!-- <td><a href="#" class="btn btn-xs btn-primary">Edit Data</a> | <a href="#" class="btn btn-xs btn-danger">Hapus</a></td> -->
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
				location.href='aktivitasPerkuliahan/truncate_dataaktivitasperkuliahan.php';
			}
		}
		function getdetailkelaskuliah(){
			// $("#content_kelaskuliah").load("kelas_kuliah/getdetailkelaskuliah.php");
			location.href="kelas_kuliah/getdetailkelaskuliah.php";
		}
	});
</script>