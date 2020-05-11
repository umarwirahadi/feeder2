<?php 
// session_start();
if(isset($_SESSION['token'])){
$token=$_SESSION['token'];
 ?>
<form action="cari_mhs_filter.php" method="POST" class="form-inline">
	<div class="form-group">		
		<label for="cariMhs">Cari Mahasiswa</label>
			<input type="text" name="cariMhs" class="form-control" id="cariMhs">
		<input type="submit" name="Cari" value="Cari" class="form-control">
	</div>
</form>
<?php 
// include('config.php');
// $usr  ='045027';
// $pwd  ='050104piksi680401';
// $data         =array(
//               'act'=>'GetToken',
//               'username'=>$usr,
//               'password'=>$pwd
//               );
// $result=runWS($data);
// $a=json_decode($result);
// $token=$a->data->token;

$data2 =
[
  "act"=>"GetListMahasiswa",
  "token"=>$token,
  "filter"=>"nama_mahasiswa ilike '%umar%'",
  "limit"=>10
];
$result2=json_decode(runWS($data2));
// echo "<pre>";
// print_r($result2);
// echo "</pre>";
 ?>
<table class="table table-bordered">
	<tr>
		<td>NPM</td>
		<td>Nama Mahasiswa</td>
		<td>Tgl. Lahir</td>
		<td>Jenis Kel</td>
		<td>Agama</td>
		<td>Prodi</td>
		<td>Status</td>
	</tr>
	<?php
		foreach ($result2->data as $key) {
			echo "<tr>";
			echo "<td>".$key->nim."</td>";
			echo "<td>".$key->nama_mahasiswa."</td>";
			echo "<td>".$key->tanggal_lahir."</td>";
			echo "<td>".$key->jenis_kelamin."</td>";
			echo "<td>".$key->nama_agama."</td>";
			echo "<td>".$key->nama_program_studi."</td>";
			echo "<td>".$key->nama_status_mahasiswa."</td>";
			echo "</tr>";			
		}
	}
	?>	
</table>


