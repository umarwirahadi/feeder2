<?php
error_reporting(0);
session_start();
include_once("../config.php");
include_once("../config/koneksi.php");
$token =$_SESSION['token'];
$sql="select * from insertkurikulum where status='0'";
if($res=$cn->query($sql)){
if($res->num_rows>=1){
  while ($rw=$res->fetch_array()) {
    $id=$rw[0];
    $nama_prodi=$rw['nama_prodi'];
    $jenjang=$rw['jenjang'];
  $filter_prodi="nama_program_studi='$nama_prodi' and nama_jenjang_pendidikan='$jenjang'";
  $data2 =array("act"=>"GetProdi","token"=>$token,"filter"=>$filter_prodi,"limit"=>"1");
  $result2=json_decode(runWS($data2));
  if($result2->erro_code==0 && (!empty($result2->data))){
    foreach ($result2->data as $key) {
      $idprodi=$key->id_prodi;
      $cn->query($sql="update insertkurikulum set id_prodi='$idprodi',desk='' where id=' $id'");      
    }
  }else{
    $erro_code=$result2->erro_code;
    $erro_desc=$result2->erro_desc;
    $gabungan =$erro_code."-".$erro_desc;
    $cn->query($sql="update insertkurikulum set desk='$gabungan' where id=' $id'");
  }
  }
}
$cn->query("update insertkurikulum set status='1' where id_prodi IS NOT NULL");
}
header("location:../index.php?sub=Kurikulum&idkurikulum=input-kurikulum");
?>
