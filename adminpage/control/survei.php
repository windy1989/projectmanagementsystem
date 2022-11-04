<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			$kodeproyek = dekripsi($_POST['kd1']);
			$surveyor = $_POST['surveyor1'];
			$tglmulai = $_POST['tglmulai1'];
			$tglselesai = $_POST['tglselesai1'];
			$letakfile = $_POST['letakfile1'];
			$itemsurvei = $_POST['itemsurvei1'];
			$keterangan = $_POST['keterangan1'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,15);
			
			/* $ceking = $dbh->prepare("SELECT * FROM sim_proyeksurvei WHERE KODE_PROYEK = ?");
			$ceking->execute([$kodeproyek]);
			$jumceking = $ceking->rowCount();
			
			if($jumceking > 0){
				$stmt = $dbh->prepare("UPDATE sim_proyeksurvei SET SURVEYOR=?,TGL_MULAI=?,TGL_SELESAI=?,LETAK_FILE=?,KETERANGAN=?,TGL_EDIT=DEFAULT WHERE KODE_PROYEK = ?");
				$stmt->execute([$surveyor,$tglmulai,$tglselesai,$letakfile,$keterangan,$kodeproyek]);
				echo "1";
			}else{ */
				$stmt = $dbh->prepare("INSERT INTO sim_proyeksurvei VALUES (DEFAULT,?,?,?,?,?,?,?,?,DEFAULT)");
				$stmt->execute([$kode,$kodeproyek,$surveyor,$tglmulai,$tglselesai,$letakfile,$itemsurvei,$keterangan]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("INSERT INTO sim_proyeksurvei VALUES (DEFAULT,?,?,?,?,?,?,?,?,DEFAULT)");
					$stmtku->execute([$kode,$kodeproyek,$surveyor,$tglmulai,$tglselesai,$letakfile,$itemsurvei,$keterangan]);
				}
				
				$stmtupdate1 = $dbh->prepare("UPDATE sim_proyek SET STATUS = 2 WHERE KODE = ?");
				$stmtupdate1->execute([$kodeproyek]);
				
				if($koneksipusat){
					$stmtupdate1ku = $conn->prepare("UPDATE sim_proyek SET STATUS = 2 WHERE KODE = ?");
					$stmtupdate1ku->execute([$kodeproyek]);
				}
				
				updateLog($kodeproyek,'Survei akan/telah dilaksanakan oleh '.$surveyor.' mulai tgl. '.$tglmulai.' s/d. '.$tglselesai);
				
				echo "1";
			//}
		
		}elseif($metode == "hapus"){
			$kode = $_POST['kd1'];
			$sthapus = $dbh->prepare("DELETE FROM sim_proyeksurvei WHERE KODE = ?");
			$sthapus->execute([$kode]);
			
			if($koneksipusat){
				$sthapusku = $conn->prepare("DELETE FROM sim_proyeksurvei WHERE KODE = ?");
				$sthapusku->execute([$kode]);
			}
		}elseif($metode == "dapatkan"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_proyeksurvei WHERE KODE_PROYEK = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetchAll();
						
			header('Content-type: application/json');
			echo json_encode($result);
		}
	}else{
		$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,KETERANGAN_PERUNTUKAN,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS,IFNULL((SELECT KODE FROM sim_proyeksurvei WHERE KODE_PROYEK = KODE),'') AS INFOSURVEI FROM sim_proyek WHERE STATUS = 1 ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simsurvei.php';
	}
?>