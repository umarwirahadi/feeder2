<form action="" method="post" class="form-horizontal">
	<div class="form-group">
    	<label class="control-label col-sm-3" for="nama_lengkap">NAMA LENGKAP</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" id="NamaLengkap" placeholder="Nama Lengkap mahasiswa" required="required">
	    </div>
	</div>
	<div class="form-group">
    	<label class="control-label col-sm-3" for="TempatLahir">Tempat Lahir</label>
	    <div class="col-sm-9">
	      <input type="text" class="form-control" id="TempatLahir" name="TempatLahir" placeholder="Nama Lengkap mahasiswa" required="required">
	    </div>
	</div>
		<div class="form-group">
    	<label class="control-label col-sm-3" for="TempatLahir">Tanggal Lahir</label>
	    <div class="col-sm-5">
	      <input type="date" class="form-control" id="TanggalLahir" name="TanggalLahir" placeholder="Tanggal Lahir" required="required">
	    </div>
	</div>
	<div class="form-group">
    	<label class="control-label col-sm-3" for="JenisKelamin">Jenis Kelamin</label>
	    <div class="col-sm-3" size="30">
	      <select class="form-control" name="JenisKelamin">
	      	<option value="L">L</option>
	      	<option value="P">P</option>
	      </select>
	    </div>	
	</div>
	<div class="form-group">
    	<label class="control-label col-sm-3" for="IdAgama">Agama</label>
	    <div class="col-sm-6">
	      <select name="IdAgama" class="form-control">
	      	<option value="1">Islam</option>
	      	<option value="2">Kristen</option>
	      	<option value="3">Hindu</option>
	      	<option value="4">Budha</option>	      	
	      </select>
	    </div>
	</div>
		<div class="form-group">
    	<label class="control-label col-sm-3" for="nik">No. KTP</label>
	    <div class="col-sm-5">
	      <input type="num" class="form-control" id="nik" name="nik" placeholder="No. KTP" required="required">
	    </div>
	</div>
</form>