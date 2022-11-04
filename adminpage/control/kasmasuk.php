<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "tampil"){
			
		}elseif($metode == "hapus"){
			
		}elseif($metode == "dapatkan"){

		}
	}else{
		$stmt = $dbh->prepare("SELECT SUM(NOMINAL) AS TOTAL,KODE_PROYEK,(SELECT CONCAT(NAMA,' ',LOKASI,' ',KOTA) FROM sim_proyek WHERE KODE = KODE_PROYEK) AS INFOPROYEK, GROUP_CONCAT(PEMBAYARAN_KE ORDER BY PEMBAYARAN_KE ASC SEPARATOR ', ') AS PEMBAYARAN FROM sim_proyekpembayaran WHERE SUDAH_DIBAYAR = 'SUDAH DIBAYAR' AND NO_KWITANSI <> '' GROUP BY KODE_PROYEK");
		$stmt->execute();
		require 'adminpage/pages/simkasmasuk.php';
	}
?>