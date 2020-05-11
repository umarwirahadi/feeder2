<?php
if(isset($_POST['userID'])&&isset($_POST['pwd'])){
include("../config.php");
$username=$_POST['userID'];
$pwsd 	=$_POST['pwd'];
$usr 	=$username;
$pwd  	=$pwsd;
$data         =array(
              'act'=>'GetToken',
              'username'=>$usr,
              'password'=>$pwd
              );
$result=runWS($data);
$a=json_decode($result);
if ($a->error_code==0) {
	$token 		=$a->data->token;
}else{
	$token 		=$a->error_desc;
}
session_start();
// $_SESSION['status']	="live";
// $_SESSION['gagal']	=$kode_gagal;
$_SESSION['kodePT']	=$username;
$_SESSION['token']	=$token;
header('location:../index.php?sub=list_mahasiswa');
// echo '<script>window.lication.href="index.php?sub=list_mahasiswa";</script>';
}else{
	$err=$a->error_desc;
	echo("Maaf Anda gagal login :".$err);
}

?>