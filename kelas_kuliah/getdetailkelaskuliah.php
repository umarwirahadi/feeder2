<div class="panel panel-primary">
  <div class="panel-heading">.:Download Kelas Kuliah:.</div>
<div class="panel-body">
<form action="kelas_kuliah/act_getdetailkelaskuliah.php" method="post">
<div class="form-group">
<label for="tahun">Pilih Semester</label>

<select name="tahun" id="tahun" class="form-control">
	<option value="20151">20151</option>
	<option value="20152">20152</option>
	<option value="20161">20161</option>
	<option value="20162">20162</option>
	<option value="20171">20171</option>
	<option value="20172">20172</option>	
</select>
</div>


<button type="submit" class="btn btn-sm btn-primary" ><span class="glyphicon glyphicon-download"></span> Download Kelas Kuliah</button>
<button type="reset" class="btn btn-sm btn-warning" ><span class="glyphicon glyphicon-share-alt"></span> reset</button>
<button type="button" class="btn btn-sm btn-danger" onClick="location.href='index.php?sub=kelaskuliah';">Back</button>

</form>
</div>
</div>
<script>
	$(document).ready(function(){
		
	});

</script>