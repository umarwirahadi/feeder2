<div class="row">
    <div class="col-md-12">
        <a href="aktivitasmhs/Download.php" class="label label-info">1. Download contoh *.xls</a>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="aktivitasmhs" accept=".xls" />
            <input type="submit" name="submit" id="submit" class="btn btn-xs btn-success" value="2. Upload" />
        </form>
        <?php
        if (isset($_POST['submit'])) {
            require_once('excel_reader2.php');
            $xlnilai2         =     $_FILES["aktivitasmhs"]["tmp_name"];
            if (!empty($xlnilai2)) {
                $xlnilai = new  Spreadsheet_Excel_Reader($xlnilai2);
                $row = $xlnilai->rowcount($sheet_index = 0);

                for ($i = 2; $i <= $row; $i++) {
                    // $jenis_anggota                     = strtoupper($xlnilai->val($i, 1)) == 'PERSONAL' ? 0 : 1;
                    // $jenis_aktivitas                   = $xlnilai->val($i, 2);
                    // $id_semester                       = $xlnilai->val($i, 5);
                    // $jenjang                           = $xlnilai->val($i, 3);
                    // $prodi                             = $xlnilai->val($i, 4);
                    // $judul                             = mysqli_real_escape_string($cn, $xlnilai->val($i, 6));
                    // $keterangan                        = $xlnilai->val($i, 7);
                    // $lokasi                            = $xlnilai->val($i, 8);
                    // $sk_tugas                          = $xlnilai->val($i, 9);
                    // $tanggal_sk_tugas                  = $xlnilai->val($i, 10);

                    $jenis_anggota                         =strtoupper($xlnilai->val($i, 1)) == 'PERSONAL' ? 0 : 1; 
                    $jenis_aktivitas= $xlnilai->val($i, 2);
                    $jenjang= $xlnilai->val($i, 3);
                    $jurusan= ucwords($xlnilai->val($i, 4));
                    $id_semester= $xlnilai->val($i, 5);
                    $judul= mysqli_escape_string($cn,strtoupper($xlnilai->val($i, 6)));
                    $keterangan= $xlnilai->val($i, 7);
                    $lokasi= $xlnilai->val($i, 8);
                    $sk_tugas= $xlnilai->val($i, 9);
                    $tanggal_sk= $xlnilai->val($i, 10)!=null?$xlnilai->val($i, 10):null;
                    $nim= $xlnilai->val($i, 11);
                    $nama_mahasiswa= mysqli_escape_string($cn,$xlnilai->val($i, 12));
                    $peran=$xlnilai->val($i, 13);
                    if($peran=='Ketua'){
                        $jenis_peran= '3';
                    }elseif($peran=='Anggota'){
                        $jenis_peran= '2';
                    }else{
                        $jenis_peran= '3';
                    }
                    $nama_dosen_pembimbing= $xlnilai->val($i, 14);
                    $nidn_dosen_pembimbing= $xlnilai->val($i, 15);
                    $nama_kategori_kegiatan= $xlnilai->val($i, 16);
                    $pembimbing_ke= $xlnilai->val($i, 17);
                    $nama_dosen_penguji= $xlnilai->val($i, 18);
                    $nidn_dosen_penguji= $xlnilai->val($i, 19);
                    $penguji_ke= $xlnilai->val($i, 20);

                    
                    
                    
                    
                    // $jenis_anggota                     = strtoupper($xlnilai->val($i, 1)) == 'PERSONAL' ? 0 : 1;
                    // $jenis_aktivitas                   = $xlnilai->val($i, 2);
                    // $id_semester                       = $xlnilai->val($i, 5);
                    // $jenjang                           = $xlnilai->val($i, 3);
                    // $prodi                             = $xlnilai->val($i, 4);
                    // $judul                             = mysqli_real_escape_string($cn, $xlnilai->val($i, 6));
                    // $keterangan                        = $xlnilai->val($i, 7);
                    // $lokasi                            = $xlnilai->val($i, 8);
                    // $sk_tugas                          = $xlnilai->val($i, 9);
                    // $tanggal_sk_tugas                  = $xlnilai->val($i, 10);




                    // $sql = "INSERT INTO aktivitasmahasiswa (jenis_anggota, jenis_aktivitas, id_semester, jenjang, prodi,judul, keterangan, lokasi, sk_tugas, tanggal_sk_tugas, status) 
                    //         VALUES ('$jenis_anggota', '$jenis_aktivitas', '$id_semester', '$jenjang','$prodi','$judul', '$keterangan', '$lokasi', '$sk_tugas', $tanggal_sk_tugas, '0')";
                    $sql="insert into aktivitasmahasiswa (jenis_anggota,	jenis_aktivitas,	jenjang,	prodi,	id_semester,	judul,	keterangan,	lokasi,	sk_tugas,tanggal_sk_tugas,	nim,	nama_mahasiswa,	jenis_peran,	nama_dosen,	nidn,	nama_kategori_kegiatan,	pembimbing_ke,	nama_dosen_penguji,	nidn_penguji,	penguji_ke,status) 
                                values ('$jenis_anggota',	'$jenis_aktivitas',	'$jenjang',	'$jurusan',	'$id_semester',	'$judul',	'$keterangan',	'$lokasi',	'$sk_tugas',$tanggal_sk,'$nim',	'$nama_mahasiswa',	'$jenis_peran',	'$nama_dosen_pembimbing',	'$nidn_dosen_pembimbing',	'$nama_kategori_kegiatan',	'$pembimbing_ke',	'$nama_dosen_penguji',	'$nidn_dosen_penguji','$penguji_ke','0')";

                    $cn->query($sql) or die(mysqli_error($cn));
                }
            }
        }
        ?>
        <button class="btn btn-xs btn-success" id="valid_mhs" onclick="location.href='aktivitasmhs/validasi.php';"><span class="glyphicon glyphicon-check"></span> 3. Validasi</button>
        <button class="btn btn-xs btn-info" onclick="location.href='aktivitasmhs/import.php'"><span class="glyphicon glyphicon-paperclip"></span> 4. Import ke Feeder</button>
        <button class="btn btn-xs btn-danger" onclick="location.href='aktivitasmhs/delete.php'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 5.Hapus</button>
        <button class="btn btn-xs btn-warning" onclick="location.href='index.php?'"><span class="glyphicon glyphicon-circle-arrow-left"></span> 6.Back</button>
    </div> <!-- end mcol-md-6 -->
</div>
<br>
<div class="panel panel-default">
    <div class="panel-heading">.:Data Nilai Transfer:.</div>
    <div class="panel-body">
        <div class="table-responsive" style="height: 600px">
            <table class="table table-bordered ">
                <tr class="xs">
                    <td>NO</td>
                    <td>JENIS ANGGOTA</td>
                    <td>JENIS AKTIVITAS</td>
                    <td>JENJANG</td>
                    <td>JURUSAN</td>
                    <td>ID SEMESTER</td>
                    <td>JUDUL</td>
                    <td>KETERANGAN</td>
                    <td>LOKASI</td>
                    <td>SK</td>
                    <td>TGL. SK</td>
                    <td>DEKSIPSI</td>
                    <td>STATUS</td>
                    <td>Opsi</td>
                </tr>
                <?php
                $color1 = "#88EB88";
                $color2 = "white";
                $result1 = $cn->query("select * from aktivitasmahasiswa");
                if ($result1->num_rows > 0) {
                    $no = 1;
                    while ($result = $result1->fetch_assoc()) {
                        if ($result["id_jenis_aktivitas"] == '' || $result["id_prodi"] == '') {
                            echo "<tr bgcolor='" . $color1 . "'>";
                        } else {
                            echo "<tr bgcolor='" . $color2 . "'>";
                        }
                ?>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $result["jenis_anggota"]; ?></td>
                        <td><?php echo $result["jenis_aktivitas"]; ?></td>
                        <td><?php echo $result["id_jenis_aktivitas"]; ?></td>
                        <td><?php echo $result["id_prodi"]; ?></td>
                        <td><?php echo $result["id_semester"]; ?></td>
                        <td><?php echo $result["judul"]; ?></td>
                        <td><?php echo $result["keterangan"]; ?></td>
                        <td><?php echo $result["lokasi"]; ?></td>
                        <td><?php echo $result["sk_tugas"]; ?></td>
                        <td><?php echo $result["tanggal_sk_tugas"]; ?></td>
                        <td><?php echo $result["deskripsi"]; ?></td>
                        <td><?php echo $result["status"]; ?></td>
                        <td><a href="#" class="btn btn-xs btn-success">Edit Data</a> | <a href="index.php?sub=hapusaktivitasmhs?id=1" class="btn btn-xs btn-danger">Hapus</a></td>
                        </tr>

                <?php
                $no++;
                    }
                } else { //else jika tidak ada data history
                    echo '<tr><td colspan="22">No data</td></tr>';
                }
                ?>
            </table>
        </div><!-- end table responsive-->
    </div>
</div>
<div id="hasildata">

</div>
<script>
    $(document).ready(function() {
        $("#valid_mhs").click(function() {
            $("#hasildata").load("piksi/../history_pendidikan/validasi_feeder_history_mahasiswa.php");
        });
    });
</script>