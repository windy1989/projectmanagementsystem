<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "cetakinvoice"){
			
			$kd = $_POST['kd1'];
			
			$stmt = $dbh->prepare("SELECT NO_INVOICE,KODE,KODE_PROYEK,(SELECT CONCAT(sp.NAMA,'^',sp.LOKASI,'^',sp.KOTA,'^',sp.NO_PROYEK,'^',ROUND(sp.BIAYA,0),'|',spg.NAMA_PEMILIK,spg.NAMA_PERUSAHAAN,'^',spg.ALAMAT,'^',spg.KOTA) FROM sim_proyek sp, sim_pelanggan spg WHERE sp.ID_PELANGGAN = spg.ID AND sp.KODE = KODE_PROYEK) AS INFOPROYEK,ID_BANK,(SELECT CONCAT(NAMA_BANK,' Cab.',CABANG,' No. Rekening <b>',NO_REKENING,'</b> A.n.: <b>',NAMA_PEMILIK,'</b>') FROM sim_bank WHERE ID = ID_BANK) AS INFOBANK,TGL_INVOICE,NOMINAL,PEMBAYARAN_KE,KETERANGAN,SUDAH_DIBAYAR FROM sim_proyekpembayaran WHERE KODE = ?");
			$stmt->execute([$kd]);
			$result = $stmt->fetch();
			
			require '../print/invoice.php';
		}elseif($metode == "cetakkwitansi"){
			$kd = $_POST['kd1'];
			
			$stmt = $dbh->prepare("SELECT NO_INVOICE,NO_KWITANSI,KODE,KODE_PROYEK,(SELECT CONCAT(sp.NAMA,'^',sp.LOKASI,'^',sp.KOTA,'^',sp.NO_PROYEK,'^',ROUND(sp.BIAYA,0),'|',spg.NAMA_PEMILIK,spg.NAMA_PERUSAHAAN,'^',spg.ALAMAT,'^',spg.KOTA) FROM sim_proyek sp, sim_pelanggan spg WHERE sp.ID_PELANGGAN = spg.ID AND sp.KODE = KODE_PROYEK) AS INFOPROYEK,ID_BANK,(SELECT CONCAT(NAMA_BANK,' Cab.',CABANG,' No. Rekening <b>',NO_REKENING,'</b> A.n.: <b>',NAMA_PEMILIK,'</b>') FROM sim_bank WHERE ID = ID_BANK) AS INFOBANK,TGL_BAYAR,NOMINAL,TERIMA_DARI,PEMBAYARAN_KE,KETERANGAN,SUDAH_DIBAYAR FROM sim_proyekpembayaran WHERE KODE = ?");
			$stmt->execute([$kd]);
			$result = $stmt->fetch();
			
			require '../print/kwitansi.php';
		}
	}else{
		//
	}
?>