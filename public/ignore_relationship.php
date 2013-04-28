<?php

//save current thumbnail positions to a file. Accessed via POST request.

$from = $_POST['from'];
$to = $_POST['to'];

if(file_exists('ignore_rel.json'))
{
	//reorder json array for easy access.
	$ignores = json_decode(file_get_contents('ignore_rel.json'),true);

}

$ignores[$from][] = $to;

file_put_contents('ignore_rel.json',json_encode($ignores));


return true;

?>