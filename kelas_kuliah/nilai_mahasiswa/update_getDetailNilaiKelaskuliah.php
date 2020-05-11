 <?php
       		session_start();       		
       		require_once("../../config/koneksi.php");
       		require_once("../../config.php");
       		$token=$_SESSION['token'];
       		$data2 =["act"=>"GetDetailNilaiPerkuliahanKelas","token"=>$token,"filter"=>"","limit"=>""];
	        $result2=json_decode(runWS($data2));
	        print_r($result2);
	    	if($result2->error_code==0){
	        	foreach ($result2->data as $res3) {
	        	  	$id_program_studi	=mysqli_real_escape_string($cn,$res3->id_program_studi);
					$nama_program_studi	=mysqli_real_escape_string($cn,$res3->nama_program_studi);
					$id_semester	=mysqli_real_escape_string($cn,$res3->id_semester);
					$nama_semester	=mysqli_real_escape_string($cn,$res3->nama_semester);
					$id_matkul	=mysqli_real_escape_string($cn,$res3->id_matkul);
					$kode_mata_kuliah	=mysqli_real_escape_string($cn,$res3->kode_mata_kuliah);
					$nama_mata_kuliah	=mysqli_real_escape_string($cn,$res3->nama_mata_kuliah);
					$sks_mata_kuliah	=mysqli_real_escape_string($cn,$res3->sks_mata_kuliah);
					$id_kelas_kuliah	=mysqli_real_escape_string($cn,$res3->id_kelas_kuliah);
					$nama_kelas_kuliah	=mysqli_real_escape_string($cn,$res3->nama_kelas_kuliah);
					$id_registrasi_mahasiswa	=mysqli_real_escape_string($cn,$res3->id_registrasi_mahasiswa);
					$id_mahasiswa	=mysqli_real_escape_string($cn,$res3->id_mahasiswa);
					$nim	=mysqli_real_escape_string($cn,$res3->nim);
					$nama_mahasiswa	=mysqli_real_escape_string($cn,$res3->nama_mahasiswa);
					$jurusan	=mysqli_real_escape_string($cn,$res3->jurusan);
					$angkatan	=mysqli_real_escape_string($cn,$res3->angkatan);
					$nilai_angka	=mysqli_real_escape_string($cn,$res3->nilai_angka);
					$nilai_indeks	=mysqli_real_escape_string($cn,$res3->nilai_indeks);
					$nilai_huruf	=mysqli_real_escape_string($cn,$res3->nilai_huruf);
	              $sql="insert into GetDetailNilaiPerkuliahanKelas(id_program_studi,nama_program_studi,id_semester,nama_semester,id_matkul,kode_mata_kuliah,nama_mata_kuliah,sks_mata_kuliah,id_kelas_kuliah,nama_kelas_kuliah,id_registrasi_mahasiswa,id_mahasiswa,nim,nama_mahasiswa,jurusan,angkatan,nilai_angka,nilai_indeks,nilai_huruf) values('$id_program_studi','$nama_program_studi','$id_semester','$nama_semester','$id_matkul','$kode_mata_kuliah','$nama_mata_kuliah','$sks_mata_kuliah','$id_kelas_kuliah','$nama_kelas_kuliah','$id_registrasi_mahasiswa','$id_mahasiswa','$nim','$nama_mahasiswa','$jurusan','$angkatan','$nilai_angka','$nilai_indeks','$nilai_huruf')";
	              $res=$cn->query($sql);
	              if(!$res){
	              	echo "<br> ada kesalahan proses ambil data dari feeder ".$cn->error;
	              }
	        		
	        	}
	        }
	        // header("location:../index.php?sub=Kurikulum")
?>