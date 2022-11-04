<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		
	}else{
		$stmt = $dbh->prepare("SELECT KODE, UNTUK, ID_BANK, (SELECT NAMA_BANK FROM sim_bank WHERE ID = ID_BANK) AS NAMABANK, NOMINAL, TGL_TRANSAKSI, KETERANGAN, BUKTI, STATUS FROM sim_kasmasukkecil ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simkasmasukkecil.php';
	}
?>