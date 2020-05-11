 	 	<div class="row">
			<div class="col-md-12">
				<button class="btn btn-xs btn-primary" id="getdetailperkuliahankelas" >1.Update KRS dari Feeder</button>
				<button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#myModal">2. Download KRS Mahasiswa</button>

		 	<!-- </div>
		 	<div class="col-md-6"> -->
		 		<!-- unuk Upload nilai -->
		 		<form action="" method="post" enctype="multipart/form-data">	
					<input type="file" name="nilaimhs" accept=".xls" />
					<input type="submit" name="submit" id="submit" class="btn btn-xs btn-success"  value="3. Upload Nilai" />
				</form>
				<button class="btn btn-xs btn-primary" onclick="location.href='kelas_kuliah/import_nilai.php'"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
				<br>
					<?php 
					if(isset($_POST['submit'])){
						require_once('excel_reader2.php');
						$klskuliah 		= 	$_FILES["nilaimhs"]["tmp_name"];
						if (!empty($klskuliah)){						
						$klskuliah1 = new  Spreadsheet_Excel_Reader($klskuliah);
						$row=$klskuliah1->rowcount($sheet_index=0);
							for($i=2;$i<=$row;$i++){								
								$id_semester 			=$klskuliah1->val($i,1);
								$nim					=$klskuliah1->val($i,2);
								$nama_mahasiswa 		=$klskuliah1->val($i,3);
								$kdmk 					=$klskuliah1->val($i,4);
								$nmmk 				 	=$klskuliah1->val($i,5);
								$nilai_angka 			=$klskuliah1->val($i,6);
								$nilai_indeks			=$klskuliah1->val($i,7);
								$nilai_huruf 			=$klskuliah1->val($i,8);
								$sql ="update GetDetailNilaiPerkuliahanKelas set nilai_angka='$nilai_angka',nilai_indeks='$nilai_indeks',nilai_huruf='$nilai_huruf' where id_semester='$id_semester' and nim='$nim' and kode_mata_kuliah='$kdmk' and nama_mata_kuliah='$nmmk'";
									$cn->query($sql);
											
							} //end for
							echo "<script>window.location.href='index.php?sub=nilaimhs';</script>";
						}//end if empty
					}
							?>

		 	</div>
</div>
<br>
<div class="panel panel-default">
<div class="panel-heading">
  	<div class="row">
  		<div class="col-md-6">
  			 .:Input Nilai Mahasiswa:.
  		</div>  	
	  	<!-- <div class="col-md-6">
	  		<div class="input-group">	  		
	  			<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span><input type="text" name="carikrs" id="carikrs" class="form-control" placeholder="pencarian Nilai Mahasiswa" />
	  		</div>
	  	</div> -->
  	</div>
</div>
  <div class="panel-body"> 
<div class="table-responsive" style="height: 350px" id="waiting">
	<table class="table table-bordered">
		<tr>
			<td>id_semester</td>
			<td>kode_mata_kuliah</td>
			<td>nama_mata_kuliah</td>
			<td>nim</td>
			<td>nama_mahasiswa</td>
			<td>nilai_angka</td>
			<td>nilai_indeks</td>
			<td>nilai_huruf</td>
			<td>Option</td>
		</tr>
			<?php 
				$color1="white";
				$color2="#F584A4";
				if($result1=$cn->query("select * from getdetailnilaiperkuliahankelas order by nilai_indeks desc")){				
				if($result1->num_rows>0){
					while ($result=$result1->fetch_assoc()) {
						if(empty($result['nilai_huruf']) && $result['nilai_huruf']==""){
							echo "<tr bgcolor='".$color2."'>";
						}else{
							echo "<tr bgcolor='".$color1."'>";
						}
						?>						
							<td><?php echo $result['id_semester'];?></td>
							<td><?php echo $result['kode_mata_kuliah'];?></td>
							<td><?php echo $result['nama_mata_kuliah'];?></td>
							<td><?php echo $result['nim'];?></td>
							<td><?php echo $result['nama_mahasiswa'];?></td>
							<td><?php echo $result['nilai_angka'];?></td>
							<td><?php echo $result['nilai_indeks'];?></td>
							<td><?php echo $result['nilai_huruf'];?></td>
							<td><a href="../piksi/kelas_kuliah/hapus_peserta_kelas_kuliah.php?id_reg_mhs=<?php echo $result['id_registrasi_mahasiswa'];?>&id_kls=<?php echo $result['id_kelas_kuliah'];?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a></td>
						</tr>

						<?php
							}
					}else {//else jika tidak ada data history
								echo '<tr><td colspan="16">No data</td></tr>';
							}
					}
					// $cn->close();
					?>
	</table>

</div><!-- end table responsive-->
</div>
</div>
<div id="hasildata">
	
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Download KRS dari Feeder</h4>
          <h8 class="modal-title-danger">Jika Pilihan Kosong tekan F5/Reload pada Browser atau Tekan tombol No. 1</h8>
        </div>
        <div class="modal-body">            
          <form class="form-group" id="dnldkrs" action="kelas_kuliah/download2_krs.php" method="post"> 
          Pilih Semester
          <select class="form-control" id="id_semester" name="id_semester">        	
          	   <?php
          	   $sql6="select id_semester from GetDetailNilaiPerkuliahanKelas group by id_semester";
          		if($res_id_smt=$cn->query($sql6)){
          		if($res_id_smt->num_rows>0){
          			while ($row=$res_id_smt->fetch_assoc()) {
          			?>
          				<option value="<?php echo $row['id_semester'];?>"><?php echo $row['id_semester'];?></option>
          			<?php
          		}
          	}
          	}    		         		
          	 ?>
          </select>
		  Pilih Jurusan
          <select class="form-control" id="id_jurusan" name="id_jurusan">        	
          	   <?php
          	   $sql6="select id_prodi,nama_program_studi from GetDetailNilaiPerkuliahanKelas group by nama_program_studi";
          		if($res_id_smt=$cn->query($sql6)){
          		if($res_id_smt->num_rows>0){
          			while ($row=$res_id_smt->fetch_assoc()) {
          			?>
          				<option value="<?php echo $row['id_prodi'];?>"><?php echo $row['nama_program_studi'];?></option>
          			<?php
          		}
          	}
          	}    		         		
          	 ?>
          </select>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-md btn-primary" id="btndownload">Download File Excel</button>
          </form>
          <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <?php 
  $iputnilai=["act"=>"UpdateNilaiPerkuliahanKelas",]

   ?>
<script>
	$(document).ready(function(){

		$("#valid_mhs").click(function(){
			$("#hasildata").load("piksi/../history_pendidikan/validasi_feeder_history_mahasiswa.php");
		});

		$("#idtruncatekrs").click(function(){
			kosong_data()
		});
		function kosong_data(){
			if(confirm('Yakin data KRS Mahasiswa akan dikosongkan')==true){
				location.href='kelas_kuliah/truncate_getDetailNilaiPerkuliahanKelas.php';
			}
		}
		$("#subdelete").click(function(){
			if(confirm("yakin data yang tidak valid akan dihapus ?")==true){
				location.href='kelas_kuliah/delete_invalid_record.php';	
			}
		});
		$("#hpskrs").click(function(){
			var pesanhapus=confirm("yakin data KRS ini akan dihapus ?");
			if(pesanhapus==true){
				// window.href='kelas_kuliah/delete_krs_mhs.php';
				return true;
			}else{
				return false;
			}
		});
	$("#getdetailperkuliahankelas").click(function() {
		window.location.href='kelas_kuliah/update_getdetailnilaiPerkuliahanKelas.php';
	});
$("#dnlssdkrs").on("submit",function(e){
e.preventDefault();
var idsm=$("#id_semester").val();
var idjur=$("#id_jurusan").val();
$.ajax({
url:"kelas_kuliah/download2_krs.php",
data:"{'idsmt':'"+idsm+"','id_jurusan':'"+idjur+"'}",
success:function(data){
	alert(data);
}
});
});
});

</script>