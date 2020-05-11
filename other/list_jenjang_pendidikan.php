<?php 
$token=$_SESSION['token'];
$data2 =
[
  "act"=>"GetJenjangPendidikan",
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
		<table class="table table-bordered table-hover">
			<tr>
				<td>No</td>
				<td>id_jenjang_didik</td>
				<td>nama_jenjang_didik</td>
			</tr>
			<?php
				$no=1;
				foreach ($result2->data as $row) {
				?>
				<tr>
					<td><?php echo$no; ?></td>
					<td><?php echo$row->id_jenjang_didik; ?></td>
					<td><?php echo$row->nama_jenjang_didik; ?></td>
				</tr>
				<?php
				$no++;
				}
				 ?>
		</table>
	</div>
</div>