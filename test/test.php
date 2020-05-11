 <?php
   $token = $_SESSION['token'];

   $act = "GetListBimbingMahasiswa";

   $filter = "";
   $data = array(
      "act" => $act,
      "token" => $token,
      "filter" => $filter,
      "limit" => ""
   );
   $res = json_decode(runWS($data));
      // echo "<pre>";
      // print_r($res);
      // echo "</pre>";
   ?>

 <table>
    <tr>
       <td>id_aktivitas</td>
       <td>judul</td>
       <td>id_bimbing_mahasiswa</td>
       <td>id_kategori_kegiatan</td>
       <td>nama_kategori_kegiatan</td>
       <td>id_dosen</td>
       <td>nidn</td>
       <td>nama_dosen</td>
    </tr>
    <?php
      foreach ($res->data as $res) {
      ?>
       <tr>
          <td><?php echo $res->id_aktivitas; ?></td>
          <td><?php echo $res->judul; ?></td>
          <td><?php echo $res->id_bimbing_mahasiswa; ?></td>
          <td><?php echo $res->id_kategori_kegiatan; ?></td>
          <td><?php echo $res->nama_kategori_kegiatan; ?></td>
          <td><?php echo $res->id_dosen; ?></td>
          <td><?php echo $res->nidn; ?></td>
          <td><?php echo $res->nama_dosen; ?></td>



       </tr>
    <?php
      }
      ?>
 </table>