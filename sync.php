<?php 
	include "plugins/Sync/AbstractSync.php";
	include "plugins/Sync/Server.php";
	
	const SECRET = 'secretlovesong'; //make this long and complicated
	const PATH = 'adminpage/pages/'; //sync all files and folders below this path

	$server = new \Outlandish\Sync\Server(SECRET, PATH);
	$server->run(); //process the request
?>