<?php 
require_once("config/koneksi.php");
?>
<div class="row">
	<div class="panel panel-default">
		    <div class="panel-heading">[ Data Jenis Daftar ]</div>
		    <div class="panel-body">
		    	<button type="button" name="updatejenisdaftar" id="updatejenisdaftar" class="btn btn-md btn-success">Update data dari Feeder <span class="glyphicon glyphicon-download-alt"></span></button>
		    	</div>		
		<!-- <div class="table-responsive"> -->
			<div id="pesan1">				
			</div>
			<div id="isii">				
			</div>
			<table class="table table-bordered table-hover">
				<tr class="">
					<td class="label-primary" width="50"><b>No</b></td>
					<td class="label-primary" width="50"><b>ID JENIS DAFTAR</b></td>
					<td class="label-primary" width="300"><b>JENIS DAFTAR</b></td>
					<td class="label-primary" width="100"><b>OPTION</b></td>
				</tr>
				<tr>
				<?php
				$sql="select * from GetJenisPendaftaran";
				$res 		=$cn->query($sql);
				$perpage	=10;
				$totalrows	=$res->num_rows;
				$sql="select * from GetJenisPendaftaran limit 10";
				$result=$cn->query($sql);
				if($result->num_rows>=1){
					$no=1;
					while ($row=$result->fetch_assoc()) { ?>
						<td><?php echo $no; ?></td>
						<td><?php echo $row['id_jenis_daftar']; ?></td>
						<td><?php echo $row['nama_jenis_daftar']; ?></td>
						<td><a href="#" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-zoom-in"></span></a> <a href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
						<?php 
						$no++;
						}
				}else{
					echo "Data tidak ada";
				}
				?>
			</table>
		<!-- </div> -->
</div>
<div class="panel-footer">Panel Footer</div>
</div>

<script>
	$(document).ready(function(){
		$("#updatejenisdaftar").click(function(){
			$("#isii").load("other/get_jenis_daftar.php");
		});
	});
</script>