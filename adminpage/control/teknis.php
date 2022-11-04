<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			$kodeproyek = dekripsi($_POST['kd1']);
			$nodokumen = $_POST['nodokumen1'];
			$tglmulai = $_POST['tglmulai1'];
			$tglselesai = $_POST['tglselesai1'];
			$letakfile = $_POST['letakfile1'];
			$keterangan = $_POST['keterangan1'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,15);
			
			$stmt = $dbh->prepare("INSERT INTO sim_proyekteknis VALUES (DEFAULT,?,?,?,?,?,?,?,DEFAULT)");
			$stmt->execute([$kode,$kodeproyek,$nodokumen,$tglmulai,$tglselesai,$letakfile,$keterangan]);
			
			if($koneksipusat){
				$stmtku = $conn->prepare("INSERT INTO sim_proyekteknis VALUES (DEFAULT,?,?,?,?,?,?,?,DEFAULT)");
				$stmtku->execute([$kode,$kodeproyek,$nodokumen,$tglmulai,$tglselesai,$letakfile,$keterangan]);
			}
			
			updateLog($kodeproyek,'Tim teknis akan/telah menyelesaikan pekerjaan dari tgl. '.$tglmulai.' s/d. '.$tglselesai);
			
			$stmtupdate1 = $dbh->prepare("UPDATE sim_proyek SET STATUS = 4 WHERE KODE = ?");
			$stmtupdate1->execute([$kodeproyek]);
			
			if($koneksipusat){
				$stmtupdate1ku = $conn->prepare("UPDATE sim_proyek SET STATUS = 4 WHERE KODE = ?");
				$stmtupdate1ku->execute([$kodeproyek]);
			}
			
			echo "1";
		
		}elseif($metode == "hapus"){
			$kode = $_POST['kd1'];
			$sthapus = $dbh->prepare("DELETE FROM sim_proyekteknis WHERE KODE = ?");
			$sthapus->execute([$kode]);
		
			if($koneksipusat){
				$sthapusku = $conn->prepare("DELETE FROM sim_proyekteknis WHERE KODE = ?");
				$sthapusku->execute([$kode]);
			}
		}elseif($metode == "dapatkan"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_proyekteknis WHERE KODE_PROYEK = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetchAll();
						
			header('Content-type: application/json');
			echo json_encode($result);
		}
	}else{
		$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,KETERANGAN_PERUNTUKAN,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS,IFNULL((SELECT KODE FROM sim_proyekteknis WHERE KODE_PROYEK = KODE),'') AS INFOTEKNIS FROM sim_proyek WHERE STATUS IN (3,8) ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simteknis.php';
	}
?>