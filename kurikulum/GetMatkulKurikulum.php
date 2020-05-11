 <button class="btn btn-sm btn-danger" onclick="window.history.back()">1. Back</button>
 <button class="btn btn-sm btn-primary" id="ck1">2. Update Matkul Kurikulum</button>
 <a href="kurikulum/export.php?idkurikulum=<?php echo $sub;?>" class="btn btn-sm btn-info" >3. Import Kurikulum</a>
 <a href="kurikulum/export.php?idkurikulum=<?php echo $sub;?>" class="btn btn-sm btn-danger" >4. Export Kurikulum</a>
 <div class=""></div>
 <p>
 <div class="table table-responsive" style="height: 500px" id="loading">
 <table class="table table-bordered" >
 	<tr>
 		<td>No</td>
 		<td>Nama Kurikulum</td>
 		<td>kode Matkul</td>
 		<td>Nama Matkul</td>
 		<td>Nama Prodi</td>
 		<td>Semester</td>
 		<td>ID Semester</td>
 		<td>Smt. Mulai Berlaku</td>
 		<td>SKS Matkul</td>
 		<td>SKS Tatap Muka</td>
 		<td>SKS Praktek</td>
 		<td>SKS Praktek Lap</td>
 		<td>SKS Simulasi</td>
 		<td>Wajib/Pilihan</td>
 	</tr>
 <?php
        
        $sql1="select * from GetMatkulKurikulum where id_kurikulum='$sub'";
        $res1=$cn->query($sql1);
        if ($res1->num_rows>=1) {	       
    		$no=1;
    		while ($res4=$res1->fetch_assoc()){
    			?>
    			<tr>
    				<td><?php echo $no; ?></td>
    				<td><?php echo $res4["nama_kurikulum"]; ?></td>
    				<td><?php echo $res4["kode_mata_kuliah"]; ?></td>
    				<td><?php echo $res4["nama_mata_kuliah"]; ?></td>
    				<td><?php echo $res4["nama_program_studi"]; ?></td>
    				<td><?php echo $res4["semester"]; ?></td>
    				<td><?php echo $res4["id_semester"]; ?></td>
    				<td><?php echo $res4["semester_mulai_berlaku"]; ?></td>
    				<td><?php echo $res4["sks_mata_kuliah"]; ?></td>
    				<td><?php echo $res4["sks_tatap_muka"]; ?></td>
    				<td><?php echo $res4["sks_praktek"]; ?></td>
    				<td><?php echo $res4["sks_praktek_lapangan"]; ?></td>
    				<td><?php echo $res4["sks_simulasi"]; ?></td>
    				<td><?php echo $res4["apakah_wajib"]; ?></td>
    			</tr>
    			<?php
    		$no++;
    		}
    	}
    		else{
    			?>
    			<tr>
    				<td colspan="14">No record</td>
    			</tr>
    			<?php
    		}      // header("location:../index.php?sub=Kurikulum")
?>
 </table>	
 </div>
 <script type="text/javascript">
$(document).ready(function(){
	$("#ck1").click(function(){
		// window.location.href="kurikulum/update_getmatkulkurikulum.php";
		var id_kurikulum='<?php echo $sub ?>';
		$.ajax({
			url:'kurikulum/update_getmatkulkurikulum.php',
			data:'idkur='+id_kurikulum,
			beforeSend:function(data){
				$("#loading").html("<img id='gbrload' src='piksi/../assets/loading13.gif' />");
			},
			success:function(data){
				$("#gbrload").remove();
				alert("Data Berhasil diupdate dari Feeder..!");
			}
		});
	});


});

 </script>