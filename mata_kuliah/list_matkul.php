<?php 
if(isset($_GET['submatkul'])){
	$submatkul=$_GET['submatkul'];
	if ($submatkul=='viewmk') {
		require_once('view_mk.php');
		// echo "hi selamat datang";
	}
}else{
 ?>
<div class="row">
			<div class="col-md-6">
				<a href="mata_kuliah/download_matkul.php" class="label label-info">1. Download contoh Mata Kuliah *.xls</a>
				<form action="" method="post" enctype="multipart/form-data">
					<input type="file" name="filematkul" accept=".xls"  class="btn btn-xs btn-danger" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success" value="2. Upload" />
				</form>
					<?php
					if(isset($_POST['submit'])){
						require_once("excel_reader2.php");
						$nama1 		= 	$_FILES['filematkul']['tmp_name'];
						$data = new  Spreadsheet_Excel_Reader($nama1);
						$row=$data->rowcount($sheet_index=0);
							for($i=2;$i<=$row;$i++){                                
                                $kode_mata_kuliah           =$data->val($i,1);                              
                                $nama_mata_kuliah           =$cn->real_escape_string($data->val($i,2));
                                $nama_program_studi         =$data->val($i,3);
                                $jenjang                    =$data->val($i,4);
                                $id_jenis_mata_kuliah       =$data->val($i,5);
                                $id_kelompok_mata_kuliah    =$data->val($i,6);
                                $sks_mata_kuliah            =$data->val($i,7);
                                $sks_tatap_muka             =$data->val($i,8);
                                $sks_praktek                =$data->val($i,9);
                                $sks_praktek_lapangan       =$data->val($i,10);
                                $sks_simulasi               =$data->val($i,11);
                                $metode_kuliah              =$data->val($i,12);
                                $ada_sap                    =$data->val($i,13);
                                $ada_silabus                =$data->val($i,14);
                                $ada_bahan_ajar             =$data->val($i,15);
                                $ada_acara_praktek          =$data->val($i,16);
                                $ada_diktat                 =$data->val($i,17);
                                $tanggal_mulai_efektif      =$data->val($i,18);
                                $tanggal_akhir_efektif      =$data->val($i,19);                                
								$sql ="insert into InsertMataKuliah (kode_mata_kuliah,nama_mata_kuliah,nama_program_studi,jenjang,id_jenis_mata_kuliah,id_kelompok_mata_kuliah,sks_mata_kuliah,sks_tatap_muka,sks_praktek,sks_praktek_lapangan,sks_simulasi,metode_kuliah,ada_sap,ada_silabus,ada_bahan_ajar,ada_acara_praktek,ada_diktat,tanggal_mulai_efektif,tanggal_akhir_efektif,deskripsi,kode_error,status) values('$kode_mata_kuliah','$nama_mata_kuliah','$nama_program_studi','$jenjang','$id_jenis_mata_kuliah','$id_kelompok_mata_kuliah','$sks_mata_kuliah','$sks_tatap_muka','$sks_praktek','$sks_praktek_lapangan','$sks_simulasi','$metode_kuliah','$ada_sap','$ada_silabus','$ada_bahan_ajar','$ada_acara_praktek','$ada_diktat','$tanggal_mulai_efektif','$tanggal_akhir_efektif','','','0')";
                                if($cn->query($sql)){

                                }
                                else{
                                	echo $cn->error;
                                }
							} //end for
									
					}//end if empty
								?>
							<button class="btn btn-xs btn-success" id="valid_mk"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
							<button class="btn btn-xs btn-info" id="import_feeder_mk"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
							<button class="btn btn-xs btn-primary" onclick="location.href='index.php?sub=matkul&submatkul=viewmk'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5. View Mata Kuliah</button>
							<button class="btn btn-xs btn-warning" onclick="window.history.back()"><span class="glyphicon glyphicon-circle-arrow-left"></span> 6.Back</button>


		 	</div> <!-- end mcol-md-6 -->
		 	<div class="col-md-6">
		 		<form action="">
				<div class="input-group">
					<input type="text" name="cari_matkul" class="form-control" id="cari_matkul" placeholder="ketik nama mata kuliah" />
					<div class="input-group-btn">
						<button type="submit" name="submit" id="submitcari" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
				</form>
		 	</div>
</div>
<br>
<div class="panel panel-default">
  <div class="panel-heading">.:Data Mata Kuliah:.</div>
  <div class="panel-body">
<div class="table-responsive" style="height: 350px">
	<div id="hasil_cari">
	<table class="table table-bordered">
		<tr>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>sks_mata_kuliah</td>
			<td>nama_program_studi</td>
			<td>jenjang</td>
			<td>id_jenis_mata_kuliah</td>
			<td>id_kelompok_mata_kuliah</td>
			<td>Deskripsi</td>
			<td>Opsi</td>
		</tr>
			<?php
                $color1="#88EB88";				
                $color2="white";	
				$result1=$cn->query("select * from insertmatakuliah");
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) {
                        if($result["id_prodi"]==''){
						echo "<tr bgcolor='".$color1."'>";
					}else{
						echo "<tr bgcolor='".$color2."'>";
					}   
						?>						
								<td ><?php echo $result["kode_mata_kuliah"]; ?></td>
								<td ><?php echo $result["nama_mata_kuliah"]; ?></td>
								<td ><?php echo $result["sks_mata_kuliah"]; ?></td>
								<td ><?php echo $result["nama_program_studi"]; ?></td>
								<td ><?php echo $result["jenjang"]; ?></td>
								<td ><?php echo $result["id_jenis_mata_kuliah"]; ?></td>
								<td ><?php echo $result["id_kelompok_mata_kuliah"]; ?></td>
								<td ><?php echo $result["deskripsi"]; ?></td>
								<td ><a href="#" class="btn btn-xs btn-success">Edit Data</a> | <a href="#" class="btn btn-xs btn-danger">Hapus</a></td>
							</tr>

						<?php
							}
					}else {//else jika tidak ada data history
								echo '<tr><td colspan="22">No data</td></tr>';
							}
					?>
	</table>
</div>
</div><!-- end table responsive-->
</div>
</div>
<div id="hasildata">

</div>
<?php 
}
?>
<script>
	$(document).ready(function(){
		$("#update-from-feeder-mk").click(function(){
			$("#hasildata").load("piksi/../mata_kuliah/update_from_feeder.php");
		});
        
        $("#valid_mk").click(function(){
            window.location.href='mata_kuliah/validasi_mk.php';
        });

        $("#import_feeder_mk").click(function(){
        	window.location.href='mata_kuliah/Import_mk.php';
        })

$("#submitcari").click(function(event){
event.preventDefault();
	pencarian();
})

	$("#cari_matkul").keyup(function(event){
		pencarian();
	});

function pencarian(){
	var namamk=$('#cari_matkul').val();
	$.ajax({
		url:'mata_kuliah/cari_mk.php',
		data:'namamk='+namamk,
		success:function(data){
			$('#hasil_cari').html(data);
		}
	});
}

	});

</script>
