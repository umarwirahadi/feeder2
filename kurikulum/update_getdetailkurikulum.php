 <?php
        session_start();
        $token=$_SESSION['token'];
        require_once("../config/koneksi.php");
        require_once("../config.php");
		$data2 =["act"=>"GetDetailKurikulum","token"=>$token,"filter"=>"","limit"=>""];
	    $result2=json_decode(runWS($data2));	   
        if($result2->error_code==0){
        	foreach ($result2->data as $res3) {
        	  $id_kurikulum				=mysqli_real_escape_string($cn,$res3->id_kurikulum);
              $nama_kurikulum			=mysqli_real_escape_string($cn,$res3->nama_kurikulum);
              $id_prodi 				=mysqli_real_escape_string($cn,$res3->id_prodi);
              $nama_program_studi		=mysqli_real_escape_string($cn,$res3->nama_program_studi);
              $id_semester 				=mysqli_real_escape_string($cn,$res3->id_semester);
              $semester_mulai_berlaku 	=mysqli_real_escape_string($cn,$res3->semester_mulai_berlaku);
              $jumlah_sks_lulus			=mysqli_real_escape_string($cn,$res3->jumlah_sks_lulus);
              $jumlah_sks_wajib 		=mysqli_real_escape_string($cn,$res3->jumlah_sks_wajib);
              $jumlah_sks_pilihan 		=mysqli_real_escape_string($cn,$res3->jumlah_sks_pilihan);
              $sqlcari="select * from GetDetailKurikulum where id_kurikulum='$id_kurikulum'";
              if($res1=$cn->query($sqlcari)){
              if ($res1->num_rows==0) {
              		$sql="insert into GetDetailKurikulum(id_kurikulum,nama_kurikulum,id_prodi,nama_program_studi,id_semester,semester_mulai_berlaku,jumlah_sks_lulus,jumlah_sks_wajib,jumlah_sks_pilihan) values('$id_kurikulum','$nama_kurikulum','$id_prodi','$nama_program_studi','$id_semester','$semester_mulai_berlaku','$jumlah_sks_lulus','$jumlah_sks_wajib','$jumlah_sks_pilihan')";
              		$cn->query($sql);
              	}else{
              		$sql="update GetDetailKurikulum set nama_kurikulum=' $nama_kurikulum',id_prodi='$id_prodi',nama_program_studi='$nama_program_studi',id_semester='$id_semester',semester_mulai_berlaku='$semester_mulai_berlaku',jumlah_sks_lulus='$jumlah_sks_lulus',jumlah_sks_wajib='$jumlah_sks_wajib',jumlah_sks_pilihan='$jumlah_sks_pilihan' where id_kurikulum='$id_kurikulum')";
              		$cn->query($sql);
              	}	
              }        		
        	}
        }
header("location:../index.php?sub=Kurikulum")
?>