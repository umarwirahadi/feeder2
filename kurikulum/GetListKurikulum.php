<?php
$token=$_SESSION['token'];
$data2 =["act"=>"GetListKurikulum","token"=>$token,"filter"=>"","limit"=>""];
$result2=json_decode(runWS($data2));
if($result2->error_code==0){
?>
<div class="table-responsive">
<table class="table table-bordered">
  <tr>
    <td>id_kurikulum</td>
    <td>nama_kurikulum</td>
    <td>id_prodi</td>
    <td>nama_program_studi</td>
    <td>id_semester</td>
    <td>semester_mulai_berlaku</td>
    <td>jumlah_sks_lulus</td>
    <td>jumlah_sks_wajib</td>
    <td>jumlah_sks_pilihan</td>
    <td>jumlah_sks_mata_kuliah_wajib</td>
    <td>jumlah_sks_mata_kuliah_pilihan</td>
  </tr>
  <?php
  foreach ($result2->data as $res3) {
    ?>
    <tr>
      <td><?php echo $res3->id_kurikulum;?></td>
      <td><?php echo $res3->nama_kurikulum;?></td>
      <td><?php echo $res3->id_prodi;?></td>
      <td><?php echo $res3->nama_program_studi;?></td>
      <td><?php echo $res3->id_semester;?></td>
      <td><?php echo $res3->semester_mulai_berlaku;?></td>
      <td><?php echo $res3->jumlah_sks_lulus;?></td>
      <td><?php echo $res3->jumlah_sks_wajib;?></td>
      <td><?php echo $res3->jumlah_sks_pilihan;?></td>
      <td><?php echo $res3->jumlah_sks_mata_kuliah_wajib;?></td>
      <td><?php echo $res3->jumlah_sks_mata_kuliah_pilihan;?></td>
    </tr>
<?php
  }
}
   ?>
</table>
</div>
