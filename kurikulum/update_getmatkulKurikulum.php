 <?php
       		session_start();       		
       		require_once("../config/koneksi.php");
       		require_once("../config.php");
       		if(isset($_GET['idkur'])){
       		$sub=$_GET['idkur'];
       		$token=$_SESSION['token'];
       		$data2 =["act"=>"GetMatkulKurikulum","token"=>$token,"filter"=>"id_kurikulum='$sub'","limit"=>""];
	        $result2=json_decode(runWS($data2));
	        print_r($result2);
	    	if($result2->error_code==0){
	        	foreach ($result2->data as $res3) {
	        	  $id_kurikulum				=mysqli_real_escape_string($cn,$res3->id_kurikulum);
	              $nama_kurikulum			=mysqli_real_escape_string($cn,$res3->nama_kurikulum);
	              $id_matkul 				=mysqli_real_escape_string($cn,$res3->id_matkul);
	              $kode_mata_kuliah 		=mysqli_real_escape_string($cn,$res3->kode_mata_kuliah);
	              $nama_mata_kuliah			=mysqli_real_escape_string($cn,$res3->nama_mata_kuliah);
	              $id_prodi 			 	=mysqli_real_escape_string($cn,$res3->id_prodi);
	              $nama_program_studi		=mysqli_real_escape_string($cn,$res3->nama_program_studi);
	              $semester 		 		=mysqli_real_escape_string($cn,$res3->semester);
	              $id_semester 		 		=mysqli_real_escape_string($cn,$res3->id_semester);
	              $semester_mulai_berlaku	=mysqli_real_escape_string($cn,$res3->semester_mulai_berlaku);
	              $sks_mata_kuliah	 		=mysqli_real_escape_string($cn,$res3->sks_mata_kuliah);
	              $sks_tatap_muka	 		=mysqli_real_escape_string($cn,$res3->sks_tatap_muka);
	              $sks_praktek 		 		=mysqli_real_escape_string($cn,$res3->sks_praktek);
	              $sks_praktek_lapangan		=mysqli_real_escape_string($cn,$res3->sks_praktek_lapangan);
	              $sks_simulasi		 		=mysqli_real_escape_string($cn,$res3->sks_simulasi);
	              $apakah_wajib		 		=mysqli_real_escape_string($cn,$res3->apakah_wajib);
	              $sql="insert into GetMatkulKurikulum(id_kurikulum,nama_kurikulum,id_matkul,kode_mata_kuliah,nama_mata_kuliah,id_prodi,nama_program_studi,semester,id_semester,semester_mulai_berlaku,sks_mata_kuliah,sks_tatap_muka,sks_praktek,sks_praktek_lapangan,sks_simulasi,apakah_wajib) values('$id_kurikulum','$nama_kurikulum','$id_matkul','$kode_mata_kuliah','$nama_mata_kuliah','$id_prodi','$nama_program_studi','$semester','$id_semester','$semester_mulai_berlaku','$sks_mata_kuliah','$sks_tatap_muka','$sks_praktek','$sks_praktek_lapangan','$sks_simulasi','$apakah_wajib')";
	              $res=$cn->query($sql);
	              if(!$res){
	              	echo "<br> ada kesalahan proses ambil data dari feeder ".$cn->error;
	              }
	        		
	        	}
	        }
	        }
?>
<script type="text/javascript">
	window.history.back();
</script>

