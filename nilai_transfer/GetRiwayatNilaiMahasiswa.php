<div class="row">
 	<div class="col-md-1"> 		
 		<button type="button" onclick="window.history.back();" class="btn btn-sm btn-danger">Back</button>
 	</div>
 	<div class="col-md-11">
 		<form action="" method="post">
 		 <div class="input-group"> 			
 			<span class="input-group-addon" id="basic-addon1">Cari berdasarkan NPM/NIM</span>
 			<input type="text" name="NIM" class="form-control" aria-describedby="sizing-addon1">
 			<span class="input-group-btn">
		        <button class="btn btn-default" type="submit">Find</button>
		     </span>
 		</div>
 	</form>
 	</div>
 </div>
 <br>
<div class="panel panel-default">
  <div class="panel-heading">.:Data Nilai Mahasiswa sebelumnya :.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered ">
		<tr class="xs">
			<td>nim</td>
			<td>nama_mahasiswa</td>
			<td>angkatan</td>
			<td>nama_program_studi</td>
			<td>id_periode</td>
			<td>nama_mata_kuliah</td>
			<td>id_matkul</td>
			<td>id_kelas</td>
			<td>nama_kelas_kuliah</td>
			<td>sks_mata_kuliah</td>
			<td>nilai_angka</td>
			<td>nilai_huruf</td>
			<td>nilai_indeks</td>			
		</tr>
			<?php				
				if(!empty($_POST['NIM'])){
				$token=$_SESSION['token'];
				$act 		="GetRiwayatNilaiMahasiswa";
				$nim 		=$_POST['NIM'];
				$filter		="nim='$nim'";
				$order 		="";
				$limit 		="";
				$offset 	="";
				$ws=array("act"=>$act,
							"token"=>$token,
							"filter"=>$filter,
							"order"=>$order,
							"limit"=>$limit,
							"offset"=>$offset);
				$hasil=json_decode(RunWS($ws));
				foreach ($hasil->data as $key) {
					?>
					<tr>
						<td><?php echo $key->nim;?></td>
						<td><?php echo $key->nama_mahasiswa;?></td>
						<td><?php echo $key->angkatan;?></td>
						<td><?php echo $key->nama_program_studi;?></td>
						<td><?php echo $key->id_periode;?></td>
						<td><?php echo $key->nama_mata_kuliah;?></td>
						<td><?php echo $key->id_matkul;?></td>
						<td><?php echo $key->id_kelas;?></td>
						<td><?php echo $key->nama_kelas_kuliah;?></td>
						<td><?php echo $key->sks_mata_kuliah;?></td>
						<td><?php echo $key->nilai_angka;?></td>
						<td><?php echo $key->nilai_huruf;?></td>
						<td><?php echo $key->nilai_indeks;?></td>
					</tr>	
					<?php
				}


						}			
						?>							
								
							</tr>

				
	</table>
</div><!-- end table responsive-->
<div class="row">
	<div class="col-md-12">
		<button type="button" class="btn btn-xs btn-primary">Download excel</button>
	</div>
</div>
</div>
</div>