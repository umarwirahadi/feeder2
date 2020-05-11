<?php
require_once('../config/koneksi.php');
$query="delete from mahasiswa";
$res=$cn->query($query);
header('location:http://localhost/piksi/index.php?sub=list_mahasiswa&list=2');
?>
