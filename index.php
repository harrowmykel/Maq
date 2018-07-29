<?php
$url="http://coursecode.com.ng/bckend/api/v1_2/api.php?fffg";
$url1="http://coursecode.com.ng/karten/";
	include "maq.php";
	$maq = new Maq();
	$post_param=array("url"=>"api.php", 
				"datatype"=>"json", 
				"data"=>"req=android&s=s", 
				"baseurl"=>$url1);
	$res=$maq->post($post_param);
	var_dump($res->body);
// text
?>