
<div class="row">
	<div class="panel panel-default">
		    <div class="panel-heading">[ Data Jenis Keluar ]</div>
		    <div class="panel-body">
		    	<button type="button" name="updatejeniskeluar" id="updatejeniskeluar" class="btn btn-md btn-success">Export to Excel (*.xls) <span class="glyphicon glyphicon-download-alt"></span></button>
		    	</div>		
		<!-- <div class="table-responsive"> -->
			<div id="pesan1">				
			</div>
			<div id="isii">				
			</div>
			<table class="table table-bordered table-hover">
				<tr class="">
					<td class="label-primary" width="50"><b>No</b></td>
					<td class="label-primary" width="50"><b>ID JENIS KELUAR</b></td>
					<td class="label-primary" width="300"><b>JENIS KELUAR</b></td>
					<td class="label-primary" width="100"><b>OPTION</b></td>
				</tr>
				<tr>
				<?php
				$token=$_SESSION['token'];
				$data2 =["act"=>"GetJenisKeluar","token"=>$token,"filter"=>"","limit"=>"30"];
				$result2=json_decode(runWS($data2));
				$no=1;
				foreach ($result2->data as $row) {?>

						<td><?php echo $no; ?></td>
						<td><?php echo $row->id_jenis_keluar; ?></td>
						<td><?php echo $row->jenis_keluar; ?></td>
						<td><a href="#" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-zoom-in"></span></a> <a href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
				</tr>
				<?php
				$no++;						
				}
				?>
			</table>
		<!-- </div> -->
</div>
<div class="panel-footer">Panel Footer</div>
</div>

<script>
	$(document).ready(function(){
		$("#updatejeniskeluar").click(function(){
			$("#isii").load("other/get_jalur_masuk.php");
		});
	});
</script>