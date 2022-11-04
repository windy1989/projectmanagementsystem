<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpanjenis"){
			$tempid = dekripsi($_POST['temp1']);
			$nama = $_POST['nama1'];
			$keterangan = $_POST['ket1'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,15);
			
			if($tempid == ''){
				$stmt = $dbh->prepare("INSERT INTO sim_jenis VALUES (DEFAULT,?,?,?,1)");
				$stmt->execute([$nama,$kode,$keterangan]);
				if($koneksipusat){
					$stmtku = $conn->prepare("INSERT INTO sim_jenis VALUES (DEFAULT,?,?,?,1)");
					$stmtku->execute([$nama,$kode,$keterangan]);
				}
				echo "1";
			}else{
				$stmt = $dbh->prepare("UPDATE sim_jenis SET NAMA=?,KETERANGAN=? WHERE KODE = ?");
				$stmt->execute([$nama,$keterangan,$tempid]);
				if($koneksipusat){
					$stmtku = $conn->prepare("UPDATE sim_jenis SET NAMA=?,KETERANGAN=? WHERE KODE = ?");
					$stmtku->execute([$nama,$keterangan,$tempid]);
				}
				echo "1";
			}
		
		}elseif($metode == "simpanperuntukan"){
			$tempid = dekripsi($_POST['temp1']);
			$nama = $_POST['nama1'];
			$keterangan = $_POST['ket1'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,15);
			
			if($tempid == ''){
				$stmt = $dbh->prepare("INSERT INTO sim_peruntukan VALUES (DEFAULT,?,?,?,1)");
				$stmt->execute([$nama,$kode,$keterangan]);
				if($koneksipusat){
					$stmtku = $conn->prepare("INSERT INTO sim_peruntukan VALUES (DEFAULT,?,?,?,1)");
					$stmtku->execute([$nama,$kode,$keterangan]);
				}
				echo "1";
			}else{
				$stmt = $dbh->prepare("UPDATE sim_peruntukan SET NAMA=?,KETERANGAN=? WHERE KODE = ?");
				$stmt->execute([$nama,$keterangan,$tempid]);
				if($koneksipusat){
					$stmtku = $conn->prepare("UPDATE sim_peruntukan SET NAMA=?,KETERANGAN=? WHERE KODE = ?");
					$stmtku->execute([$nama,$keterangan,$tempid]);
				}
				echo "1";
			}
		}elseif($metode == "hapusjenis"){
			$arrID = $_POST['arrID'];
			for($i = 0; $i<count($arrID); $i++){
				$sthapus = $dbh->prepare("DELETE FROM sim_jenis WHERE KODE = ?");
				$sthapus->execute([dekripsi($arrID[$i])]);
				if($koneksipusat){
					$sthapusku = $conn->prepare("DELETE FROM sim_jenis WHERE KODE = ?");
					$sthapusku->execute([dekripsi($arrID[$i])]);
				}
			}
		}elseif($metode == "hapusperuntukan"){
			$arrID = $_POST['arrID'];
			for($i = 0; $i<count($arrID); $i++){
				$sthapus = $dbh->prepare("DELETE FROM sim_peruntukan WHERE KODE = ?");
				$sthapus->execute([dekripsi($arrID[$i])]);
				if($koneksipusat){
					$sthapusku = $conn->prepare("DELETE FROM sim_peruntukan WHERE KODE = ?");
					$sthapusku->execute([dekripsi($arrID[$i])]);
				}
			}
		}elseif($metode == "dapatkanjenis"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_jenis WHERE KODE = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			
			$data = [
				'kode' => enkripsi($result['KODE']),
				'nama' => $result['NAMA'],
				'keterangan' => $result['KETERANGAN']
			];
			
			header('Content-type: application/json');
			echo json_encode($data);
		}elseif($metode == "dapatkanperuntukan"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_peruntukan WHERE KODE = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			
			$data = [
				'kode' => enkripsi($result['KODE']),
				'nama' => $result['NAMA'],
				'keterangan' => $result['KETERANGAN']
			];
			
			header('Content-type: application/json');
			echo json_encode($data);
		}
	}else{
		$stmtjenis = $dbh->prepare("SELECT * FROM sim_jenis ORDER BY ID ASC");
		$stmtjenis->execute();
		$stmtuntuk = $dbh->prepare("SELECT * FROM sim_peruntukan ORDER BY ID ASC");
		$stmtuntuk->execute();
		require 'adminpage/pages/simjenis.php';
	}
?>