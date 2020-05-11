<div class="row">
			<div class="col-md-12">					
							<button class="btn btn-xs btn-warning" onclick="location.href='index.php?sub=nilai_transfer'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5.Back</button>							
		 	</div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default">
  <div class="panel-heading">.:Get Dictionary:.</div>
  <div class="panel-body">
	<div class="table-responsive" style="height: 350px">
		<div class="result">
			<table class="table table-bordered ">
				<tr class="xs">
					<td>No</td>
					<td>Nama Fungsi</td>
					<td>option</td>			
				</tr>
					<?php
					// require_once('../config/koneksi.php');
					$sql="select * from ms_fungsi";
					if($res=$cn->query($sql)){
						if($res->num_rows>=1){
							$no=1;
							while ($data=$res->fetch_assoc()) {
								?>
								<tr>		
								<td><?php echo $no; ?></td>
								<td><?php echo $data['nama_fungsi']; ?></td>
								<td><button type="button" name="Nama_aksi" class="btn btn-xs btn-info lihat_struktur" id="<?php echo $data['nama_fungsi'];?>" data-toggle="modal" data-target="#myStructure"><span class="glyphicon glyphicon-search"> View</span></button></td>
								<?php
							$no++;
							}
						}
					}else{
						echo "Error : ".$cn->error;
					}
					?> 
				</tr>	
			</table>
	</div>
</div><!-- end table responsive-->
</div>
</div>
<div id="myStructure" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title modal-title-primary">Struktur table</h4>
      </div>
      <div class="modal-body">
        <div id="view_strukture">
			
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script>
	$(document).ready(function(){
  		$(".lihat_struktur").click(function(){
  			var id_nama=$(this).attr("id");
  			$(".modal-title").text(id_nama);
  			$.ajax({url:'other/view_get_dictionary.php',
  				data:'nama_fungsi='+id_nama,
  				success:function(data){
  					$("#view_strukture").html(data);
  				}
  				});			
		});
	});
</script>