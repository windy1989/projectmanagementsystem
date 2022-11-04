<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			$tempid = dekripsi($_POST['temp1']);
			$namapemilik = $_POST['namapemilik1'];
			$norek = $_POST['norek1'];
			$namabank = $_POST['namabank1'];
			$saldo = $_POST['saldo'];
			$cabang = $_POST['cabang1'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,15);
			
			if($tempid == ''){
				$stmt = $dbh->prepare("INSERT INTO sim_bank VALUES (DEFAULT,?,?,?,?,?,?,DEFAULT)");
				$stmt->execute([$namapemilik,$kode,$norek,$namabank,$cabang,$saldo]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("INSERT INTO sim_bank VALUES (DEFAULT,?,?,?,?,?,?,DEFAULT)");
					$stmtku->execute([$namapemilik,$kode,$norek,$namabank,$cabang,$saldo]);
				}
				
				echo "1";
			}else{
				$stmt = $dbh->prepare("UPDATE sim_bank SET NAMA_PEMILIK=?,NO_REKENING=?,NAMA_BANK=?,CABANG=?,SALDO=?,TGL_EDIT=DEFAULT WHERE KODE = ?");
				$stmt->execute([$namapemilik,$norek,$namabank,$cabang,$saldo,$tempid]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("UPDATE sim_bank SET NAMA_PEMILIK=?,NO_REKENING=?,NAMA_BANK=?,CABANG=?,SALDO=?,TGL_EDIT=DEFAULT WHERE KODE = ?");
					$stmtku->execute([$namapemilik,$norek,$namabank,$cabang,$saldo,$tempid]);
				}
				
				echo "1";
			}
		
		}elseif($metode == "hapus"){
			$arrID = $_POST['arrID'];
			for($i = 0; $i<count($arrID); $i++){
				$sthapus = $dbh->prepare("DELETE FROM sim_bank WHERE KODE = ?");
				$sthapus->execute([dekripsi($arrID[$i])]);
				if($koneksipusat){
					$sthapusku = $conn->prepare("DELETE FROM sim_bank WHERE KODE = ?");
					$sthapusku->execute([dekripsi($arrID[$i])]);
				}
			}
		}elseif($metode == "dapatkan"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_bank WHERE KODE = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			
			$data = [
				'kode' => enkripsi($result['KODE']),
				'namapemilik' => $result['NAMA_PEMILIK'],
				'norek' => $result['NO_REKENING'],
				'namabank' => $result['NAMA_BANK'],
				'cabang' => $result['CABANG'],
				'saldo' => $result['SALDO']
			];
			
			header('Content-type: application/json');
			echo json_encode($data);
		}
	}else{
		$stmt = $dbh->prepare("SELECT * FROM sim_bank ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simbank.php';
	}
?>