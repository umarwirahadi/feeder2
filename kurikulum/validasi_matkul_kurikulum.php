<?php
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select * from insertmatkulkurikulum where status='0'";
if($data1=$cn->query($sql)){
	if($data1->num_rows>0){
		for($i=0;$i<$data1->num_rows;$i++){
		$rw=$data1->fetch_assoc();
		$id 				=$rw['id'];
		$nama_kurikulum 	=$rw['nama_kurikulum'];
		$id_semester 		=$rw['id_semester'];
		$kode_matkul 		=$rw['kode_matkul'];
		$nama_matkul 		=$rw['nama_matkul'];
		$sks				=$rw['sks'];
		$semester 			=$rw['semester'];
		$nama_prodi			=$rw['nama_prodi'];
		$jenjang 			=$rw['jenjang'];

		//fill id_kurikulum
		$act		="GetDetailKurikulum";
		$filter		="nama_kurikulum='$nama_kurikulum' and id_semester='$id_semester'";
		$order 		="";
		$limit 		="1";
		$offset 	="";	
		$ws=array("act"=>$act,
					"token"=>$token,
					"filter"=>$filter,
					"order"=>$order,
					"limit"=>$limit,
					"offset"=>$offset);
		$hasil=json_decode(RunWS($ws));		
		if ($hasil->error_code==0){			
			foreach ($hasil->data as $row) {
				$id_kurikulum=$row->id_kurikulum;
				$id_prodi=$row->id_prodi;
				$sql="update insertmatkulkurikulum set id_kurikulum='$id_kurikulum',id_prodi='$id_prodi',desk='' where id='$id'";
				$res=$cn->query($sql);
			}
		}elseif ($hasil->error_code<>0) {
			$erkode =$hasil->error_code;
			$erdesc =$hasil->error_desc;
			$gabungan=$erkode."-".$erdesc;
			$sql="update insertmatkulkurikulum set desk='$gabungan' where id='$id'";
			$res=$cn->query($sql);
		}

		//fill id_prodi
			$act2		="GetProdi";
			$filter2	="nama_program_studi='$nama_prodi' and nama_jenjang_pendidikan='$jenjang'";
			$limit 		="1";
			$ws1=array("act"=>$act2,
						"token"=>$token,
						"filter"=>$filter2,
						"limit"=>$limit);
			$id_prodi=json_decode(RunWS($ws1));
			if($id_prodi->error_code==0){
				foreach ($id_prodi->data as $key) {
					$res_id_prodi=$key->id_prodi;
					$sql_up2="update insertmatkulkurikulum set id_prodi='$res_id_prodi' where id=$id ";
					$cn->query($sql_up2);
				}	
			}else{
				$erkode =$hasil->error_code;
				$erdesc =$hasil->error_desc;
				$gabungan=$erkode."-".$erdesc;
				$sql="update insertmatkulkurikulum set desk='$gabungan' where id=$id";
				$res=$cn->query($sql);
			}

			//fill id_matkul
			$act1		="GetListMataKuliah";
			$filter1	="kode_mata_kuliah='$kode_matkul' and nama_mata_kuliah='$nama_matkul' and id_prodi='$res_id_prodi'";
			$limit 		="1";
			$ws1=array("act"=>$act1,
						"token"=>$token,
						"filter"=>$filter1,
						"limit"=>$limit);
			$hasil=json_decode(RunWS($ws1));
			if($hasil->error_code==0){
				foreach ($hasil->data as $key) {
				$id_mk=$key->id_matkul;
				$sql_up="update insertmatkulkurikulum set id_matkul='$id_mk' where id=$id";
				$cn->query($sql_up);
				}	
			}else{
				$erkode =$hasil->error_code;
				$erdesc =$hasil->error_desc;
				$gabungan=$erkode."-".$erdesc;
				$sql="update insertmatkulkurikulum set desk='$gabungan' where id='$id'";
				$res=$cn->query($sql);
			}
		$sql_stat="update insertmatkulkurikulum set status='1' where id='$id' AND id_kurikulum IS NOT NULL AND id_matkul IS NOT NULL";
		$cn->query($sql_stat);
	}
	}
}
header("location:../index.php?sub=Kurikulum&idkurikulum");
 ?>
