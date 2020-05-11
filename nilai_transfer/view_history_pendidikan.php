<div class="row">
			<div class="col-md-12">
				<a href="history_pendidikan/download_history_pendidikan.php" class="label label-info">Download contoh History pendidikan *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="filehistori" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="Upload" />
				</form>
					<?php 
					if(isset($_POST['submit'])){
						require_once("excel_reader2.php");
						$nama1 		= 	$_FILES['filehistori']['name'];						
						$data = new  Spreadsheet_Excel_Reader($nama1);
						$row=$data->rowcount($sheet_index=0);
							$sql="";
							for($i=2;$i<=$row;$i++){
								$NPm 							=$data->val($i,1);
								$nama_mahasiswa 				=$data->val($i,2);
								$id_jenis_daftar 				=$data->val($i,3);
								$id_jalur_daftar 				=$data->val($i,4);
								$id_periode_masuk 				=$data->val($i,5);
								$tanggal_daftar					=$data->val($i,6);
								$Jenjang 						=$data->val($i,7);
								$nama_Prodi						=$data->val($i,8);
								$sks_diakui 					=$data->val($i,9);
								$nama_perguruan_tinggi_asal		=$data->val($i,10);
								$nama_prodi_asal				=$data->val($i,11);
								$pembiayaan 					=$data->val($i,12);	
								$sql .="insert into history_pendidikan_mahasiswa (NPm,nama_mahasiswa,id_jenis_daftar,id_jalur_daftar,id_periode_masuk,tanggal_daftar,jenjang,nama_prodi,sks_diakui,	nama_perguruan_tinggi_asal,nama_prodi_asal,id_pembiayaan,status) values ('$NPm ','$nama_mahasiswa ','$id_jenis_daftar','$id_jalur_daftar','$id_periode_masuk','$tanggal_daftar','$Jenjang ','$nama_Prodi','$sks_diakui ','$nama_perguruan_tinggi_asal','$nama_prodi_asal','$pembiayaan ','0');";
							} //end for
									if($cn->multi_query($sql)===true){		
										// echo "<script>alert('Data berhasil disimpan');</script>";
										header("location:index.php?sub=histori_pendidikan");
									}else{
										echo "Gagal menyimpan data :".$cn->error;
									}
					}//end if empty								
								?>
							<button class="btn btn-xs btn-success" id="valid_mhs"><span class="glyphicon glyphicon-check"></span> Validasi</button>
							<button class="btn btn-xs btn-info" id="import_feeder"><span class="glyphicon glyphicon-paperclip"></span> Import ke Feeder</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=list_mahasiswa'"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</button>
		 	</div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default">
  <div class="panel-heading">.:Data History Pendidikan:.</div>
  <div class="panel-body">



<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered">
		<tr>
			<td>no</td>
			<td>id_mahasiswa</td>
			<td>NPM</td>
			<td>nama_mahasiswa</td>
			<td>id_jenis_daftar</td>
			<td>id_jalur_daftar</td>
			<td>id_periode_masuk</td>
			<td>tanggal_daftar</td>
			<td>id_perguruan_tinggi</td>
			<td>NamaPerguruan tinggi</td>
			<td>id_prodi</td>
			<td>nama_prodi</td>
			<td>jenjang</td>
			<td>sks_diakui</td>
			<td>id_perguruan_tinggi_asal</td>
			<td>nama_perguruan_tinggi_asal</td>
			<td>id_prodi_asal</td>
			<td>nama_prodi_asal</td>
			<td>id_pembiayaan</td>
			<td>id_registrasi_mahasiswa</td>
			<td>Deskripsi</td>
			<td>Opsi</td>
		</tr>
			<?php 
				$result1=$cn->query("select * from history_pendidikan_mahasiswa where status='0'");
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 
						?>
							<tr>
								<td><?php echo $result["no"]; ?></td>
								<td><?php echo $result["id_mahasiswa"]; ?></td>
								<td><?php echo $result["NPM"]; ?></td>
								<td><?php echo $result["nama_mahasiswa"]; ?></td>
								<td><?php echo $result["id_jenis_daftar"]; ?></td>
								<td><?php echo $result["id_jalur_daftar"]; ?></td>
								<td><?php echo $result["id_periode_masuk"]; ?></td>
								<td><?php echo $result["tanggal_daftar"]; ?></td>
								<td><?php echo $result["id_perguruan_tinggi"]; ?></td>
								<td><?php echo $result["nama_perguruan_tinggi"]; ?></td>
								<td><?php echo $result["id_prodi"]; ?></td>
								<td><?php echo $result["nama_prodi"]; ?></td>
								<td><?php echo $result["jenjang"]; ?></td>
								<td><?php echo $result["sks_diakui"]; ?></td>
								<td><?php echo $result["id_perguruan_tinggi_asal"]; ?></td>
								<td><?php echo $result["nama_perguruan_tinggi_asal"]; ?></td>
								<td><?php echo $result["id_prodi_asal"]; ?></td>
								<td><?php echo $result["nama_prodi_asal"]; ?></td>
								<td><?php echo $result["id_pembiayaan"]; ?></td>
								<td><?php echo $result["id_registrasi_mahasiswa"]; ?></td>
								<td><?php echo $result["Deskripsi"]; ?></td>
								<td width="100px"><a href="#" class="btn btn-xs btn-success">Edit Data</a> | <a href="#" class="btn btn-xs btn-danger">Hapus</a></td>
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
<script>
	$(document).ready(function(){
		$("#valid_mhs").click(function(){
			$("#hasildata").load("piksi/../history_pendidikan/validasi_feeder_history_mahasiswa.php");
		});
	});

</script>