<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			$kodeproyek = dekripsi($_POST['kd1']);
			$noantri = $_POST['noantri1'];
			$nosurat = $_POST['nosurat1'];
			$tglmulai = $_POST['tglmulaiku'];
			$tglselesai = $_POST['tglselesaiku'];
			$letakfile = $_POST['letakfile1'];
			$keterangan = $_POST['keterangan1'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,15);
			
			$ceking = $dbh->prepare("SELECT * FROM sim_proyeksidang WHERE KODE_PROYEK = ?");
			$ceking->execute([$kodeproyek]);
			$arrceking = $ceking->fetch();
			$jumceking = $ceking->rowCount();
			
			if($jumceking > 0){
				$stmt = $dbh->prepare("UPDATE sim_proyeksidang SET NO_PENDAFTARAN_SIDANG=?,NO_SURAT_REKOMENDASI=?,TGL_MULAI=?,TGL_SELESAI=?,LETAK_FILE=?,KETERANGAN=?,TGL_EDIT=DEFAULT WHERE KODE_PROYEK = ?");
				$stmt->execute([$noantri,$nosurat,$tglmulai,$tglselesai,$letakfile,$keterangan,$kodeproyek]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("UPDATE sim_proyeksidang SET NO_PENDAFTARAN_SIDANG=?,NO_SURAT_REKOMENDASI=?,TGL_MULAI=?,TGL_SELESAI=?,LETAK_FILE=?,KETERANGAN=?,TGL_EDIT=DEFAULT WHERE KODE_PROYEK = ?");
					$stmtku->execute([$noantri,$nosurat,$tglmulai,$tglselesai,$letakfile,$keterangan,$kodeproyek]);
				}
				
				if($nosurat != ''){
					updateLog($kodeproyek,'Proyek telah mendapatkan surat rekomendasi dari Dishub.');
				}
				
			}else{
				$stmt = $dbh->prepare("INSERT INTO sim_proyeksidang VALUES (DEFAULT,?,?,?,?,?,?,?,?,DEFAULT)");
				$stmt->execute([$kode,$kodeproyek,$noantri,$nosurat,$tglmulai,$tglselesai,$letakfile,$keterangan]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("INSERT INTO sim_proyeksidang VALUES (DEFAULT,?,?,?,?,?,?,?,?,DEFAULT)");
					$stmtku->execute([$kode,$kodeproyek,$noantri,$nosurat,$tglmulai,$tglselesai,$letakfile,$keterangan]);
				}
				
				updateLog($kodeproyek,'Proyek telah mendapatkan nomor pendaftaran sidang');
				
				if($nosurat != ''){
					updateLog($kodeproyek,'Proyek telah mendapatkan surat rekomendasi dari Dishub.');
				}
			}
			
			if($nosurat == ''){
				$stmtupdate1 = $dbh->prepare("UPDATE sim_proyek SET STATUS = 6 WHERE KODE = ?");
				$stmtupdate1->execute([$kodeproyek]);
				
				if($koneksipusat){
					$stmtupdate1ku = $conn->prepare("UPDATE sim_proyek SET STATUS = 6 WHERE KODE = ?");
					$stmtupdate1ku->execute([$kodeproyek]);
				}
			}else{
				$stmtupdate1 = $dbh->prepare("UPDATE sim_proyek SET STATUS = 9 WHERE KODE = ?");
				$stmtupdate1->execute([$kodeproyek]);
				
				if($koneksipusat){
					$stmtupdate1ku = $conn->prepare("UPDATE sim_proyek SET STATUS = 9 WHERE KODE = ?");
					$stmtupdate1ku->execute([$kodeproyek]);
				}
			}
			
			echo "1";
		
		}elseif($metode == "hapus"){
			$kode = $_POST['kd1'];
			$sthapus = $dbh->prepare("DELETE FROM sim_proyeksidang WHERE KODE = ?");
			$sthapus->execute([$kode]);
			
			if($koneksipusat){
				$sthapusku = $conn->prepare("DELETE FROM sim_proyeksidang WHERE KODE = ?");
				$sthapusku->execute([$kode]);
			}
		}elseif($metode == "dapatkan"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_proyeksidang WHERE KODE_PROYEK = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetchAll();
						
			header('Content-type: application/json');
			echo json_encode($result);
		}
	}else{
		$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,KETERANGAN_PERUNTUKAN,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS,IFNULL((SELECT KODE FROM sim_proyekteknis WHERE KODE_PROYEK = KODE),'') AS INFOTEKNIS FROM sim_proyek WHERE STATUS = 5 OR STATUS = 7 ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simsidangdishub.php';
	}
?>