<?php 
require_once("config/koneksi.php");
$sql="select * from getprofilpt";
if($res=$cn->query($sql)){
	if($data=$res->num_rows>0){
		?>
			<div class="row">
				<div class="panel panel-default">
					    <div class="panel-heading">[ Data Profile PT ]</div>
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
								<td class="label-primary" width="50">kode_perguruan_tinggi</td>
								<td class="label-primary" width="50">nama_perguruan_tinggi</td>
								<td class="label-primary" width="50">telepon</td>
								<td class="label-primary" width="50">faximile</td>
								<td class="label-primary" width="50">email</td>
								<td class="label-primary" width="50">website</td>
								<td class="label-primary" width="50">jalan</td>
								<td class="label-primary" width="50">dusun</td>
								<td class="label-primary" width="50">rt_rw</td>
								<td class="label-primary" width="50">kelurahan</td>
								<td class="label-primary" width="50">kode_pos</td>
								<td class="label-primary" width="50">id_wilayah</td>
								<td class="label-primary" width="50">nama_wilayah</td>
								<td class="label-primary" width="50">lintang_bujur</td>
								<td class="label-primary" width="50">bank</td>
								<td class="label-primary" width="50">unit_cabang</td>
								<td class="label-primary" width="50">nomor_rekening</td>
								<td class="label-primary" width="50">mbs</td>
								<td class="label-primary" width="50">luas_tanah_milik</td>
								<td class="label-primary" width="50">luas_tanah_bukan_milik</td>
								<td class="label-primary" width="50">sk_pendirian</td>
								<td class="label-primary" width="50">tanggal_sk_pendirian</td>
								<td class="label-primary" width="50">id_status_milik</td>
								<td class="label-primary" width="50">nama_status_milik</td>
								<td class="label-primary" width="50">status_perguruan_tinggi</td>
								<td class="label-primary" width="50">sk_izin_operasional</td>
								<td class="label-primary" width="50">tanggal_izin_operasional</td>
							</tr>							
								<?php 
								while ($res2=$res->fetch_assoc()) {
									echo "<tr>";?>
									<td><?php echo $res2['id_perguruan_tinggi'];?></td>
									<td><?php echo $res2['kode_perguruan_tinggi'];?></td>
									<td><?php echo $res2['nama_perguruan_tinggi'];?></td>
									<td><?php echo $res2['telepon'];?></td>
									<td><?php echo $res2['faximile'];?></td>
									<td><?php echo $res2['email'];?></td>
									<td><?php echo $res2['website'];?></td>
									<td><?php echo $res2['jalan'];?></td>
									<td><?php echo $res2['dusun'];?></td>
									<td><?php echo $res2['rt_rw'];?></td>
									<td><?php echo $res2['kelurahan'];?></td>
									<td><?php echo $res2['kode_pos'];?></td>
									<td><?php echo $res2['id_wilayah'];?></td>
									<td><?php echo $res2['nama_wilayah'];?></td>
									<td><?php echo $res2['lintang_bujur'];?></td>
									<td><?php echo $res2['bank'];?></td>
									<td><?php echo $res2['unit_cabang'];?></td>
									<td><?php echo $res2['nomor_rekening'];?></td>
									<td><?php echo $res2['mbs'];?></td>
									<td><?php echo $res2['luas_tanah_milik'];?></td>
									<td><?php echo $res2['luas_tanah_bukan_milik'];?></td>
									<td><?php echo $res2['sk_pendirian'];?></td>
									<td><?php echo $res2['tanggal_sk_pendirian'];?></td>
									<td><?php echo $res2['id_status_milik'];?></td>
									<td><?php echo $res2['nama_status_milik'];?></td>
									<td><?php echo $res2['status_perguruan_tinggi'];?></td>
									<td><?php echo $res2['sk_izin_operasional'];?></td>
									<td><?php echo $res2['tanggal_izin_operasional'];?></td>
									<?php echo "</tr>";	
								}
								?>							
						</table>
					</div>
		<?php
	}else{//proses mengambil data di Feeder

		$token=$_SESSION['token'];
		// $data2 =["act"=>"GetDictionary","token"=>$token,"fungsi"=>"GetProfilPT"];
		$data2 =["act"=>"GetProfilPT","token"=>$token,"filter"=>"","limit"=>0];
		$result2=json_decode(runWS($data2));
		foreach ($result2->data as $value) {
		$sql ="insert into getprofilpt (id_perguruan_tinggi,	kode_perguruan_tinggi,	nama_perguruan_tinggi,	telepon,	faximile,	email,	website,	jalan,	dusun,	rt_rw,	kelurahan,	kode_pos,	id_wilayah,	nama_wilayah,	lintang_bujur,	bank,	unit_cabang,	nomor_rekening,	mbs,	luas_tanah_milik,	luas_tanah_bukan_milik,	sk_pendirian,	tanggal_sk_pendirian,	id_status_milik,	nama_status_milik,	status_perguruan_tinggi,	sk_izin_operasional,	tanggal_izin_operasional)values('$value->id_perguruan_tinggi',	'$value->kode_perguruan_tinggi',	'$value->nama_perguruan_tinggi',	'$value->telepon',	'$value->faximile',	'$value->email',	'$value->website',	'$value->jalan',	'$value->dusun',	'$value->rt_rw',	'$value->kelurahan',	'$value->kode_pos',	'$value->id_wilayah',	'$value->nama_wilayah',	'$value->lintang_bujur',	'$value->bank',	'$value->unit_cabang',	'$value->nomor_rekening',	'$value->mbs',	'$value->luas_tanah_milik',	'$value->luas_tanah_bukan_milik',	'$value->sk_pendirian',	'$value->tanggal_sk_pendirian',	'$value->id_status_milik',	'$value->nama_status_milik',	'$value->status_perguruan_tinggi',	'$value->sk_izin_operasional',	'$value->tanggal_izin_operasional')";
			if($cn->query($sql)===true){
			header("location:index.php?sub=profilePT");
			}else{
				echo "Gagal mengambil data profile PT  :".$cn->error;
			}
		}
	}
}else{
	echo $cn->error;
}
 ?>


 