<?php 
$token=$_SESSION['token'];
$data2 =
[
  "act"=>"GetPeriode",
  "token"=>$token,
  "filter"=>"",
  "limit"=>0,
  "order"=>""
];
$result2=json_decode(runWS($data2));
// echo "<pre>";
// print_r($result2);
// echo "</pre>";
?>
<div class="row">
	<div class="col-md-10">
		<table class="table table-bordered table-hover">
			<tr>
				<td>no</td>
				<td>id_prodi</td>
				<td>kode_prodi</td>
				<td>nama_program_studi</td>
				<td>status_prodi</td>
				<td>jenjang_pendidikan</td>
				<td>periode_pelaporan</td>				
			</tr>
			<?php 
				$no=1;
				foreach ($result2->data as $row) {
				?>
				<tr>
					<td><?php echo$no; ?></td>
					<td><?php echo$row->id_prodi; ?></td>
					<td><?php echo$row->kode_prodi; ?></td>
					<td><?php echo$row->nama_program_studi; ?></td>
					<td><?php echo$row->status_prodi; ?></td>
					<td><?php echo$row->jenjang_pendidikan; ?></td>
					<td><?php echo$row->periode_pelaporan; ?></td>
				</tr>
				<?php
				$no++;
				}
			 ?>
		</table>
	</div>
</div>