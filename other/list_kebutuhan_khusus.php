<?php 
require_once("config/koneksi.php");
// $token=$_SESSION['token'];
// $data2 =
// [
//   "act"=>"GetKebutuhanKhusus",
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
		    <div class="panel-heading">[ Data Kbutuhan Khusus ]</div>
		    <div class="panel-body">
		    	<button type="button" name="updatekebutuhankhusus" id="updatekebutuhankhusus" class="btn btn-md btn-success">Update data dari Feeder <span class="glyphicon glyphicon-download-alt"></span></button>
		    	</div>		
		<!-- <div class="table-responsive"> -->
			<div id="pesan1">				
			</div>
			<div id="isii">				
			</div>
			<table class="table table-bordered table-hover">
				<tr class="">
					<td class="label-primary" width="50"><b>No</b></td>
					<td class="label-primary" width="50"><b>ID</b></td>
					<td class="label-primary" width="300"><b>KEBUTUHAN KHUSUS</b></td>
					<td class="label-primary" width="100"><b>OPTION</b></td>
				</tr>
				<tr>
				<?php
				$sql="select * from tb_kebutuhan_khusus";
				$res 		=$cn->query($sql);
				$perpage	=10;
				$totalrows	=$res->num_rows;
				$sql="select * from tb_kebutuhan_khusus limit 100";
				$result=$cn->query($sql);
				if($result->num_rows>=1){
					$no=1;
					while ($row=$result->fetch_assoc()) { ?>
						<td><?php echo $no; ?></td>
						<td><?php echo $row['id_kebutuhan_khusus']; ?></td>
						<td><?php echo $row['nama_kebutuhan_khusus']; ?></td>
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
		$("#updatekebutuhankhusus").click(function(){
			$("#isii").load("other/proses_kebutuhan_khusus.php",function(responseTxt,statusTxt,xhr){
				if(statusTxt=="success")
					$("#pesan1").html="Sukses menampilkan data";
				if(statusTxt=="error")
					$("#pesan1").html="<b>gagal menampilkan data</b>";
			});
		});
	});
</script>