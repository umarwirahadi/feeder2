 <?php
 		$token=$_SESSION['token'];

                  $act="GetJalurMasuk";

                  $filter="";
                  $data=array("act"=>$act,
                  "token"=>$token,
                  "filter"=>$filter,
                  "limit"=>"");
                  $res_id_matkul=json_decode(runWS($data));
                  echo "<pre>";
                  print_r($res_id_matkul);
                  echo "</pre>";
               ?>

                  <table>
                  <tr>
                        <td>nim</td>
                        <td>nama_mahasiswa</td>
                        <td>nama_program_studi</td>
                        <td>angkatan</td>
                        <td>id_semester</td>
                        <td>nama_semester</td>
                        <td>nama_status_mahasiswa</td>
                        <td>sks_total</td>
                  </tr>
                  <?php
                  //foreach ($res_id_matkul->data as $res) {
                     ?>
                     <tr>
                        <td><?php  echo $res->nim;?></td>
                        <td><?php  echo $res->nama_mahasiswa;?></td>
                        <td><?php  echo $res->nama_program_studi;?></td>
                        <td><?php  echo $res->angkatan;?></td>
                        <td><?php  echo $res->id_semester;?></td>
                        <td><?php  echo $res->nama_semester;?></td>
                        <td><?php  echo $res->nama_status_mahasiswa;?></td>
                        <td><?php  echo $res->sks_total;?></td>
                     </tr>
                     <?php
                  //}
                  ?>
                  </table>



             
