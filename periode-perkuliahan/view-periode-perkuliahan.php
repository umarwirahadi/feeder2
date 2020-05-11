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
				<a href="periode-perkuliahan/downloadperiodeperkuliahan.php" class="label label-info">1. Download contoh Periode Perkuliahan *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="perode_kuliah" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="2. Upload" />
				</form>
				<p>
					<?php 
					if(isset($_POST['submit'])){
						require_once('excel_reader2.php');
						$periode_kul 		= 	$_FILES["perode_kuliah"]["tmp_name"];
						if (!empty($periode_kul)){						
						// echo "nilainya : ".$xlnilai;
						$periode_kul1 = new  Spreadsheet_Excel_Reader($periode_kul);
						$row=$periode_kul1->rowcount($sheet_index=0);
							for($i=2;$i<=$row;$i++){								
								$nama_prodi 					=$periode_kul1->val($i,1);
								$jenjang						=$periode_kul1->val($i,2);
								$id_semester					=$periode_kul1->val($i,3);
								$jumlah_target_mahasiswa_baru	=$periode_kul1->val($i,4);
								$jumlah_pendaftar_ikut_seleksi 	=$periode_kul1->val($i,5);
								$jumlah_pendaftar_lulus_seleksi =$periode_kul1->val($i,6);
								$jumlah_daftar_ulang	 		=$periode_kul1->val($i,7);
								$jumlah_mengundurkan_diri		=$periode_kul1->val($i,8);
								$tanggal_awal_perkuliahan		=$periode_kul1->val($i,9);
								$tanggal_akhir_perkuliahan		=$periode_kul1->val($i,10);
								$sql ="insert into setting_periode_perkuliahan (nama_prodi,jenjang,id_semester,jumlah_target_mahasiswa_baru,jumlah_pendaftar_ikut_seleksi,jumlah_pendaftar_lulus_seleksi,jumlah_daftar_ulang,jumlah_mengundurkan_diri,tanggal_awal_perkuliahan,tanggal_akhir_perkuliahan,status) values('$nama_prodi','$jenjang','$id_semester','$jumlah_target_mahasiswa_baru','$jumlah_pendaftar_ikut_seleksi','$jumlah_pendaftar_lulus_seleksi','$jumlah_daftar_ulang','$jumlah_mengundurkan_diri','$tanggal_awal_perkuliahan','$tanggal_akhir_perkuliahan','0')";
								$cn->query($sql);
							} //end for
						}//end if empty
					}
							?>
							<p>
							<button class="btn btn-xs btn-success" id="valid_mhs" onclick="location.href='periode-perkuliahan/validasi_periodePerkuliahan.php';"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
							<button class="btn btn-xs btn-info" onclick="location.href='periode-perkuliahan/import_feeder.php'"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=nilai_transfer'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5.Back</button>
							<button class="btn btn-xs btn-danger" id="blank_data_periode"><span class="glyphicon glyphicon-remove-circle"></span> 6.Truncate Data</button>						
		 	</div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default" id="periode-kuliah">
  <div class="panel-heading">.:Data Periode Perkuliahan:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered ">
		<tr class="xs">
			<td>no</td>
			<td>nama_prodi</td>
			<td>jenjang</td>
			<td>id_prodi</td>
			<td>id_semester</td>
			<td>jumlah_target_mahasiswa_baru</td>
			<td>jumlah_pendaftar_ikut_seleksi</td>
			<td>jumlah_pendaftar_lulus_seleksi</td>
			<td>jumlah_daftar_ulang</td>
			<td>jumlah_mengundurkan_diri</td>
			<td>tanggal_awal_perkuliahan</td>
			<td>tanggal_akhir_perkuliahan</td>
			<td>kode_error</td>
			<td>deskripsi</td>
			<td>Option</td>
		</tr>
			<?php 
				$color1="#88EB88";				
				$color2="white";				
				if($result1=$cn->query("select * from setting_periode_perkuliahan")){
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 
							if(($result["id_prodi"]=='')||($result["id_semester"]=='')){
								echo "<tr bgcolor='".$color1."'>";
							}else{
								echo "<tr bgcolor='".$color2."'>";
							}						
						?>							
								<td><?php echo $result["no"]; ?></td>
								<td><?php echo $result["nama_prodi"]; ?></td>
								<td><?php echo $result["jenjang"]; ?></td>
								<td><?php echo $result["id_prodi"]; ?></td>
								<td><?php echo $result["id_semester"]; ?></td>
								<td><?php echo $result["jumlah_target_mahasiswa_baru"]; ?></td>
								<td><?php echo $result["jumlah_pendaftar_ikut_seleksi"]; ?></td>
								<td><?php echo $result["jumlah_pendaftar_lulus_seleksi"]; ?></td>
								<td><?php echo $result["jumlah_daftar_ulang"]; ?></td>
								<td><?php echo $result["jumlah_mengundurkan_diri"]; ?></td>
								<td><?php echo $result["tanggal_awal_perkuliahan"]; ?></td>
								<td><?php echo $result["tanggal_akhir_perkuliahan"]; ?></td>
								<td><?php echo $result["kode_error"]; ?></td>
								<td><?php echo $result["desk"]; ?></td>
								<td><a href="#" class="btn btn-xs btn-primary">Edit Data</a> | <a href="#" class="btn btn-xs btn-danger">Hapus</a></td>
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

		$("#blank_data_periode").click(function(){
			kosong_data()
		});
		function kosong_data(){
			if(confirm('Yakin data Kelas kuliah akan dikosongkan')==true){
				location.href='periode-perkuliahan/delete_blank.php';
			}
		}
		function getdetailkelaskuliah(){
			// $("#content_kelaskuliah").load("kelas_kuliah/getdetailkelaskuliah.php");
			location.href="kelas_kuliah/getdetailkelaskuliah.php";
		}
	});
</script>