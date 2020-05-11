<?php 
$token=$_SESSION['token'];
$data2 =
[
  "act"=>"GetPenghasilan",
  "token"=>$token,
  "filter"=>"",
  "limit"=>0
];
$result2=json_decode(runWS($data2));
// echo "<pre>";
// print_r($result2);
// echo "</pre>";
?>
<div class="row">
	<div class="col-md-2">
		
	</div>
	<div class="col-md-10">
		<!-- <div class="table-responsive"> -->
			<table class="table table-bordered table-hover">
				<tr>
					<td>No</td>
					<td>id_penghasilan</td>
					<td>nama_penghasilan</td>
				</tr>
				<?php
				$no=1;
				foreach ($result2->data as $row) {
				?>
				<tr>
					<td><?php echo$no; ?></td>
					<td><?php echo$row->id_penghasilan; ?></td>
					<td><?php echo$row->nama_penghasilan; ?></td>
				</tr>
				<?php
				$no++;
				}
				 ?>
			</table>
		<!-- </div> -->
	</div>
</div>