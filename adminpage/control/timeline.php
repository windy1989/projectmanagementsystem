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
		if(isset($param)){
			$kode = dekripsi(explode('=',$param)[1]);
			
			$stmtproyek = $dbh->prepare("SELECT NAMA,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,'',NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN FROM sim_proyek WHERE KODE = ?");
			$stmtproyek->execute([$kode]);
			$rowproyek = $stmtproyek->fetch();
			
			$stmt = $dbh->prepare("SELECT * FROM sim_timeline WHERE KODE = ? ORDER BY TGL_INPUT DESC");
			$stmt->execute([$kode]);
			
			require 'adminpage/pages/simdetailtimeline.php';
		}else{
			$arrColor = array("#ff1a1a","#ff4d4d","#ff9999","#ff4d94","#ffbf80","#66ff66","#1aff1a","#00e600","#4db8ff","#0099ff");
			$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,KETERANGAN_PERUNTUKAN,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS,IFNULL((SELECT KODE FROM sim_proyekteknis WHERE KODE_PROYEK = KODE),'') AS INFOTEKNIS FROM sim_proyek ORDER BY ID ASC");
			$stmt->execute();
			require 'adminpage/pages/simtimeline.php';
		}
	}
?>