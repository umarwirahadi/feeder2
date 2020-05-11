<?php 

function runWS($data,$type='json'){

	// $url ='http://192.168.128.118:8082/ws/live2.php';
	 $url ='http://localhost:8082/ws/live2.php';

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_POST,1);
	$headers=array();

	if($type=='xml')
		$headers[]='content-type: application/xml';
	else
		$headers[]='content-type: application/json';
	curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
	if($data){
		if($type=='xml'){
			$data=stringxml($data);
		}else{
			$data=json_encode($data);
		}
		curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
	}
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$result=curl_exec($ch);
	curl_close($ch);
	return $result;
}

function stringXML($data) {
		$xml = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
		$this->array_to_xml($data, $xml);
		return $xml->asXML();
	}

function array_to_xml( $data, &$xml_data ) {
		foreach( $data as $key => $value ) {
			if( is_array($value) ) {
				$subnode = $xml_data->addChild($key);
				$this->array_to_xml($value, $subnode);
			} else {
				$xml_data->addChild("$key",$value);
			}
		}
	}	

 ?>