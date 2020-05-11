<?php	
	session_start();
	require_once('../config.php');
	$token=$_SESSION['token'];
	$nama_fungsi=strip_tags($_GET['nama_fungsi']);
	$data2 =array("act"=>"GetDictionary","token"=>$token,"fungsi"=>$nama_fungsi);
	$result2=json_decode(runWS($data2));
	echo "<pre>";
	print_r($result2->data);
	echo "</pre>";
?>