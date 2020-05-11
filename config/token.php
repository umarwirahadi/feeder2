<?php 
require_once('nusoap/nusoap.php');
require_once('nusoap/class.wsdlcache.php');

$url='192.168.173.173:8082/ws/live.php?wsdl';


$client = new nusoap_client($url,true);
$proxy  = $client->getProxy();

$username	='045027';
$pass		='050104piksi680401';

$result=$proxy->GetToken($username,$pass);
$token=$result;

echo $token;
 ?>