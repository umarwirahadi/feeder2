<div class="row">
	<div class="container-fluid">
	<div class="col-md-10-offset">
<div class="panel-group">
	<div class="panel panel-primary">
		<div class="panel-heading">.:Data Semester Aktif:.</div>
	<div class="panel-body">
	<div class="">
		<button class="btn btn-xs btn-info" id="updatesmt">Update dari Feeder</button>
	</div>
<div class="table table-responsive" style="height:400px;" id="smtaktif">
		<div id="load"></div>
		<table class="table table-bordered table-hover">
			<tr>
				<td>no</td>
				<td>id_semester</td>
				<td>id_tahun_ajaran</td>
				<td>nama_semester</td>
				<td>semester</td>
				<td>a_periode_aktif</td>
				<td>tanggal_mulai</td>
				<td>tanggal_selesai</td>
			</tr>
			<?php
			$sqlsmt="select * from getsemester";
			if($ressmt=$cn->query($sqlsmt)){
				if($ressmt->num_rows){
				$no=1;
				while ($row=$ressmt->fetch_assoc()) {
				?>
				<tr>
					<td><?php echo$no; ?></td>
					<td><?php echo$row['id_semester']; ?></td>
					<td><?php echo$row['id_tahun_ajaran']; ?></td>
					<td><?php echo$row['nama_semester']; ?></td>
					<td><?php echo$row['semester']; ?></td>
					<td><?php echo$row['a_periode_aktif']; ?></td>
					<td><?php echo$row['tanggal_mulai']; ?></td>
					<td><?php echo$row['tanggal_selesai']; ?></td>
				</tr>
				<?php
				$no++;
				}
				}else{
					?>
					<tr>
						<td colspan="8">No Record</td>
					</tr>
				<?php }
			}
			 ?>
		</table>
	</div>
	</div>
</div>
</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$("#updatesmt").click(function(){
			$.ajax({
				url:"other/update_list_semester.php",
				beforeSen:function(){
					// $("#smtaktif").html("<img id='gbrload' src='piksi/../assets/200.gif' />");
					$("#smtaktif").html("loading");
				},
				success:function(data){
					$("#smtaktif").remove("#gbrload");
					$("#smtaktif").html(data);
				}
			})
		})
	})
</script>