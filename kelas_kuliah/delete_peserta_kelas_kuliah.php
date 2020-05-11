<?php 
$query="select id_semester where a_periode_aktif='1'";
if($res=$cn->query($query)){
	if($res->row_count>=1){
echo "ada datanya";
	}
}

 ?>