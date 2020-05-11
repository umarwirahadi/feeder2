<?php 
session_start();
require_once('../config/koneksi.php');
$no=$cn->real_escape_string($_GET['id']);
if($cn->query("select *  from mahasiswa where no='$no'")){


}else{
	echo "error :".$cn->error;
}
 ?>