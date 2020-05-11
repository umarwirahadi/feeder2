<div class="row">
			<div class="col-md-6">
				<a href="kurikulum/download_matkul_kurikulum.php?idkurikulum=<?php echo $_GET['idkurikulum']; ?>" class="label label-info">1. Download contoh Mata kuliah Kurikulum *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file" name="kurikulummk" accept=".xls"  class="btn btn-xs btn-danger" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success" value="2. Upload" />
				</form>
					<?php
					if(isset($_POST['submit'])){
						require_once("excel_reader2.php");
						$nama1 		= 	$_FILES['kurikulummk']['tmp_name'];
						if (!empty($nama1)){
						$data = new  Spreadsheet_Excel_Reader($nama1);
						$row=$data->rowcount($sheet_index=0);
							for($i=2;$i<=$row;$i++){

								$nama_kurikulum =$cn->real_escape_string($data->val($i,1));
								$id_semester 	=$cn->real_escape_string($data->val($i,2));
								$nama_prodi		=$cn->real_escape_string($data->val($i,3));
								$jenjang 		=$cn->real_escape_string($data->val($i,4));
								$kodemk 		=$cn->real_escape_string($data->val($i,5));
								$namamk 		=$cn->real_escape_string($data->val($i,6));
								$sks 			=$cn->real_escape_string($data->val($i,7));
								$semester 		=$cn->real_escape_string($data->val($i,8));
								$sks_mk 		=$cn->real_escape_string($data->val($i,9));
								$wajib 	 		=$cn->real_escape_string($data->val($i,10));
								
								$sql="insert into insertmatkulkurikulum (nama_kurikulum,id_semester,nama_prodi,jenjang,kode_matkul,nama_matkul,sks,semester,sks_mata_kuliah,apakah_wajib,status) values('$nama_kurikulum','$id_semester','$nama_prodi','$jenjang','$kodemk','$namamk','$sks','$semester','$wajib','$wajib','0');";
								$cn->query($sql);
							} //end for
									
					}
					}//end if empty
								?>
							<button class="btn btn-xs btn-success" id="validasi_mk_kurikulum"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
							<button class="btn btn-xs btn-info" id="import_feeder10"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
							<button class="btn btn-xs btn-danger" id="delete_feeder10"><span class="glyphicon glyphicon-paperclip"></span> 5. Delete All</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=Kurikulum'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 6.Back</button>
		 	</div>
</div>
<br>
<div class="panel panel-default">
  <div class="panel-heading">.:View Mata kuliah Kurikulum:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<div id="hasil_cari">
	<table class="table table-bordered">
		<tr>
			<td>id</td>
			<td>nama_kurikulum</td>
			<td>smt_mulai_berlaku</td>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>sks</td>
			<td>semester</td>
			<td>wajib/pilihan</td>
			<td>deskripsi</td>
			<td>Opsi</td>
		</tr>
			<?php
			$color1="white";
			$color2="#88EB88";
				$result1=$cn->query("select * from insertmatkulkurikulum");
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) {
						if(empty($result['id_kurikulum']) OR $result['id_kurikulum']=="" OR empty($result['id_matkul']) OR $result['id_matkul']==""){
							echo "<tr bgcolor='".$color2."'>";
						}else{
							echo "<tr bgcolor='".$color1."'>";
						}
						?>							
								<td ><?php echo $result["id"]; ?></td>
								<td ><?php echo $result["nama_kurikulum"]; ?></td>
								<td ><?php echo $result["id_semester"]; ?></td>
								<td ><?php echo $result["kode_matkul"]; ?></td>
								<td ><?php echo $result["nama_matkul"]; ?></td>
								<td ><?php echo $result["sks"]; ?></td>
								<td ><?php echo $result["semester"]; ?></td>
								<td ><?php echo $result["apakah_wajib"]; ?></td>
								<td ><?php echo $result["desk"]; ?></td>
								<td ><a href="#" class="btn btn-xs btn-success">Edit Data</a> | <a href="kurikulum/deletematkul_kurikulum.php?id=<?=$result["id"];?>" class="btn btn-xs btn-danger">Hapus</a></td>
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

	$("#validasi_mk_kurikulum").click(function() {
		window.location.href='kurikulum/validasi_matkul_kurikulum.php';		
	});
	$("#import_feeder10").click(function(event) {
		window.location.href='kurikulum/import_matkul_kurikulum.php';
	});
	
	$("#delete_feeder10").click(function(event) {
		window.location.href='kurikulum/delete_all.php';
	});
	
	

	});

</script>
