<div class="row">
			<div class="col-md-6">
							<button class="btn btn-xs btn-primary" onclick="location.href='other/get_wilayah.php'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 1.Update dari Feeder</button>
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=list_mahasiswa'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 2.Back</button>
							
							
		 	</div> <!-- end mcol-md-6 -->
		 	<div class="col-md-6">
		 		<form action="">
				<div class="input-group">
					<input type="text" name="cari_matkul" class="form-control" id="cari_wil" placeholder="ketik nama mata kuliah" />
					<div class="input-group-btn">
						<button type="submit" name="submit" id="submitcari" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>				
				</form>
		 	</div>
</div>
<br>
<div class="panel panel-default">
  <div class="panel-heading">.:Data Wilayah:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<div id="hasil_cari">
		<table class="table table-bordered table-hover">
				<tr>
					<td>No</td>
					<td>id_wilayah</td>
					<td>nama_wilayah</td>
				</tr>
				<?php
				$result1=$cn->query("select * from getwilayah limit 200");
				if($result1->num_rows>0){
				$no=1;
				while ($row=$result1->fetch_assoc()){
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['id_wilayah']; ?></td>
					<td><?php echo $row['nama_wilayah']; ?></td>
				</tr>
				<?php
				$no++;
				}
				 ?>
		</table>
		<?php 
		}else{
			echo "<tr><td colspan='2'>No Data</td></tr>";
		}
		 ?>		
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

	$("#cari_wil").keyup(function(event){
		pencarian();
	});

function pencarian(){
	var namawil=$('#cari_wil').val();
	$.ajax({
		url:'other/cari_wilayah.php',
		data:'wil='+namawil,
		success:function(data){
			$('#hasil_cari').html(data);
		}
	});
}

	});

</script>