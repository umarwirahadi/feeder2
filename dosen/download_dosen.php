<?php 
session_start();
require_once("../config/koneksi.php");
require_once("../config.php");
$token=$_SESSION['token'];


 
header('Content-Type: application/vnd.openxmlformats');
header('Content-Disposition: attachment; filename="Data_dosen.xls"');
header('Cache-Control: max-age=0');

$datathn = array('act'=>"GetSemester","token"=>$token,"filter"=>"a_periode_aktif='1'","limit"=>"");
$thn_akd=json_decode(runWS($datathn));
foreach ($thn_akd->data as $thn) {
$data = array('act'=>"GetListPenugasanDosen","token"=>$token,"filter"=>"id_tahun_ajaran='$thn->id_tahun_ajaran'","limit"=>"");
$GetListDosen=json_decode(runWS($data));
 ?>
 <table border="1" cellspacing="0" cellpadding="5">
 	<caption>Data Dosen</caption>
 	<thead>
 		<tr>
 			<th>no</th>
 			<th>nama_dosen</th>
 			<th>nidn</th>
 			<th>nama_tahun_ajaran</th>
 			<th>nama_program_studi</th>
 			<th>nomor_surat_tugas</th>
 			<th>tanggal_surat_tugas</th>
 			<th>mulai_surat_tugas</th>
 		</tr>
 	</thead>
 	<tbody>
 		<?php
 		$no=1; 
 		foreach ($GetListDosen->data as $key) {
 		 ?>
 		<tr>
 			<td><?php echo $no; ?></td>
 			<td><?php echo $key->nama_dosen; ?></td>
 			<td><?php echo "=\"$key->nidn\""; ?></td>
 			<td><?php echo $key->nama_tahun_ajaran; ?></td>
 			<td><?php echo $key->nama_program_studi; ?></td>
 			<td><?php echo $key->nomor_surat_tugas; ?></td>
 			<td><?php echo $key->tanggal_surat_tugas; ?></td>
 			<td><?php echo $key->mulai_surat_tugas; ?></td>
 		</tr>
 		<?php $no++;} }?>
 	</tbody>
 </table>

