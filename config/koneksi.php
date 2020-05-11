<?php
$host	="localhost";
$user	="root";
$pwd	="";
$db		="db_feeder";
$cn=new mysqli($host,$user,$pwd,$db);
if(!$cn){
	echo "gagal memilih database";
}
?>
