<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			$namalengkap = $_POST['namalengkap1'];
			$namapengguna = $_POST['namapengguna1'];
			$password = $_POST['password1'];
			$email = $_POST['email1'];
			$kodepegawai = $_POST['kodepegawai1'];
			$alamat = $_POST['alamat1'];
			$jk = $_POST['jk1'];
			$hakakses = $_POST['hakakses1'];
			$tempid = $_POST['tempid1'];
			$aktif = $_POST['aktif1'];
			
			if($tempid == ''){
				$stmtcek = $dbh->prepare("SELECT * FROM sim_pengguna WHERE USERNAME = ?");
				$stmtcek->execute([$namapengguna]);
				$jumcek = $stmtcek->rowCount();
				
				if($jumcek > 0){
					echo "0";
				}else{
					$stmt = $dbh->prepare("INSERT INTO sim_pengguna VALUES (DEFAULT,?,?,?,?,?,?,?,?,?)");
					$stmt->execute([$namapengguna,password_hash($password,PASSWORD_DEFAULT),$email,$namalengkap,$kodepegawai,$alamat,$jk,$hakakses,$aktif]);
					if($koneksipusat){
						$stmtku = $conn->prepare("INSERT INTO sim_pengguna VALUES (DEFAULT,?,?,?,?,?,?,?,?,?)");
						$stmtku->execute([$namapengguna,password_hash($password,PASSWORD_DEFAULT),$email,$namalengkap,$kodepegawai,$alamat,$jk,$hakakses,$aktif]);
					}
					
					echo "1";
				}
			}else{
				if($password == ""){
					$stmt = $dbh->prepare("UPDATE sim_pengguna SET USERNAME = ?, EMAIL = ?, NAMA_LENGKAP = ?, KODE_PEGAWAI = ?, ALAMAT = ?, JK = ?, HAK_AKSES = ?, STATUS = ? WHERE ID = ?");
					$stmt->execute([$namapengguna,$email,$namalengkap,$kodepegawai,$alamat,$jk,$hakakses,$aktif,$tempid]);
					
					if($koneksipusat){
						$stmtku = $conn->prepare("UPDATE sim_pengguna SET USERNAME = ?, EMAIL = ?, NAMA_LENGKAP = ?, KODE_PEGAWAI = ?, ALAMAT = ?, JK = ?, HAK_AKSES = ?, STATUS = ? WHERE ID = ?");
						$stmtku->execute([$namapengguna,$email,$namalengkap,$kodepegawai,$alamat,$jk,$hakakses,$aktif,$tempid]);
					}
					
				}else{
					$stmt = $dbh->prepare("UPDATE sim_pengguna SET USERNAME = ?, PASSWORD = ?, EMAIL = ?, NAMA_LENGKAP = ?, KODE_PEGAWAI = ?, ALAMAT = ?, JK = ?, HAK_AKSES = ?, STATUS = ? WHERE ID = ?");
					$stmt->execute([$namapengguna,password_hash($password,PASSWORD_DEFAULT),$email,$namalengkap,$kodepegawai,$alamat,$jk,$hakakses,$aktif,$tempid]);
					
					if($koneksipusat){
						$stmtku = $conn->prepare("UPDATE sim_pengguna SET USERNAME = ?, PASSWORD = ?, EMAIL = ?, NAMA_LENGKAP = ?, KODE_PEGAWAI = ?, ALAMAT = ?, JK = ?, HAK_AKSES = ?, STATUS = ? WHERE ID = ?");
						$stmtku->execute([$namapengguna,password_hash($password,PASSWORD_DEFAULT),$email,$namalengkap,$kodepegawai,$alamat,$jk,$hakakses,$aktif,$tempid]);
					}
				}
				echo "1";
			}
			
		}elseif($metode == "hapus"){
			$arrID = $_POST['arrID'];
			for($i = 0; $i<count($arrID); $i++){
				$sthapus = $dbh->prepare("DELETE FROM sim_pengguna WHERE ID = ?");
				$sthapus->execute([$arrID[$i]]);
				
				if($koneksipusat){
					$sthapusku = $conn->prepare("DELETE FROM sim_pengguna WHERE ID = ?");
					$sthapusku->execute([$arrID[$i]]);
				}
			}
		}elseif($metode == "dapatkan"){
			$id = $_POST['id'];
			
			$stmt = $dbh->prepare("SELECT NAMA_LENGKAP,EMAIL,USERNAME,KODE_PEGAWAI,ALAMAT,JK,HAK_AKSES,STATUS FROM sim_pengguna WHERE ID = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetchAll();
			
			$return = [];
			foreach ($result as $row) {
				$return[] = [ 
					'namalengkap' => $row['NAMA_LENGKAP'],
					'namapengguna' => $row['USERNAME'],
					'email' => $row['EMAIL'],
					'kodepegawai' => $row['KODE_PEGAWAI'],
					'alamat' => $row['ALAMAT'],
					'jk' => $row['JK'],
					'hakakses' => $row['HAK_AKSES'],
					'aktif' => $row['STATUS']
				];
			}
			
			header('Content-type: application/json');
			echo json_encode($return);
		}
	}else{
		$stmt = $dbh->prepare("SELECT * FROM sim_pengguna ORDER BY ID DESC");
		$stmt->execute();
		require 'adminpage/pages/simpengguna.php';
	}
?>