<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			$tempid = dekripsi($_POST['temp1']);
			$nama = $_POST['nama1'];
			$keterangan = $_POST['ket1'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,15);
			
			if($tempid == ''){
				$stmt = $dbh->prepare("INSERT INTO sim_syarat VALUES (DEFAULT,?,?,?,DEFAULT,1)");
				$stmt->execute([$nama,$kode,$keterangan]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("INSERT INTO sim_syarat VALUES (DEFAULT,?,?,?,DEFAULT,1)");
					$stmtku->execute([$nama,$kode,$keterangan]);
				}
				
				echo "1";
			}else{
				$stmt = $dbh->prepare("UPDATE sim_syarat SET NAMA=?,KETERANGAN=?,TGL_EDIT=DEFAULT WHERE KODE = ?");
				$stmt->execute([$nama,$keterangan,$tempid]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("UPDATE sim_syarat SET NAMA=?,KETERANGAN=?,TGL_EDIT=DEFAULT WHERE KODE = ?");
					$stmtku->execute([$nama,$keterangan,$tempid]);
				}
				
				echo "1";
			}
		
		}elseif($metode == "hapus"){
			$arrID = $_POST['arrID'];
			for($i = 0; $i<count($arrID); $i++){
				$sthapus = $dbh->prepare("DELETE FROM sim_syarat WHERE KODE = ?");
				$sthapus->execute([dekripsi($arrID[$i])]);
				
				if($koneksipusat){
					$sthapusku = $conn->prepare("DELETE FROM sim_syarat WHERE KODE = ?");
					$sthapusku->execute([dekripsi($arrID[$i])]);
				}
			}
		}elseif($metode == "dapatkan"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_syarat WHERE KODE = ?");
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
		$stmt = $dbh->prepare("SELECT * FROM sim_syarat ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simsyarat.php';
	}
?>