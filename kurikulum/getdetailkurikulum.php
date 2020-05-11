<div class="row">
<div class="container-fluid">
  <div class="panel-group">
    <div class="panel panel-primary">
    <?php
    if(isset($_GET["idkurikulum"])){
      $sub =$_GET["idkurikulum"];
      if($sub=="input-kurikulum"){
      ?>
        <div class="panel-heading">.:Input Kurikulum:.</div>
        <div class="panel-body">
      <?php
        include_once("input_kurikulum.php");
        ?>
      </div>
        <?php
      }elseif($sub=='input-matkul-kurikulum'){
      ?>
      <div class="panel-heading">.:InsertMatkulKurikulum:.</div>
        <div class="panel-body">
      <?php  
      include_once("view_insertMatkulKurikulum.php");
      }else{
        ?>
        <div class="panel-heading">.:Input DetailMataKuliahKurikulum</div>        
      <?php
      include_once("view_insertMatkulKurikulum.php");
      }
    }else{

     ?>
        <div class="panel-heading">.:Data Kurikulum:.</div>
        <div class="panel-body">
        <!-- <button class="btn btn-sm btn-primary" id="btn-update">Update dari Feeder</button> -->
        <a href="../piksi/index.php?sub=Kurikulum&idkurikulum=input-kurikulum" class="btn btn-sm btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Input Kurikulum Baru</a>
        <a href="Kurikulum/Update_getdetailkurikulum.php" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-cloud-download"></span> Update GetDetailKurikulum dari feeder</a>
        <a href="Kurikulum/Update_getmatkulkurikulumAll.php" class="btn btn-sm btn-success" id="ck2"><span class="glyphicon glyphicon-cloud-download"></span> Update GetMataKuliahKurikulum dari feeder</a>
        <a href="Kurikulum/download_kurikulum_all.php" class="btn btn-sm btn-warning" id="ck2"><span class="glyphicon glyphicon-save"></span> Export</a>
        <p>
        <div class="table-responsive" style="height: 500px">
        <table class="table table-bordered">
          <tr>
            <td>No</td>
            <td>nama_kurikulum</td>
            <td>nama_program_studi</td>
            <td>semester_mulai_berlaku</td>
            <td>sks_lulus</td>
            <td>sks_wajib</td>
            <td>sks_pilihan</td>
            <td>Option</td>
          </tr>
          <?php
          $sql="SELECT * FROM GetDetailKurikulum order by id_semester DESC";
          $res=$cn->query($sql);
          if($res->num_rows>0){       
          
          $no=1;
          while($res3=$res->fetch_assoc()){
            ?>
            <tr>
              <td><?php echo $no;?></td>
              <td><a href="index.php?sub=Kurikulum&idkurikulum=<?php echo $res3["nama_kurikulum"]; ?>"><?php echo $res3["nama_kurikulum"];?></a></td>
              <td><?php echo $res3["nama_program_studi"];?></td>
              <td><?php echo $res3["semester_mulai_berlaku"];?></td>
              <td><?php echo $res3["jumlah_sks_lulus"];?></td>
              <td><?php echo $res3["jumlah_sks_wajib"];?></td>
              <td><?php echo $res3["jumlah_sks_pilihan"];?></td>
              <td><a href="index.php?sub=Kurikulum&idkurikulum=<?php echo $res3["id_kurikulum"]; ?>" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-search"></a>|<a href="index.php?sub=Kurikulum&listmatkul=2" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"</a></td>
            </tr>
        <?php
          $no++;
          } 
        }else{
                  ?>
                  <tr>
                    <td>0</td>
                    <td colspan="8">No Record</td>
                  </tr>

                  <?php
                }
         ?>


        </table>
        
</div>
</div>
</div>
</div>
</div>
</div>
<?php 
} 
 ?>