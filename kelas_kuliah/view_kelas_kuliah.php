<div class="container">
<?php 
if(isset($_GET['sub2'])){
	$subkelaskuliah=$_GET['sub2'];
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
				<a href="kelas_kuliah/download_kelas_kuliah.php" class="label label-info">1. Download contoh kelas kuliah *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="kelaskuliah" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="2. Upload" />
				</form>
				<p>
					<?php 
					if(isset($_POST['submit'])){
						require_once('excel_reader2.php');
						$klskuliah 		= 	$_FILES["kelaskuliah"]["tmp_name"];
						if (!empty($klskuliah)){						
						// echo "nilainya : ".$xlnilai;
						$klskuliah1 = new  Spreadsheet_Excel_Reader($klskuliah);
						$row=$klskuliah1->rowcount($sheet_index=0);
							$sql="";
							for($i=2;$i<=$row;$i++){								
								$prodi 					=$klskuliah1->val($i,1);
								$jenjang				=$klskuliah1->val($i,2);
								$smt 					=$klskuliah1->val($i,3);
								$namakur				=$klskuliah1->val($i,4);
								$kdmk 					=$klskuliah1->val($i,5);
								$nmmk 				 	=$klskuliah1->val($i,6);
								$nama_kelas 			=$klskuliah1->val($i,7);
								$pembahasan			 	=$klskuliah1->val($i,8);
								$tgl_awal 				=$klskuliah1->val($i,9);
								$tgl_akhir 				=$klskuliah1->val($i,10);
								$sql=" insert into kelas_kuliah (nama_prodi,jenjang,id_semester,nama_kurikulum,kode_mata_kuliah,nama_mata_kuliah,nama_kelas_kuliah,bahasan,	tanggal_mulai_efektif,tanggal_akhir_efektif,status) values ('$prodi','$jenjang','$smt','$namakur','$kdmk','$nmmk','$nama_kelas','$pembahasan','$tgl_awal','$tgl_akhir','0')";
							
									if($cn->query($sql)===true){		
										echo "<script>window.location.href='index.php?sub=kelaskuliah';</script>";
									}else{
										echo "Gagal menyimpan data :".$cn->error;
									}
							} //end for
						}//end if empty
					}
							?>
							<p>
							<button class="btn btn-xs btn-success" id="valid_mhs" onclick="location.href='kelas_kuliah/validasi_kelas_kuliah.php';"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
							<button class="btn btn-xs btn-info" onclick="location.href='kelas_kuliah/import_kelas_kuliah.php'"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=nilai_transfer'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5.Back</button>
							<button class="btn btn-xs btn-danger" id="idtruncate"><span class="glyphicon glyphicon-remove-circle"></span> 6.Truncate Data</button>
							<a href="index.php?sub=kelaskuliah&sub2=subkelaskuliah" class="btn btn-xs btn-primary full-right" id="viewkelaskuliah"><span class="glyphicon glyphicon-remove-circle"></span> 7. View Kelas Kuliah</a>
		 	</div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default" id="content_kelaskuliah">
  <div class="panel-heading">.:Data Kelas Kuliah:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered ">
		<tr class="xs">
			<td>nama_prodi</td>
			<td>jenjang</td>
			<td>id_semester</td>
			<td>nama_kurikulum</td>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>nama_kelas_kuliah</td>
			<td>bahasan</td>
			<td>tanggal_mulai_efektif</td>
			<td>tanggal_akhir_efektif</td>
			<td>Deskripsi</td>
			<td>Option</td>
		</tr>
			<?php 
				$color1="#88EB88";
				$color2="white";				
				if($result1=$cn->query("select * from kelas_kuliah order by id_matkul,id_prodi")){
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 
							if($result["id_matkul"]=='' OR is_null($result["id_matkul"])){
								echo "<tr bgcolor='".$color1."'>";
							}else{
								echo "<tr bgcolor='".$color2."'>";
							}						
						?>							
								<td><?php echo $result["nama_prodi"]; ?></td>
								<td><?php echo $result["jenjang"]; ?></td>
								<td><?php echo $result["id_semester"]; ?></td>
								<td><?php echo $result["nama_kurikulum"]; ?></td>
								<td><?php echo $result["kode_mata_kuliah"]; ?></td>
								<td><?php echo $result["nama_mata_kuliah"]; ?></td>
								<td><?php echo $result["nama_kelas_kuliah"]; ?></td>
								<td><?php echo $result["bahasan"]; ?></td>
								<td><?php echo $result["tanggal_mulai_efektif"]; ?></td>
								<td><?php echo $result["tanggal_akhir_efektif"]; ?></td>
								<td><?php echo $result["desk"]; ?></td>
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
				location.href='kelas_kuliah/trucatedata.php';
			}
		}
		function getdetailkelaskuliah(){
			// $("#content_kelaskuliah").load("kelas_kuliah/getdetailkelaskuliah.php");
			location.href="kelas_kuliah/getdetailkelaskuliah.php";
		}
	});
</script>