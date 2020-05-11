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
				<a href="mahasiswa-lulus/download_mhs_lulus.php" class="label label-info">1. Download contoh Mahasiswa Lulus *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="mhslulus" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="2. Upload" />
				</form>
				<p>
					<?php 
					if(isset($_POST['submit'])){
						require_once('excel_reader2.php');
						$mhs_lulus 		= 	$_FILES["mhslulus"]["tmp_name"];
						if (!empty($mhs_lulus)){						
						$mhslulusdo = new  Spreadsheet_Excel_Reader($mhs_lulus);
						$row=$mhslulusdo->rowcount($sheet_index=0);							
							for($i=2;$i<=$row;$i++){								
								$NIM 						=$mhslulusdo->val($i,1);
								$nama_mahasiswa				=$cn->real_escape_string($mhslulusdo->val($i,2));
								//$nama_mahasiswa				=$mhslulusdo->val($i,2);
								$jenjang 					=$mhslulusdo->val($i,3);
								$program_studi				=$mhslulusdo->val($i,4);
								$jenis_keluar 				=$mhslulusdo->val($i,5);
								$tanggal_keluar 			=$mhslulusdo->val($i,6);
								$keterangan 				=$mhslulusdo->val($i,7);
								$nomor_sk_yudisium 			=$mhslulusdo->val($i,8);
								$tanggal_sk_yudisium		=$mhslulusdo->val($i,9);
								$ipk 						=$mhslulusdo->val($i,10);
								$nomor_ijazah 				=$mhslulusdo->val($i,11);
								$jalur_skripsi 				=$mhslulusdo->val($i,12);
								$judul_skripsi 				=$mhslulusdo->val($i,13);
								$bulan_awal_bimbingan 				=$mhslulusdo->val($i,14);
								$bulan_akhir_bimbingan 				=$mhslulusdo->val($i,15);
								$sql=" INSERT INTO insertmahasiswalulusdo(nim,nama_mahasiswa,program_studi,jenjang,jenis_keluar,tanggal_keluar,keterangan,nomor_sk_yudisium,tanggal_sk_yudisium,ipk,nomor_ijazah,jalur_skripsi,judul_skripsi, bulan_awal_bimbingan,bulan_akhir_bimbingan,status) values ('$NIM','$nama_mahasiswa','$program_studi','$jenjang','$jenis_keluar','$tanggal_keluar','$keterangan','$nomor_sk_yudisium','$tanggal_sk_yudisium','$ipk','$nomor_ijazah','$jalur_skripsi','$judul_skripsi','$bulan_awal_bimbingan','$bulan_akhir_bimbingan','0')";
							
									if($cn->query($sql)===true){
										// echo "<script>window.location.href='index.php?sub=mhs_lulus';</script>";
										// header("location:index.php?sub=kelaskuliah");
										// echo("berhasil semua");
									}else{
										echo "Gagal menyimpan data :".$cn->error;
									}
							} //end for
						}//end if empty
					}
							?>
							<p>
							<button class="btn btn-xs btn-success" id="valid_mhs" onclick="location.href='mahasiswa-lulus/validasi_mhs_lulus.php';"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
							<button class="btn btn-xs btn-info" onclick="location.href='mahasiswa-lulus/import_feeder.php'"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=nilai_transfer'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5.Back</button>
							<button class="btn btn-xs btn-danger" id="idtruncate"><span class="glyphicon glyphicon-remove-circle"></span> 6.Truncate Data</button>							
		 	</div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default" id="content_kelaskuliah">
  <div class="panel-heading">.:Data Mahasiswa Lulus/DO:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered ">
		<tr class="xs">
			<td>npm</td>
			<td>nama_mahasiswa</td>
			<td>program studi</td>
			<td>jenjang</td>
			<td>jenis_keluar</td>
			<td>tanggal_keluar</td>
			<td>keterangan</td>
			<td>no_sk_yudisium</td>
			<td>tanggal_sk_yudisium</td>
			<td>ipk</td>
			<td>nomor_ijazah</td>
			<td>jalur_skripsi</td>
			<td>judul_skripsi</td>
			<td>bulan_awal_bimbingan</td>
			<td>bulan_akhir_bimbingan</td>
			<td>deskripsi</td>
			<td>option</td>
		</tr>
			<?php 
				$color1="#88EB88";				
				$color2="white";				
				if($result1=$cn->query("select * from insertmahasiswalulusdo ")){
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 
							if(($result["id_registrasi_mahasiswa"]=='') or ($result["id_jenis_keluar"]=='')){
								echo "<tr bgcolor='".$color1."'>";
							}else{
								echo "<tr bgcolor='".$color2."'>";
							}						
						?>							
								<td><?php echo $result["nim"]; ?></td>
								<td><?php echo $result["nama_mahasiswa"]; ?></td>
								<td><?php echo $result["program_studi"]; ?></td>
								<td><?php echo $result["jenjang"]; ?></td>
								<td><?php echo $result["jenis_keluar"]; ?></td>
								<td><?php echo $result["tanggal_keluar"]; ?></td>
								<td><?php echo $result["keterangan"]; ?></td>
								<td><?php echo $result["nomor_sk_yudisium"]; ?></td>
								<td><?php echo $result["tanggal_sk_yudisium"]; ?></td>
								<td><?php echo $result["ipk"]; ?></td>
								<td><?php echo $result["nomor_ijazah"]; ?></td>
								<td><?php echo $result["jalur_skripsi"]; ?></td>
								<td><?php echo $result["judul_skripsi"]; ?></td>
								<td><?php echo $result["bulan_awal_bimbingan"]; ?></td>
								<td><?php echo $result["bulan_akhir_bimbingan"]; ?></td>
								<td><?php echo $result["deskripsi"]; ?></td>							
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
				location.href='mahasiswa-lulus/truncatedata.php';
			}
		}
		function getdetailkelaskuliah(){
			// $("#content_kelaskuliah").load("kelas_kuliah/getdetailkelaskuliah.php");
			location.href="kelas_kuliah/getdetailkelaskuliah.php";
		}
	});
</script>