<div class="row">
			<div class="col-md-6">
				<a href="mata_kuliah/download_matkul.php" class="label label-info">1. Download contoh Kurikulum *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file" name="filematkul" accept=".xls"  class="btn btn-xs btn-danger" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success" value="2. Upload" />
				</form>
					<?php
					if(isset($_POST['submit'])){
						require_once("excel_reader2.php");
						$nama1 		= 	$_FILES['filematkul']['name'];
						$data = new  Spreadsheet_Excel_Reader($nama1);
						$row=$data->rowcount($sheet_index=0);
							$sql="";
							for($i=2;$i<=$row;$i++){

								$kode_matkul =$data->val($i,1);
								$namamatkul =$data->val($i,2);
								$sks=$data->val($i,3);
								$prodi=$data->val($i,4);
								$id_jenismatkul=$data->val($i,5);
								$id_kelompokmatkul=$data->val($i,6);

								$sql .="insert into nilai_transfer (nim,nama_mahasiswa,id_registrasi_mahasiswa,kode_mata_kuliah_asal,nama_mata_kuliah_asal,sks_mata_kuliah_asal,	nilai_huruf_asal,id_matkul,sks_mata_kuliah_diakui,nilai_huruf_diakui,nilai_angka_diakui) values('$nim','$nama',$id_registrasi_mahasiswa',	'$kode_mata_kuliah_asal','$nama_mata_kuliah_asal','$sks_mata_kuliah_asal','$nilai_huruf_asal','$id_matkul',	'$sks_mata_kuliah_diakui','$nilai_huruf_diakui','$nilai_angka_diakui');";
							} //end for
									if($cn->multi_query($sql)===true){
										echo "<script>alert('Data berhasil diupload');</script>";
										// header("location:index.php?sub=histori_pendidikan");
									}else{
										echo "Gagal menyimpan data :".$cn->error;
									}
					}//end if empty
								?>
							<button class="btn btn-xs btn-success" id="valid_mhs"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
							<button class="btn btn-xs btn-info" id="import_feeder"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
							<button class="btn btn-xs btn-primary" onclick="location.href='mata_kuliah/update_from_feeder.php'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5.Update dari Feeder</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=list_mahasiswa'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 6.Back</button>


		 	</div> <!-- end mcol-md-6 -->
		 	<div class="col-md-6">
		 		<form action="">
				<div class="input-group">
					<input type="text" name="cari_matkul" class="form-control" id="cari_matkul" placeholder="ketik nama mata kuliah" />
					<div class="input-group-btn">
						<button type="submit" name="submit" id="submitcari" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
				</form>
		 	</div>
</div>
<br>
<div class="panel panel-default">
  <div class="panel-heading">.:Kurikulum:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<div id="hasil_cari">
	<table class="table table-bordered">
		<tr>
			<td>id_matkul</td>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>sks_mata_kuliah</td>
			<td>id_prodi</td>
			<td>nama_program_studi</td>
			<td>jenjang</td>
			<td>id_jenis_mata_kuliah</td>
			<td>id_kelompok_mata_kuliah</td>
			<td>Opsi</td>
		</tr>
			<?php
				$result1=$cn->query("select * from matakuliah where status='0' limit 200");
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) {
						?>
							<tr>
								<td ><?php echo $result["id_matkul"]; ?></td>
								<td ><?php echo $result["kode_mata_kuliah"]; ?></td>
								<td ><?php echo $result["nama_mata_kuliah"]; ?></td>
								<td ><?php echo $result["sks_mata_kuliah"]; ?></td>
								<td ><?php echo $result["id_prodi"]; ?></td>
								<td ><?php echo $result["nama_program_studi"]; ?></td>
								<td ><?php echo $result["jenjang"]; ?></td>
								<td ><?php echo $result["id_jenis_mata_kuliah"]; ?></td>
								<td ><?php echo $result["id_kelompok_mata_kuliah"]; ?></td>
								<td ><a href="#" class="btn btn-xs btn-success">Edit Data</a> | <a href="#" class="btn btn-xs btn-danger">Hapus</a></td>
							</tr>

						<?php
							}
					}else {//else jika tidak ada data history
								echo '<tr><td colspan="22">No data</td></tr>';
							}
					?>
	</table>
</div>
</div><!-- end table responsive-->
</div>
</div>
<div id="hasildata">

</div>
<script>
	$(document).ready(function(){
		$("#update-from-feeder-mk").click(function(){
			$("#hasildata").load("piksi/../mata_kuliah/update_from_feeder.php");
		});

$("#submitcari").click(function(event){
event.preventDefault();
	pencarian();
})

	$("#cari_matkul").keyup(function(event){
		pencarian();
	});

function pencarian(){
	var namamk=$('#cari_matkul').val();
	$.ajax({
		url:'mata_kuliah/cari_mk.php',
		data:'namamk='+namamk,
		success:function(data){
			$('#hasil_cari').html(data);
		}
	});
}

	});

</script>
