<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			
		
		}elseif($metode == "hapus"){
			
		}elseif($metode == "dapatkan"){
			
			
						
			header('Content-type: application/json');
			echo json_encode($result);
		}
	}else{
		$arrColor = array("#ff1a1a","#ff4d4d","#ff9999","#ff4d94","#ffbf80","#66ff66","#1aff1a","#00e600","#4db8ff","#0099ff");
		require 'adminpage/pages/simpanduan.php';
	}
?>