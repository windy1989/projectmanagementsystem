<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "getMapPerlengkapanJalan"){
			
		}elseif($metode == "getMapHambatanSamping"){
			
		}elseif($metode == "getPersimpanganJalan"){
			
		}
	}else{
		$stmtuser = $dbh->prepare("SELECT * FROM sim_pelanggan");
		$stmtuser->execute();
		$jumuser = $stmtuser->rowCount();
		
		$stmtproyek = $dbh->prepare("SELECT * FROM sim_proyek");
		$stmtproyek->execute();
		$jumproyek = $stmtproyek->rowCount();
		
		$stmtpemasukan = $dbh->prepare("SELECT SUM(BIAYA) AS TOTAL,(SELECT SUM(NOMINAL) AS TOTALI FROM sim_proyekpembayaran) AS TOTALI FROM sim_proyek");
		$stmtpemasukan->execute();
		$rowpemasukan = $stmtpemasukan->fetch();
		
		require 'adminpage/pages/simhome.php';
	}
?>