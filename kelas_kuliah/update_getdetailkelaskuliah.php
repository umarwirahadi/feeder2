 <?php
       		session_start();       		
       		require_once("../config/koneksi.php");
       		require_once("../config.php");
       		$token=$_SESSION['token'];
       		$data2 =["act"=>"GetDetailKelasKuliah","token"=>$token,"filter"=>"","limit"=>""];
	        $result2=json_decode(runWS($data2));
	        if($result2->error_code==0){
	        	foreach ($result2->data as $res3) {
	        	  $id_kelas_kuliah 		 	=$res3->id_kelas_kuliah;
	              $id_prodi 				=$res3->id_prodi;
	        	  $nama_program_studi		=$res3->nama_program_studi;
	              $id_semester 				=$res3->id_semester;
	              $nama_semester			=$res3->nama_semester;
	              $id_matkul				=$res3->id_matkul;
	              $kode_mata_kuliah			=$res3->kode_mata_kuliah;	              
	              $nama_mata_kuliah 		=$res3->nama_mata_kuliah;
	              $nama_kelas_kuliah 		=$res3->nama_kelas_kuliah;
	              $bahasan 		 			=$res3->bahasan;
	              $tanggal_mulai_efektif	=$res3->tanggal_mulai_efektif;
	              $tanggal_akhir_efektif	=$res3->tanggal_akhir_efektif;	              
	              $sql2="select * from getdetailkelaskuliah where id_kelas_kuliah='$id_kelas_kuliah'";
	              if($resu=$cn->query($sql2)){
	              	if($resu->num_rows==0){
	              		$sql="insert into getdetailkelaskuliah(id_kelas_kuliah,id_prodi,nama_program_studi,id_semester,nama_semester,id_matkul,kode_mata_kuliah,nama_mata_kuliah,nama_kelas_kuliah,bahasan,tanggal_mulai_efektif,tanggal_akhir_efektif) values('$id_kelas_kuliah','$id_prodi','$nama_program_studi','$id_semester','$nama_semester','$id_matkul','$kode_mata_kuliah','$nama_mata_kuliah','$nama_kelas_kuliah','$bahasan','$tanggal_mulai_efektif','$tanggal_akhir_efektif')";
	              		$res=$cn->query($sql);		
	              	}else{
	              		$sqlupdate="update getdetailkelaskuliah set id_prodi='$id_prodi',nama_program_studi='$nama_program_studi',id_semester='$id_semester',nama_semester='$nama_semester',id_matkul='$id_matkul',kode_mata_kuliah='$kode_mata_kuliah',nama_mata_kuliah='$nama_mata_kuliah',nama_kelas_kuliah='$nama_kelas_kuliah',bahasan='$bahasan',tanggal_mulai_efektif='$tanggal_mulai_efektif',tanggal_akhir_efektif='$tanggal_akhir_efektif' where id_kelas_kuliah'$id_kelas_kuliah')";
	              		$res=$cn->query($sqlupdate);
	              	}
	              	}
	        	}
	        }
	        // }
?>
<script type="text/javascript">
	location.href='index.php?sub=kelaskuliah&sub2=subkelaskuliah';
</script>

