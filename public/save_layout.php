<?php

//save current thumbnail positions to a file. Accessed via POST request.

$positions = $_POST['new_positions'];

if(json_decode($positions)){
	file_put_contents('positions.json',$positions);
}

return true;

?>