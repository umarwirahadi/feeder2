 <?php
       		session_start();       		
       		require_once("../config/koneksi.php");
       		require_once("../config.php");
       		$token=$_SESSION['token'];
       		// $actsmt="GetSemester";
       		// $filtersmt="a_periode_aktif='1'";
       		// $limitsmt="";
       		// $getsmt = array("act" =>$actsmt ,"token"=>$token,"filter"=>$filtersmt,"limit"=>$limitsmt );
       		// $resgetsmt=json_decode(runWS($getsmt));
       		// if($resgetsmt->error_code==0){
       		// 	foreach ($resgetsmt->data as $key) {
			// 		   $id_smt=$key->id_semester;
					$id_smt='20191';   
					$data2 =["act"=>"GetDetailNilaiPerkuliahanKelas","token"=>$token,"filter"=>"id_semester='$id_smt' and nilai_huruf IS NULL","limit"=>"5000"];
       				// $data2 =["act"=>"GetDetailNilaiPerkuliahanKelas","token"=>$token,"filter"=>"nim='13300012' and nilai_huruf IS NULL","limit"=>"","limit"=>""];
       				// $data2 =["act"=>"GetDetailNilaiPerkuliahanKelas","token"=>$token,"filter"=>"nim='17303310' and nilai_huruf IS NULL","limit"=>"","limit"=>""];
					$result2=json_decode(runWS($data2));
					if($result2->error_code==0){
	        			foreach ($result2->data as $res3) {
			        	  	$id_prodi	=$res3->id_prodi;
							$nama_program_studi	=$res3->nama_program_studi;
							$id_semester	=$res3->id_semester;
							$nama_semester	=$res3->nama_semester;
							$id_matkul	=$res3->id_matkul;
							$kode_mata_kuliah	=$res3->kode_mata_kuliah;
							$nama_mata_kuliah	=$res3->nama_mata_kuliah;
							$sks_mata_kuliah	=$res3->sks_mata_kuliah;
							$id_kelas_kuliah	=$res3->id_kelas_kuliah;
							$nama_kelas_kuliah	=$res3->nama_kelas_kuliah;
							$id_registrasi_mahasiswa	=$res3->id_registrasi_mahasiswa;
							$id_mahasiswa	=$res3->id_mahasiswa;
							$nim	=$res3->nim;
							$nama_mahasiswa	=mysqli_real_escape_string($cn,$res3->nama_mahasiswa);
							$jurusan	=$res3->jurusan;
							$angkatan	=$res3->angkatan;
							$nilai_angka	=$res3->nilai_angka;
							$nilai_indeks	=$res3->nilai_indeks;
							$nilai_huruf	=$res3->nilai_huruf;
			              	$sql="insert into GetDetailNilaiPerkuliahanKelas(id_prodi,nama_program_studi,id_semester,nama_semester,
			              		  id_matkul,kode_mata_kuliah,nama_mata_kuliah,sks_mata_kuliah,id_kelas_kuliah,nama_kelas_kuliah,
			              		  id_registrasi_mahasiswa,id_mahasiswa,nim,nama_mahasiswa,jurusan,angkatan,nilai_angka,nilai_indeks,nilai_huruf) values 
 								  ('$id_prodi','$nama_program_studi','$id_semester','$nama_semester','$id_matkul','$kode_mata_kuliah','$nama_mata_kuliah',
 								  '$sks_mata_kuliah','$id_kelas_kuliah','$nama_kelas_kuliah','$id_registrasi_mahasiswa','$id_mahasiswa','$nim','$nama_mahasiswa',
 								  '$jurusan','$angkatan','$nilai_angka','$nilai_indeks','$nilai_huruf')";
				            $cn->query($sql);	        		
	        			}
	        		}
       		// 	}

       		// }
       		$cn->close();
       		header("location:../index.php?sub=nilaimhs");
?>