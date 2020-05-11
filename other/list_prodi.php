<?php 
// session_start();
require_once("config/koneksi.php");
// require_once("../config.php");
// cek terlebih dahulu jika tabel kosong
$sql="select * from prodi";
if($res=$cn->query($sql)){
	if($data=$res->num_rows>0){
		?>
			<div class="row">
				<div class="panel panel-default">
					    <div class="panel-heading">[ Data Prodi ]</div>
					    <div class="panel-body">
					    	<button type="button" name="updateagama" id="updateagama" class="btn btn-md btn-success">Update data dari Feeder <span class="glyphicon glyphicon-download-alt"></span></button>
					    	</div>		
					<!-- <div class="table-responsive"> -->
						<div id="pesan1">				
						</div>
						<div id="isii">				
						</div>
						<div class="table-responsive" style="height: 200px;">
						<table class="table table-bordered table-hover">
							<tr class="">
								<td class="label-primary" width="50">id_perguruan_tinggi</td>
								<td class="label-primary" width="50">nama_perguruan_tinggi</td>
								<td class="label-primary" width="50">id_prodi</td>
								<td class="label-primary" width="50">kode_program_studi</td>
								<td class="label-primary" width="50">nama_program_studi</td>
								<td class="label-primary" width="50">status</td>
								<td class="label-primary" width="50">id_jenjang_pendidikan</td>
								<td class="label-primary" width="50">nama_jenjang_pendidikan</td>								
							</tr>							
								<?php 
								while ($res2=$res->fetch_assoc()) {
									echo "<tr>";?>
									<td><?php echo $res2['id_perguruan_tinggi'];?></td>
									<td><?php echo $res2['nama_perguruan_tinggi'];?></td>
									<td><?php echo $res2['id_prodi'];?></td>
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
		// $data2 =["act"=>"GetDictionary","token"=>$token,"fungsi"=>"GetProfilPT"];
		$data2 =["act"=>"GetAllProdi","token"=>$token,"filter"=>"","limit"=>0];
		$result2=json_decode(runWS($data2));
		foreach ($result2->data as $value) {
		$sql ="insert into prodi (id_perguruan_tinggi,nama_perguruan_tinggi,id_prodi,kode_program_studi,nama_program_studi,status,id_jenjang_pendidikan,nama_jenjang_pendidikan) values('$value->id_perguruan_tinggi',	'$value->nama_perguruan_tinggi',	'$value->id_prodi',	'$value->kode_program_studi',	'$value->nama_program_studi',	'$value->status',	'$value->id_jenjang_pendidikan',	'$value->nama_jenjang_pendidikan')";
			if($cn->query($sql)===true){
			header("location:index.php?sub=prodi");
			}else{
				echo "Gagal mengambil data profile PT  :".$cn->error;
			}
		}
	}
}else{
	echo $cn->error;
}
 ?>


 