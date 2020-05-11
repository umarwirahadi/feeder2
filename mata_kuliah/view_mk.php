<div class="row">
			<div class="col-md-6">					
				<a class="btn btn-xs btn-info"  href="mata_kuliah/act_export_matakuliah.php"><span class="glyphicon glyphicon-export"></span> 1. Export to Excel*.xls </a>
				<button class="btn btn-xs btn-primary" onclick="location.href='mata_kuliah/update_from_feeder.php'"><span class="glyphicon glyphicon-refresh"></span> 2.Update dari Feeder</button>
				<button class="btn btn-xs btn-danger" onclick="window.history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> 3.Back</button>
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
  <div class="panel-heading">.:Data Mata Kuliah:.  jumlah :<?php $rn=$cn->query("select count(id_matkul) as jml from getlistmatakuliah");$rn1=$rn->fetch_row();echo $rn1['0']; ?> </div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<div id="hasil_cari">
	<table class="table table-bordered">
		<tr>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>sks_mata_kuliah</td>
			<td>nama_program_studi</td>			
			<td>id_jenis_mata_kuliah</td>
			<td>id_kelompok_mata_kuliah</td>
			<td>Aksi</td>
		</tr>
			<?php
				$result1=$cn->query("select * from getlistmatakuliah");
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) {
						?>
							<tr>
								<td ><?php echo $result["kode_mata_kuliah"]; ?></td>
								<td ><?php echo $result["nama_mata_kuliah"]; ?></td>
								<td ><?php echo $result["sks_mata_kuliah"]; ?></td>
								<td ><?php echo $result["nama_program_studi"]; ?></td>
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
