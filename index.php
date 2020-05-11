<?php
// error_reporting(0);
session_start();
$token = $_SESSION['token'];
if ($token <> '100') {
  include("config/koneksi.php");
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <title>Feeder</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/DataTables/DataTables-1.10.16/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="assets/DataTables/DataTables-1.10.16/css/dataTables.bootstrap.css">
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>

    <style>
      table td {
        white-space: nowrap;
      }

      body {
        margin-top: 60px;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">POLITEKNIK PIKSI GANESHA</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="index.php?sub=list_mahasiswa">Mahasiswa</a></li>
          <!-- <li><a href="index.php?sub=matkul">Mata Kuliah Feeder</a></li> -->
          <li><a href="index.php?sub=nilaiTransfer">Nilai Transfer</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Perkuliahan <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?sub=matkul"><span class="glyphicon glyphicon-duplicate"></span> Mata kuliah</a></li>
              <li><a href="index.php?sub=Kurikulum"><span class="glyphicon glyphicon-equalizer"></span> Kurikulum</a></li>
              <li><a href="index.php?sub=kelaskuliah"><span class="glyphicon glyphicon-compressed"></span> Kelas perkuliahan</a></li>
              <li><a href="index.php?sub=krs"><span class="glyphicon glyphicon-new-window"></span> Input KRS</a></li>
              <li><a href="index.php?sub=nilaimhs"><span class="glyphicon glyphicon-random"></span> Input Nilai Mahasiswa</a></li>
              <li><a href="index.php?sub=aktivitasmhs"><span class=" glyphicon glyphicon-book"></span> Aktifitas Kuliah Mahasiswa</a></li>
              <li><a href="index.php?sub=hapusaktivitasmhs"><span class=" glyphicon glyphicon-book"></span> Hapus masal Aktifitas Kuliah Mahasiswa</a></li>
              <li><a href="index.php?sub=mhs_lulus"><span class=" glyphicon glyphicon-education"></span> Daftar Mahasiswa Lulus/DO</a></li>
              <li><a href="index.php?sub=dosen"><span class=" glyphicon glyphicon-arrow-right"></span> Input Kegiatan mengajar Dosen</a></li>
              <li><a href="index.php?sub=test"><span class="glyphicon glyphicon-random"></span> Testing</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Kegiatan Bimbingan <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?sub=aktivitasmhs">Aktivitas Mahasiswa</a></li>
            </ul>
          </li>
          <li><a href="index.php?sub=prodi">Prodi</a></li>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilitas <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="index.php?sub=wil">Data Wilayah</a></li>
              <li><a href="index.php?sub=statusmhs">Data Status Mahasiswa</a></li>
              <li><a href="index.php?sub=agama">Data Agama</a></li>
              <li><a href="index.php?sub=jenj">Jenjang Pendidikan</a></li>
              <li><a href="index.php?sub=periodekuliah">Setting Periode Perkuliahan</a></li>
              <li><a href="index.php?sub=smt">Semester</a></li>
              <li><a href="index.php?sub=periode">Periode Aktif</a></li>
              <li><a href="index.php?sub=kebutuhan_khusus">Kebutuhan Khusus</a></li>
              <li><a href="index.php?sub=alat_transportasi">Alat transportasi</a></li>
              <li><a href="index.php?sub=pekerjaan">Data Pekerjaan</a></li>
              <li><a href="index.php?sub=penghasilan">Data Penghasilan</a></li>
              <li><a href="index.php?sub=profilePT">Profile Kampus</a></li>
              <li><a href="index.php?sub=prodiall">Data Prodi</a></li>
              <li><a href="index.php?sub=jenisdaftar">Jenis Daftar</a></li>
              <li><a href="index.php?sub=jalurmasuk">jenis Jalur masuk</a></li>
              <li><a href="index.php?sub=pembiayaan">List Pembiayaan</a></li>
              <li><a href="index.php?sub=jenis_keluar">Jenis keluar</a></li>
              <li><a href="index.php?sub=list-riwayat-pendidikan">GetListRiwayatPendidikanMahasiswa</a></li>
              <li><a href="index.php?sub=dictionary">Get Dictionary</a></li>
            </ul>
          </li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php $token = $_SESSION['token'];
              $data = array('act' => 'GetProfilPT', 'token' => $token);
              include_once("config.php");
              $result = runWS($data);
              $a = json_decode($result);
              if ($a->error_code == 0) {
                foreach ($a->data as $row) {
                  echo $row->nama_perguruan_tinggi;
                  // print_r($row);
                }
              ?></a></li>
          <li><a href="index.php?sub=logout"><span class="glyphicon glyphicon-log-in"></span> logout</a></li>
        </ul>
      </div>
    </nav>

    <!-- isi sebuah halaman -->
    <div class="container-fluid">
  <?php
    if (isset($_GET['sub'])) {
      $submenu = $_GET['sub'];
      switch ($submenu) {
        case "list_mahasiswa":
          if (isset($_GET['list'])) {
            $subb = $_GET['list'];
            switch ($subb) {
              case '1':
                include("mahasiswa/view_update_riwayat_pendidikan.php");
                break;
              case '2':
                include("mahasiswa/multi_insert.php");
                break;
              default:
                include("mahasiswa/list_mahasiswa.php");
                break;
            }
          } else {
            include("mahasiswa/list_mahasiswa.php");
          }
          break;
        case 'aktivitasmhs';
          include('aktivitasmhs/index.php');

          break;
        case 'login':
          include("auth/login.php");
          break;
        case 'matkul':
          include("mata_kuliah/list_matkul.php");
          break;
        case 'nilaiTransfer':
          include("nilai_transfer/view_nilai_transfer.php");
          break;
        case 'logout':
          include("auth/logout.php");
          break;
        case 'prodi':
          include("other/prodiPT.php");
          break;
        case 'wil':
          include("other/list_wilayah.php");
          break;
        case 'jenj':
          include("other/list_jenjang_pendidikan.php");
          break;
        case 'smt':
          include("other/list_semester.php");
          break;
        case 'periode':
          include("other/list_get_periode_aktif.php");
          break;
        case 'kebutuhan_khusus':
          include("other/list_kebutuhan_khusus.php");
          break;
        case 'alat_transportasi':
          include("other/list_alat_transportasi.php");
          break;
        case 'pekerjaan':
          include("other/list_pekerjaan.php");
          break;
        case 'penghasilan':
          include("other/list_penghasilan.php");
          break;
        case 'agama':
          include("other/list_agama.php");
          break;
        case 'statusmhs':
          include("other/list_get_status_mahasiswa.php");
          break;
        case 'profilePT':
          include("other/profilePT.php");
          break;
        case 'periodekuliah':
          include("periode-perkuliahan/view-periode-perkuliahan.php");
          break;
        case 'dictionary':
          include("other/getDictionary.php");
          break;
        case 'jenisdaftar':
          include("other/list_jenis_daftar.php");
          break;
        case 'pembiayaan':
          include("other/list_jenis_daftar.php");
          break;
        case 'jalurmasuk':
          include("other/list_jalur_masuk.php");
          break;
        case 'kelaskuliah':
          include("kelas_kuliah/view_kelas_kuliah.php");
          break;
        case 'krs':
          include("kelas_kuliah/view_krs_mahasiswa.php");
          break;
        case 'nilaimhs':
          include("kelas_kuliah/view_nilai.php");
          break;
        case 'aktivitasmhs':
          include("aktivitasPerkuliahan/view_aktivitas_perkuliahan.php");
          break;
        case 'hapusaktivitasmhs':
          include("aktivitasPerkuliahan/deleteakm/view_aktivitas_perkuliahan.php");
          break;
        case 'mhs_lulus':
          include("mahasiswa-lulus/view_mhs_lulus.php");
          break;
        case 'Kurikulum':
          include("kurikulum/GetDetailKurikulum.php");
          break;
        case 'jenis_keluar':
          include("other/list_jalur_keluar.php");
          break;
        case 'list-riwayat-pendidikan':
          include("riwayat_pendidikan/view_data.php");
          break;
        case 'dosen':
          include("dosen/view_dosen_ajar.php");
          break;
        case 'test':
          include("test/test.php");
          break;
        default:
          # code...
          break;
      }
    }
  } else {
    // header("location:auth/login.php");
    echo "<script>window.location.href='auth/login.php'</script>";
  }
}
// }else{
//   echo "Error : ".$a->error_desc;
//     // header("location:index.php?sub=login");
//   // echo "<li><a href='index.php?sub=login'><span class='glyphicon glyphicon-log-in'></span> Login</a></li>";
// }
  ?>
    </div>

  </body>

  </html>