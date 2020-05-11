 <?php
       		session_start();       		
       		require_once("../config/koneksi.php");
       		require_once("../config.php");
       		$token=$_SESSION['token'];
       		$data2 =["act"=>"GetMatkulKurikulum","token"=>$token,"filter"=>"","limit"=>""];
	        $result2=json_decode(runWS($data2));
	        // print_r($result2);
	    	if($result2->error_code==0){
	        	foreach ($result2->data as $res3) {
	        	  $id_kurikulum				=$res3->id_kurikulum;
	              $nama_kurikulum			=$res3->nama_kurikulum;
	              $id_matkul 				=$res3->id_matkul;
	              $kode_mata_kuliah 		=$res3->kode_mata_kuliah;
	              $nama_mata_kuliah			=mysqli_real_escape_string($cn,$res3->nama_mata_kuliah);
	              $id_prodi 			 	=$res3->id_prodi;
	              $nama_program_studi		=$res3->nama_program_studi;
	              $semester 		 		=$res3->semester;
	              $id_semester 		 		=$res3->id_semester;
	              $semester_mulai_berlaku	=$res3->semester_mulai_berlaku;
	              $sks_mata_kuliah	 		=$res3->sks_mata_kuliah;
	              $sks_tatap_muka	 		=$res3->sks_tatap_muka;
	              $sks_praktek 		 		=$res3->sks_praktek;
	              $sks_praktek_lapangan		=$res3->sks_praktek_lapangan;
	              $sks_simulasi		 		=$res3->sks_simulasi;
	              $apakah_wajib		 		=$res3->apakah_wajib;
	              $sql="insert into GetMatkulKurikulum (id_kurikulum,nama_kurikulum,id_matkul,kode_mata_kuliah,nama_mata_kuliah,id_prodi,nama_program_studi,semester,id_semester,semester_mulai_berlaku,sks_mata_kuliah,sks_tatap_muka,sks_praktek,sks_praktek_lapangan,sks_simulasi,apakah_wajib) values('$id_kurikulum','$nama_kurikulum','$id_matkul','$kode_mata_kuliah','$nama_mata_kuliah','$id_prodi','$nama_program_studi','$semester','$id_semester','$semester_mulai_berlaku','$sks_mata_kuliah','$sks_tatap_muka','$sks_praktek','$sks_praktek_lapangan','$sks_simulasi','$apakah_wajib')";
	              $res=$cn->query($sql);
	              if(!$res){
	              	echo "<br> ada kesalahan proses ambil data dari feeder ".$cn->error;
	              }
	        		
	        	}
	        }
	        header("location:../index.php?sub=Kurikulum");
?>