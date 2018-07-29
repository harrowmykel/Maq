# Maq
Maq is an http Api query method made simple. 29.7.18.. Miriamu

it is built on Nategood's Httpful https://github.com/nategood/httpful
designed to work like the JQuery Ajax Method $.ajax({});

	include "maq.php";
	$maq = new Maq();
	$post_param=array("url"=>"api.php", 
				"datatype"=>"json", //or text
				"data"=>"req=android&s=s", 
				"baseurl"=>$url);
	$res=$maq->post($post_param);
	$res=$maq->get($post_param);
	var_dump($res->body);
