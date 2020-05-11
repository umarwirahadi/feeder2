<?php 
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE ^ E_DEPRECATED);

session_start();

$url='http://192.168.173.173:8082/ws/live2.php';

$token=$_SESSION['token'];
function runWS($data,$type='json'){
	 global $url;

	 $ch=curl_init();

	 curl_setopt($ch,CURLOPT_POST, 1);

	 $headers=array();
	 if($type=='xml')
		 $headers[]='Content-Type: application/xml';
	 else
	 	 $headers[]='Content-Type: application/xml';

	 curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);

	 if($data){
	 	if($type=='xml'){
	 		$data=stringXML($data);
	 	}
	 	else{
	 		$data=json_encode($data);
	 	}
	 	curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
	 }
	 curl_setopt($ch, CURLOPT_URL, $url);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 $result=curl_exec($ch);
	 curl_close($ch);
	 
	 return $result;
}

function stringXML($data){
	$xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
	array_to_xml($data, $xml);
	return $xml->asXML();	
}
function array_to_xml($data, &$xml_data){
	foreach ($data as $key => $value) {
		if(is_array($value)){
			$subnode=$xml_data->addChild($key);
			array_to_xml($value,$subnode);
		}else{
			$xml_data->addChild("$key",$value);
		}
	}
}

$username	='045027';
$pass		='050104piksi680401';
$data=array('act'=>'GetToken',
			'username'=>$username,
			'password'=>$pass);

$result_string=runWS($data,'xml');
$token =$result_string;
// echo "<pre>";
// echo $token;
// echo "</pre>";
// echo $toke;
$filter	='';
$order	='';
$limit	=20;
$offset	=0;
$data1 	=array(
				'act'=>'GetProfilPT',
				'token'=>$token,
				'filter'=>$filter,
				'order'=>$order,
				'limit'=>$limit,
				'offset'=>$offset,
			  );
$result=runWS($data1,'xml');
echo "<br>";
echo "<br>";
echo "<br>";
echo $result;
 ?>