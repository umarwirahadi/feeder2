    <a href="kurikulum/download_kurikulum.php?" class="label label-info">1. Download contoh *.xls</a>
        <form action="" method="post" enctype="multipart/form-data" style="padding-top: 5px;margin-bottom: 5px;">
          <input type="file" name="kurikulum" accept=".xls"  class="btn btn-xs btn-success" style="margin-bottom:5px;margin-top:5px;  " />          
          <input type="submit" name="submit" id="submit" class="btn btn-xs btn-success" value="2. Upload" />
        </form>
        <?php
          if(isset($_POST['submit'])){
            require_once("excel_reader2.php");
            $nama1    =   $_FILES['kurikulum']['tmp_name'];
            if (!empty($nama1)){
            $data = new  Spreadsheet_Excel_Reader($nama1);
            $row=$data->rowcount($sheet_index=0);
              for($i=2;$i<=$row;$i++){
                $nama_kurikulum     =trim($data->val($i,1)," ");
                $nama_prodi        =$cn->real_escape_string($data->val($i,2));
                $jenjang            =trim($data->val($i,3)," ");
                $id_semester       =trim($data->val($i,4)," ");
                $jumlah_sks_lulus      =trim($data->val($i,5)," ");
                $jumlah_sks_wajib     =trim($data->val($i,6)," ");
                $jumlah_sks_pilihan     =trim($data->val($i,7)," ");
                $sql="insert into insertkurikulum(nama_kurikulum,jenjang,nama_prodi,id_semester,jumlah_sks_lulus,jumlah_sks_wajib,jumlah_sks_pilihan,status) values('$nama_kurikulum','$jenjang','$nama_prodi','$id_semester','$jumlah_sks_lulus','$jumlah_sks_wajib','$jumlah_sks_pilihan','0')";
                $cn->query($sql);
                echo($cn->error);
              } //end for
                  
          }
          }//end if empty
                ?>
     <button class="btn btn-sm btn-info" id="ck1">3. Validasi</button>
     <a href="kurikulum/insert_kurikulum.php" class="btn btn-sm btn-primary" >4. Import Kurikulum</a>
     <a href="kurikulum/delete_data.php" class="btn btn-sm btn-danger" >5. Hapus data</a>
    <div style="padding-top:10px;">
        <div class="table-responsive">
          <table class="table table-bordered">
            <tr>
              <td>id</td>
              <td>nama_kurikulum</td>
              <td>jenjang</td>
              <td>nama_prodi</td>
              <td>id_semester</td>
              <td>total_SKS</td>
              <td>SKS_wajib</td>
              <td>SKS_pilihan</td>
              <td>deskripsi</td>
            </tr>
           <?php
              $color1="white";
              $color2="#88EB88";
                $result1=$cn->query("select * from insertkurikulum");
                if($result1->num_rows>0){
                  while ($result=$result1->fetch_assoc()) {
                    if(empty($result['id_prodi']) OR $result['id_prodi']==""){
                      echo "<tr bgcolor='".$color2."'>";
                    }else{
                      echo "<tr bgcolor='".$color1."'>";
                    }
            ?>              
                <td ><?php echo $result["id"]; ?></td>
                <td ><?php echo $result["nama_kurikulum"]; ?></td>
                <td ><?php echo $result["jenjang"]; ?></td>
                <td ><?php echo $result["nama_prodi"]; ?></td>
                <td ><?php echo $result["id_semester"]; ?></td>
                <td ><?php echo $result["jumlah_sks_lulus"]; ?></td>
                <td ><?php echo $result["jumlah_sks_wajib"]; ?></td>
                <td ><?php echo $result["jumlah_sks_pilihan"]; ?></td>
                <td ><?php echo $result["desk"]; ?></td>                
              </tr>

            <?php
              }
          }else {//else jika tidak ada
                echo '<tr><td colspan="22">No data</td></tr>';
              }
          ?>
  </table>
        </div>
    </div>

<script type="text/javascript">
  $(document).ready(function(){      
        $("#ck1").click(function() {
         window.location.href='kurikulum/validasi_kurikulum.php';
        });
      });
</script>