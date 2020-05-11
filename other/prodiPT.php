<?php 
require_once("config/koneksi.php");
$sql="select * from prodipt";
if($res=$cn->query($sql)){
	if($data=$res->num_rows>0){
		?>
			<div class="row">
				<div class="panel panel-default">
					    <div class="panel-heading">[ Data Prodi PT ]</div>
					    <div class="panel-body">					    	
					    	</div>		
					<!-- <div class="table-responsive"> -->
					
						
						<div class="table-responsive" style="height: 300px;">
						<table class="table table-bordered table-hover">
							<tr class="">
								<td class="label-primary" width="50">kode_program_studi</td>
								<td class="label-primary" width="50">nama_program_studi</td>
								<td class="label-primary" width="50">status</td>
								<td class="label-primary" width="50">id_jenjang_pendidikan</td>
								<td class="label-primary" width="50">nama_jenjang_pendidikan</td>								
							</tr>							
								<?php 
								while ($res2=$res->fetch_assoc()) {
									echo "<tr>";?>
									<td><?php echo $res2['kode_program_studi'];?></td>
									<td><?php echo $res2['nama_program_studi'];?></td>
									<td><?php echo $res2['status'];?></td>
									<td><?php echo $res2['id_jenjang_pendidikan'];?></td>
									<td><?php echo $res2['nama_jenjang_pendidikan'];?></td>
									<?php echo "</tr>";	
								}
								?>							
						</table>
					</div>
		<?php
	}else{//proses mengambil data di Feeder

		$token=$_SESSION['token'];
		$data2 =["act"=>"GetProdi","token"=>$token,"filter"=>"","limit"=>0];
		$result2=json_decode(runWS($data2));
		foreach ($result2->data as $value) {
		$sql ="insert into prodipt(id_prodi,kode_program_studi,nama_program_studi,status,id_jenjang_pendidikan,nama_jenjang_pendidikan) values('$value->id_prodi','$value->kode_program_studi','$value->nama_program_studi','$value->status','$value->id_jenjang_pendidikan',	'$value->nama_jenjang_pendidikan')";
			$cn->query($sql);			
		}
	}
}
 ?>


 