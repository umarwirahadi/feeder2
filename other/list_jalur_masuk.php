<?php 
require_once("config/koneksi.php");
// $token=$_SESSION['token'];
// $data2 =
// [
//   "act"=>"GetAgama",
//   "token"=>$token,
//   "filter"=>"",
//   "limit"=>0
// ];
// $result2=json_decode(runWS($data2));
// echo "<pre>";
// print_r($result2);
// echo "</pre>";
?>
<div class="row">
	<div class="panel panel-default">
		    <div class="panel-heading">[ Data Jalur Masuk ]</div>
		    <div class="panel-body">
		    	<button type="button" name="updateagama" id="updateagama" class="btn btn-md btn-success">Update data dari Feeder <span class="glyphicon glyphicon-download-alt"></span></button>
		    	</div>		
		<!-- <div class="table-responsive"> -->
			<div id="pesan1">				
			</div>
			<div id="isii">				
			</div>
			<table class="table table-bordered table-hover">
				<tr class="">
					<td class="label-primary" width="50"><b>No</b></td>
					<td class="label-primary" width="50"><b>ID JALUR MASUK</b></td>
					<td class="label-primary" width="300"><b>JALUR MASUK</b></td>
					<td class="label-primary" width="100"><b>OPTION</b></td>
				</tr>
				<tr>
				<?php
				$sql="select * from getjalurmasuk";
				$res 		=$cn->query($sql);
				$perpage	=10;
				$totalrows	=$res->num_rows;
				$sql="select * from getjalurmasuk limit 10";
				$result=$cn->query($sql);
				if($result->num_rows>=1){
					$no=1;
					while ($row=$result->fetch_assoc()) { ?>
						<td><?php echo $no; ?></td>
						<td><?php echo $row['id_jalur_masuk']; ?></td>
						<td><?php echo $row['nama_jalur_masuk']; ?></td>
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
		$("#updateagama").click(function(){
			$("#isii").load("other/get_jalur_masuk.php");
		});
	});
</script>