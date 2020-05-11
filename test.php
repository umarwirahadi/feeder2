<?php 
require_once('config/nusoap/nusoap.php');
require_once('config/nusoap/class.wsdlcache.php');
require_once('config.php');

$usr  ='045027';
$pwd  ='050104piksi680401';
$data         =array(
              'act'=>'GetToken',
              'username'=>$usr,
              'password'=>$pwd
              );

$result=runWS($data);





$url ='http://192.168.173.173:8082/ws/sanbox.php?wsdl';//just for test
// $url ='http://192.168.173.173:8082/ws/live2.php?wsdl';//Real execution

$client 	=new nusoap_client($url,true);

$proxy		=$client->getProxy();

// $user		="045027";
// $pass		="050104piksi680401";

// $result		=$proxy->GetToken($user,$pass);
// $token 		=$result;
// echo $token;
$list		=$proxy->ListTable("e6f667f37ce33bb4b51198e0e1cd96be");
print_r($list);

 ?>