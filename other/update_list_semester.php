<?php 
session_start();
include_once('../config.php');
include_once('../config/koneksi.php');
$token=$_SESSION['token'];
$data2 =["act"=>"GetSemester","token"=>$token,"filter"=>"","limit"=>"","order"=>"a_periode_aktif DESC"];
$result2=json_decode(runWS($data2));
// print_r($result2);
if($result2->error_code==0){
	foreach ($result2->data as $row) {

		$pilih="select * from GetSemester where id_semester='$row->id_semester'";
		$conres=$cn->query($pilih);
		if($conres->num_rows==0){
		$sqlinsert="insert into GetSemester(id_semester,id_tahun_ajaran,nama_semester,semester,a_periode_aktif,tanggal_mulai,tanggal_selesai) values('$row->id_semester','$row->id_tahun_ajaran','$row->nama_semester','$row->semester','$row->a_periode_aktif','$row->tanggal_mulai','$row->tanggal_selesai')";		
		$cn->query($sqlinsert);
		}
	}
}
?>
<table class="table table-bordered table-hover">
			<tr>
				<td>no</td>
				<td>id_semester</td>
				<td>id_tahun_ajaran</td>
				<td>nama_semester</td>
				<td>semester</td>
				<td>a_periode_aktif</td>
				<td>tanggal_mulai</td>
				<td>tanggal_selesai</td>
			</tr>
			<?php
			$sqlsmt="select * from getsemester";
			if($ressmt=$cn->query($sqlsmt)){
				if($ressmt->num_rows){
				$no=1;
				while ($row=$ressmt->fetch_assoc()) {
				?>
				<tr>
					<td><?php echo$no; ?></td>
					<td><?php echo$row['id_semester']; ?></td>
					<td><?php echo$row['id_tahun_ajaran']; ?></td>
					<td><?php echo$row['nama_semester']; ?></td>
					<td><?php echo$row['semester']; ?></td>
					<td><?php echo$row['a_periode_aktif']; ?></td>
					<td><?php echo$row['tanggal_mulai']; ?></td>
					<td><?php echo$row['tanggal_selesai']; ?></td>
				</tr>
				<?php
				$no++;
				}
				}else{
					?>
					<tr>
						<td colspan="8">No Record</td>
					</tr>
				<?php }
			}
			 ?>
		</table>