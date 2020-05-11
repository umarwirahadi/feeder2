<div class="row">
			<div class="col-md-12">
				<a href="kelas_kuliah/download_krs_mahasiswa.php" class="label label-info">1. Download contoh KRS *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="krsMhs" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="2. Upload" />
				</form>
					<?php 
					if(isset($_POST['submit'])){
						require_once('excel_reader2.php');
						$krsmhs 		= 	$_FILES["krsMhs"]["tmp_name"];
						if (!empty($krsmhs)){						
						// echo "nilainya : ".$xlnilai;
						$krsmhs1 = new  Spreadsheet_Excel_Reader($krsmhs);
						$row=$krsmhs1->rowcount($sheet_index=0);
							for($i=2;$i<=$row;$i++){
							$nim 						=$krsmhs1->val($i,1);
							$nama_mahasiswa 			=$cn->real_escape_string($krsmhs1->val($i,2));
							$jenjang 					=$krsmhs1->val($i,3);
							$jurusan 					=$krsmhs1->val($i,4);							
 							$kode_mata_kuliah 			=$krsmhs1->val($i,5);
							$nama_mata_kuliah 			=$krsmhs1->val($i,6);
							$nama_kelas_kuliah 			=$krsmhs1->val($i,7);
							$id_semester 				=$krsmhs1->val($i,8);
							$sql ="insert into krs_mahasiswa (nim,nama_mahasiswa,jenjang,jurusan,kode_mata_kuliah,nama_mata_kuliah,nama_kelas_kuliah,id_semester,status) values ('$nim','$nama_mahasiswa','$jenjang','$jurusan','$kode_mata_kuliah','$nama_mata_kuliah','$nama_kelas_kuliah','$id_semester','0')";
							if($cn->query($sql)){
							}
							} //end for									
						}//end if empty
					}
							?>
							<button class="btn btn-xs btn-info" id="valid_mhs" onclick="location.href='kelas_kuliah/validasi_krs_mahasiswa.php';"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
							<button class="btn btn-xs btn-primary" onclick="location.href='kelas_kuliah/import_krs_mhs.php'"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
							<!-- <button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=list_mahasiswa'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5.Back</button> -->
							<button class="btn btn-xs btn-warning" id="subdelete"><span class="glyphicon glyphicon-trash"></span> 6. Delete Invalid data</button>
							<button class="btn btn-xs btn-danger" id="idtruncate"><span class="glyphicon glyphicon-remove-circle"></span> 7.Truncate Data</button>
		 	</div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default">
<div class="panel-heading">
  	<div class="row">
  		<div class="col-md-6">
  			 .:Data KRS Mahasiswa:.
  		</div>  	
	  	<div class="col-md-6">
	  		<div class="input-group">	  		
	  			<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input type="text" name="carikrs" id="carikrs" class="form-control" placeholder="pencarian KRS Mahasiswa">
	  		</div>
	  	</div>
  	</div>
</div>
</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered ">
		<tr>
			<td>id</td>
			<td>nim</td>
			<td>nama_mahasiswa</td>
			<td>jenjang</td>
			<td>jurusan</td>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>id_semester</td>
			<td>deskripsi</td>
			<td>Option</td>
		</tr>
			<?php 
				$color1="#88EB88";				
				$color2="white";				
				if($result1=$cn->query("select * from krs_mahasiswa where status=0 or status=1")){
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) { 
							if($result["id_kelas_kuliah"]==''||$result["id_registrasi_mahasiswa"]==''){
								echo "<tr bgcolor='".$color1."'>";
							}else{
								echo "<tr bgcolor='".$color2."'>";
							}						
						?>				
								<td><?php echo $result["id"]; ?></td>
								<td><?php echo $result["nim"]; ?></td>
								<td><?php echo $result["nama_mahasiswa"]; ?></td>
								<td><?php echo $result["jenjang"]; ?></td>
								<td><?php echo $result["jurusan"]; ?></td>
								<td><?php echo $result["kode_mata_kuliah"]; ?></td>
								<td><?php echo $result["nama_mata_kuliah"]; ?></td>
								<td><?php echo $result["id_semester"]; ?></td>
								<td><?php echo $result["desk"]; ?></td>
								<td><a href="index.php?sub=krs&id=<?php echo $result["id"];?>" class="btn btn-xs btn-success">Edit Data</a> | <a href="kelas_kuliah/delete_krs_mhs.php?id=<?php echo $result['id'];?>" class="btn btn-xs btn-danger" id="hpskrs">Hapus</a></td>
							</tr>

						<?php
							}
					}else {//else jika tidak ada data history
								echo '<tr><td colspan="16">No data</td></tr>';
							}
					}
					$cn->close();
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

		$("#idtruncate").click(function(){
			kosong_data()
		});
		function kosong_data(){
			if(confirm('Yakin data Kelas kuliah akan dikosongkan')==true){
				location.href='kelas_kuliah/truncate_krs.php';
			}
		}
		$("#subdelete").click(function(){
			if(confirm("yakin data yang tidak valid akan dihapus ?")==true){
				location.href='kelas_kuliah/delete_invalid_record.php';	
			}
		});
		$("#hpskrs").click(function(){
			var pesanhapus=confirm("yakin data KRS ini akan dihapus ?");
			if(pesanhapus==true){
				// window.href='kelas_kuliah/delete_krs_mhs.php';
				return true;
			}else{
				return false;
			}
		});

	});

</script>