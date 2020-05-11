<div class="container">
	<div class="well well-xs">
		<div class="row">
			<div class="col-md-6">
				<a href="mahasiswa/download_mahasiswa.php" class="label label-info">1. Download contoh *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="fileMhs" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="2. Upload" />
					<span id="loadingg"></span><button class="btn btn-xs btn-success" onclick="location.href='mahasiswa/validasi_mahasiswa.php'"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
				<span id="loadingimportfeeder"></span><a href='piksi/../mahasiswa/import_mahasiswa_history_pendidikan.php' class="btn btn-xs btn-info" id="import_feeder"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</a>
				<button class="btn btn-xs btn-danger" onclick="location.href='piksi/../mahasiswa/delete_all_record.php'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5. Delete All</button>
				<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=list_mahasiswa'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 6. Back</button>				</form>
		 	</div>
		 	<div class="col-md-4">
		 		<?php 
					if(isset($_POST['submit'])){
						require_once("excel_reader2.php");
						$nama 		= basename($_FILES['fileMhs']['name']);
						$nama1 		= $_FILES['fileMhs']['name'];
						$x 			= explode('.', $nama);
						$ekstensi 	= strtolower(end($x));
						$size 		=ceil(($_FILES['fileMhs']['size'])/1024)."kb";
						move_uploaded_file($_FILES['fileMhs']['tmp_name'],$nama);
						chmod($_FILES['fileMhs']['name'],0777);
						?>
<?php
$data = new  Spreadsheet_Excel_Reader($nama1);
$row=$data->rowcount($sheet_index=0);
echo "jumlah ada ada : ".$row;
// $sql="";
for($i=2;$i<=$row;$i++){
	$NPM 								=$cn->real_escape_string($data->val($i,1));
	$nama_mahasiswa 					=$cn->real_escape_string($data->val($i,2));
	$tempat_lahir 						=$cn->real_escape_string($data->val($i,3));
	$tanggal_lahir 						=$cn->real_escape_string($data->val($i,4));
	$jenis_kelamin 						=$cn->real_escape_string($data->val($i,5));
	$id_agama 							=$cn->real_escape_string($data->val($i,6));
	$nik 								=$cn->real_escape_string($data->val($i,7));
	$kewarganegaraan 					=$cn->real_escape_string($data->val($i,8));
	$jalan 								=$cn->real_escape_string($data->val($i,9));
	$dusun 								=$cn->real_escape_string($data->val($i,10));
	$rt 								=$cn->real_escape_string($data->val($i,11));
	$rw 								=$cn->real_escape_string($data->val($i,12));
	$kelurahan 							=$cn->real_escape_string($data->val($i,13));
	$kode_pos 							=$cn->real_escape_string($data->val($i,14));
	$id_wilayah 						=$cn->real_escape_string($data->val($i,15));
	$handphone 							=$cn->real_escape_string($data->val($i,16));
	$email 								=$cn->real_escape_string($data->val($i,17));
	$penerima_kps 						=$cn->real_escape_string($data->val($i,18));
	$nomor_kps 							=$cn->real_escape_string($data->val($i,19));
	$nama_ayah 							=$cn->real_escape_string($data->val($i,20));
	$nama_ibu_kandung 					=$cn->real_escape_string($data->val($i,21));
	$id_jenis_daftar 					=$cn->real_escape_string($data->val($i,22));
	$id_jalur_daftar 					=$cn->real_escape_string($data->val($i,23));
	$id_periode_masuk 					=$cn->real_escape_string($data->val($i,24));
	$jenjang 							=$cn->real_escape_string($data->val($i,25));
	$nama_Prodi							=$cn->real_escape_string($data->val($i,26));
	$sks_diakui							=$cn->real_escape_string($data->val($i,27));
	$nama_perguruan_tinggi_asal			=$cn->real_escape_string($data->val($i,28));
	$nama_prodi_asal 					=$cn->real_escape_string($data->val($i,29));
	$id_pembayaran					 	=$cn->real_escape_string($data->val($i,30));
	$tanggal_daftar					 	=$cn->real_escape_string($data->val($i,31));
	 			
$sql="insert into mahasiswa (NPM,nama_mahasiswa,tempat_lahir,tanggal_lahir,jenis_kelamin,id_agama,nik,kewarganegaraan,jalan,dusun,rt,rw,kelurahan,kode_pos,id_wilayah,handphone,email,penerima_kps,nomor_kps,nama_ayah,id_pendidikan_ayah,id_pekerjaan_ayah,id_penghasilan_ayah,nama_ibu_kandung,id_pendidikan_ibu,id_pekerjaan_ibu,id_penghasilan_ibu,id_kebutuhan_khusus_mahasiswa,id_kebutuhan_khusus_ayah,id_kebutuhan_khusus_ibu,id_jenis_daftar,id_jalur_daftar,id_periode_masuk,jenjang,nama_prodi,sks_diakui,nama_perguruan_tinggi_asal,nama_prodi_asal,id_pembayaran,status,tanggal_daftar) values('$NPM','$nama_mahasiswa','$tempat_lahir','$tanggal_lahir','$jenis_kelamin','$id_agama','$nik','$kewarganegaraan','$jalan','$dusun','$rt','$rw','$kelurahan','$kode_pos','$id_wilayah','$handphone','$email','$penerima_kps','$nomor_kps','$nama_ayah','0','0','0','$nama_ibu_kandung','0','0','0','0','0','0','$id_jenis_daftar','$id_jalur_daftar','$id_periode_masuk','$jenjang','$nama_Prodi','$sks_diakui','$nama_perguruan_tinggi_asal','$nama_prodi_asal','$id_pembayaran','0','$tanggal_daftar')";
$cn->query($sql);
echo $cn->error;
}
}
 ?>
			</div>
			<div>
				<!-- <span id="loadingg"></span><button class="btn btn-xs btn-success" onclick="location.href='mahasiswa/validasi_mahasiswa.php'"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button><button class="btn btn-xs btn-success" id="valid_mhs" onclick="location.href='mahasiswa/validasi_mahasiswa.php'"><span class="glyphicon glyphicon-check"></span> Validasi</button>
				<span id="loadingimportfeeder"></span><a href='piksi/../mahasiswa/import_mahasiswa_history_pendidikan.php' class="btn btn-xs btn-info" id="import_feeder"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</a>
				<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=list_mahasiswa'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5. Back</button> -->
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
			<th>tempat_lahir</th>
			<th>tanggal_lahir</th>
			<th>jenis_kelamin</th>
			<th>id_agama</th>
			<th>nik</th>
			<th>kewarganegaraan</th>
			<th>jalan</th>
			<th>dusun</th>
			<th>rt</th>
			<th>rw</th>
			<th>kelurahan</th>
			<th>kode_pos</th>
			<th>id_wilayah</th>
			<th>handphone</th>
			<th>email</th>
			<th>penerima_kps</th>
			<th>nomor_kps</th>
			<th>nama_ayah</th>
			<th>nama_ibu_kandung</th>
			<th>Deskripsi</th>
			
		</tr>
			<?php 
			$color1="#88EB88";				
			$color2="white";				
				
				$result1=$cn->query("select * from mahasiswa");
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
					<td><?php echo $result["npm"]; ?></td>
					<td><?php echo $result["nama_mahasiswa"]; ?></td>
					<td><?php echo $result["tempat_lahir"]; ?></td>
					<td><?php echo $result["tanggal_lahir"]; ?></td>
					<td><?php echo $result["jenis_kelamin"]; ?></td>
					<td><?php echo $result["id_agama"]; ?></td>
					<td><?php echo $result["nik"]; ?></td>
					<td><?php echo $result["kewarganegaraan"]; ?></td>
					<td><?php echo $result["jalan"]; ?></td>
					<td><?php echo $result["dusun"]; ?></td>
					<td><?php echo $result["rt"]; ?></td>
					<td><?php echo $result["rw"]; ?></td>
					<td><?php echo $result["kelurahan"]; ?></td>
					<td><?php echo $result["kode_pos"]; ?></td>
					<td><?php echo $result["id_wilayah"]; ?></td>
					<td><?php echo $result["handphone"]; ?></td>
					<td><?php echo $result["email"]; ?></td>
					<td><?php echo $result["penerima_kps"]; ?></td>
					<td><?php echo $result["nomor_kps"]; ?></td>
					<td><?php echo $result["nama_ayah"]; ?></td>
					<td><?php echo $result["nama_ibu_kandung"]; ?></td>
					<td><?php echo $result["deskripsi"]; ?></td>		
					</tr>
				<?php
			}
		}else{
			echo "Data kosong";
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