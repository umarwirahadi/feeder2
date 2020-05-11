<div class="container">
	<div class="well well-xs">
		<div class="row">
			<div class="col-md-6">
				<a href="mahasiswa/riwayat_pendidikan/download_template.php" class="label label-info">1. Download contoh *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="fileMhs" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="2. Upload" />
				</form>
		 	</div>
		 	<div class="col-md-12">
		 		<?php 
					if(isset($_POST['submit'])){
						require_once("excel_reader2.php");
						$nama1 		= $_FILES['fileMhs']['tmp_name'];
						if(!empty($nama1)){
$data = new  Spreadsheet_Excel_Reader($nama1);
$row=$data->rowcount($sheet_index=0);
for($i=2;$i<=$row;$i++){
	$nim 								=$data->val($i,1);
	$nama_mahasiswa 					=$cn->real_escape_string($data->val($i,2));
	$tempat_lahir 	 					=$data->val($i,3);
	$tgl_lahir		 					=$data->val($i,4);
	$nama_ibu 		 					=$cn->real_escape_string($data->val($i,5));
	$jenjang 							=$data->val($i,6);	
	$prodi 							 	=$data->val($i,7);	
	$id_jenis_daftar 					=$data->val($i,8);
	$id_jalur_daftar 					=$data->val($i,9);
	$id_periode_masuk 					=$data->val($i,10);
	$tanggal_daftar						=$data->val($i,11);
	$sks_diakui							=$data->val($i,12);
	$nama_pt_asal						=$data->val($i,13);
	$nama_prodi_asal 					=$data->val($i,14);
	$id_pembiayaan					 	=$data->val($i,15);	 			
$sql="insert into updateriwayatpendidikanmahasiswa (nim,nama_mahasiswa,tempat_lahir,tgl_lahir,nama_ibu,jenjang,prodi,id_jenis_daftar,id_jalur_daftar,id_periode_masuk,tanggal_daftar,sks_diakui,nama_pt_asal,nama_prodi_asal,id_pembiayaan,status) values('$nim','$nama_mahasiswa','$tempat_lahir','$tgl_lahir','$nama_ibu','$jenjang','$prodi','$id_jenis_daftar','$id_jalur_daftar','$id_periode_masuk','$tanggal_daftar','$sks_diakui','$nama_pt_asal','$nama_prodi_asal','$id_pembiayaan','0')";
$cn->query($sql);
}
}
}
 ?>
				<a class="btn btn-xs btn-success" href="../piksi/mahasiswa/validasi_riwayat_pendidikan.php"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
				<a href='piksi/../mahasiswa/update_history_pendidikan.php' class="btn btn-xs btn-primary" id="import_feeder"><span class="glyphicon glyphicon-paperclip"></span> 4. Update History Pendidikan</a>
				<a href='piksi/../mahasiswa/delete_update_histori_pendidikan.php' class="btn btn-xs btn-danger" id="import_feeder"><span class="glyphicon glyphicon-paperclip"></span> 5. Delete All</a>
				<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=list_mahasiswa'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 6. Back</button>
		 	</div>
		 </div>
	</div>
</div>
<div class="table-responsive" style="height: 350px">
	<table class="table table-bordered tbmhs">
		<tr class="table table-fixed">
			<th width="100px">Aksi</th>
			<th>no</th>
			<th>NPM</th>
			<th>nama_mahasiswa</th>
			<th>jenjang</th>
			<th>prodi</th>
			<th>id_jalur_daftar</th>
			<th>id_periode_masuk</th>
			<th>tanggal_daftar</th>
			<th>sks_diakui</th>
			<th>kampus_asal</th>
			<th>prodi_asal</th>
			<th>id_pembayaran</th>
			<th>deskripsi</th>			
		</tr>
			<?php 
			$color1="#88EB88";				
			$color2="white";				
				
				$result1=$cn->query("select * from updateriwayatpendidikanmahasiswa");
			if($result1->num_rows>0){

			while ($result=$result1->fetch_assoc()) { 
				if($result["id_mahasiswa"]==''){
						echo "<tr bgcolor='".$color1."'>";
					}else{
						echo "<tr bgcolor='".$color2."'>";
					}
				?>	
					<td width="100px"> <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-pencil"></i></button>  | <a href="mahasiswa/delete_permahasiswa.php?id=<?php echo $result['no'];?>" class="btn btn-xs btn-danger" ><i class="glyphicon glyphicon-trash"></i></a></td>
					<td><?php echo $result["no"]; ?></td>
					<td><?php echo $result["nim"]; ?></td>
					<td><?php echo $result["nama_mahasiswa"]; ?></td>
					<td><?php echo $result["jenjang"]; ?></td>
					<td><?php echo $result["prodi"]; ?></td>
					<td><?php echo $result["id_jalur_daftar"]; ?></td>
					<td><?php echo $result["id_periode_masuk"]; ?></td>
					<td><?php echo $result["tanggal_daftar"]; ?></td>
					<td><?php echo $result["sks_diakui"]; ?></td>
					<td><?php echo $result["nama_pt_asal"]; ?></td>
					<td><?php echo $result["nama_prodi_asal"]; ?></td>
					<td><?php echo $result["id_pembiayaan"]; ?></td>
					<td><?php echo $result["desk"]; ?></td>		
					</tr>
				<?php
			}
		}else{
			?>
			<tr>
				<td colspan="20">No Record</td>
			</tr>
			<?php			
		}
					?>
			</table>
		</div>
<div id="hasildata">
	
</div>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit data Mahasiswa</h4>
      </div>
      <div class="modal-body" id="isidata">
            <form action="mahasiswa/edit_mahasiswa.php" method="post" class="form-group">
	        <div class="input-group">
	        	<span class="input-group-addon">NPM</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Nama </span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Tempat Lahir </span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">tanggal Lahir </span><input type="date" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Jenis Kel</span>
	        	<select name="jk" class="form-control">
	        			<option value="L">L</option>
	        			<option value="L">P</option>	        			
	        		</select>
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Agama</span>
	        	<select name="agama" class="form-control">
		        <?php 
		        if($data=$cn->query("select * from tb_agama order by id_agama")){		        	
		        while($data1=$data->fetch_assoc()){
		        	?>
		        	<option value="<?php echo $data1['id_agama'];?>"><?php echo $data1['nama_agama'];?></option>	
		        	<?php }
		        }
		        ?>
	        	</select>
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">NIK</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">NISN</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">NPWP</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Kewarganegaraan</span><input type="text" name="npm" class="form-control form-xs" value="">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Jalan</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Dusun</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">RT</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">RW</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Kelurahan</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Kode POS</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Wilayah</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Jenis Tinggal</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Transportasi</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Telp</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">HP</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Email</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Penerima KPS</span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Nama </span><input type="text" name="npm" class="form-control form-xs">
	        </div>
			<div class="input-group">
	        	<span class="input-group-addon">Nama </span><input type="text" name="npm" class="form-control form-xs">
	        </div>
	        <div class="input-group">
	        	<span class="input-group-addon">Nama </span><input type="text" name="npm" class="form-control form-xs">
	        </div>

	        <div class="modal-footer">
		        <button type="submit" class="btn btn-primary" data-dismiss="modal">Edit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      	</div>
	        </form>        
      </div>      
    </div>

  </div>
</div>



<script>
	$(document).ready(function(){
		$("#valid_mhs").click(function(){
			// $("#hasildata").load("piksi/../mahasiswa/validasi_mahasiswa.php");

			$.ajax({
				url:'piksi/../mahasiswa/validasi_mahasiswa.php',
				type:'POST',
				beforeSend:function(){
					$('#loadingg').html("<img src='piksi/../assets/loading13.gif' />");
				},
				success:function(data){
					$('#loadingg').html(data);
				}
			});
		});
	$("#import_feeder").click(function(){
			$.ajax({
				url:'piksi/../mahasiswa/import_mahasiswa_history_pendidikan.php',
				type:'POST',
				beforeSend:function(){
					$('#loadingimportfeeder').html("<img src='piksi/../assets/loading13.gif' />");
				},
				success:function(data){
					$('#hasildata').html(data);
				}
			});
	});
	});

</script>