<?php 
require_once('config/nusoap/nusoap.php');
require_once('config/nusoap/class.wsdlcache.php');
require_once('config.php');

$usr  ='kode pt';
$pwd  ='password';
$data         =array(
              'act'=>'GetToken',
              'username'=>$usr,
              'password'=>$pwd
              );

$result=runWS($data);





// $url ='http://localhost:8082/ws/live2.php?wsdl';//Real execution

$client 	=new nusoap_client($url,true);

$proxy		=$client->getProxy();

$list		=$proxy->ListTable("e6f667f37ce33bb4b51198e0e1cd96be");
print_r($list);

 ?>