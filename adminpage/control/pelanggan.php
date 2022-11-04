<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			$opsi = $_POST['opsi'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,15);
			
			if($opsi == '1'){
				$tempid = dekripsi($_POST['tempid']);
				$username = $_POST['username'];
				$password = $_POST['pass'];
				$namapemilik = $_POST['namapemilik'];
				$email = $_POST['mail'];
				$nik = $_POST['nik'];
				$alamat = $_POST['alamat'];
				$kota = $_POST['kota'];
				$jk = $_POST['jeniskelamin'];
				$hp = $_POST['hp'];
				$keterangan = $_POST['keterangan'];
				
				$ceking = $dbh->prepare('SELECT * FROM sim_pelanggan WHERE USERNAME = ? OR EMAIL = ? OR NIK_PEMILIK = ?');
				$ceking->execute([$username,$email,$nik]);
				$jumlahceking = $ceking->rowCount();
				
				if($jumlahceking > 0 && $tempid == ''){
					echo '0';
				}else{
					if($tempid == ''){
						$stmt = $dbh->prepare("INSERT INTO sim_pelanggan VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,?,DEFAULT,?,?,?)");
						$stmt->execute([$username,password_hash($password,PASSWORD_DEFAULT),$email,$namapemilik,"",$kode,$nik,"","",$alamat,$kota,$jk,$hp,$opsi,$keterangan,1]);
						if($koneksipusat){
							$stmtku = $conn->prepare("INSERT INTO sim_pelanggan VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,?,DEFAULT,?,?,?)");
							$stmtku->execute([$username,password_hash($password,PASSWORD_DEFAULT),$email,$namapemilik,"",$kode,$nik,"","",$alamat,$kota,$jk,$hp,$opsi,$keterangan,1]);
						}
					}else{
						$stmt = $dbh->prepare("UPDATE sim_pelanggan SET USERNAME=?,EMAIL=?,NAMA_PEMILIK=?,NIK_PEMILIK=?,ALAMAT=?,KOTA=?,JK=?,TELEPON=?,TGL_EDIT=DEFAULT,KETERANGAN=? WHERE KODE_PELANGGAN=?");
						$stmt->execute([$username,$email,$namapemilik,$nik,$alamat,$kota,$jk,$hp,$keterangan,$tempid]);
						if($koneksipusat){
							$stmtku = $conn->prepare("UPDATE sim_pelanggan SET USERNAME=?,EMAIL=?,NAMA_PEMILIK=?,NIK_PEMILIK=?,ALAMAT=?,KOTA=?,JK=?,TELEPON=?,TGL_EDIT=DEFAULT,KETERANGAN=? WHERE KODE_PELANGGAN=?");
							$stmtku->execute([$username,$email,$namapemilik,$nik,$alamat,$kota,$jk,$hp,$keterangan,$tempid]);
						}
					}
					echo '1';
				}
				
			}elseif($opsi == '0'){
				$username = $_POST['namauser'];
				$tempid = dekripsi($_POST['tempidku']);
				$password = $_POST['password'];
				$namadirektur = $_POST['namadirektur'];
				$email = $_POST['email'];
				$namaperusahaan = $_POST['namaperusahaan'];
				$noakta = $_POST['noakta'];
				$alamat = $_POST['alamatku'];
				$kota = $_POST['kotaku'];
				$jk = $_POST['jeniskelaminku'];
				$hp = $_POST['hpku'];
				$keterangan = $_POST['keteranganku'];
				
				$ceking = $dbh->prepare('SELECT * FROM sim_pelanggan WHERE USERNAME = ? OR EMAIL = ?');
				$ceking->execute([$username,$email]);
				$jumlahceking = $ceking->rowCount();
				
				if($jumlahceking > 0){
					echo '0';
				}else{
					if($tempid == ''){
						$stmt = $dbh->prepare("INSERT INTO sim_pelanggan VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,?,DEFAULT,?,?,?)");
						$stmt->execute([$username,password_hash($password,PASSWORD_DEFAULT),$email,"",$namadirektur,$kode,"",$namaperusahaan,$noakta,$alamat,$kota,$jk,$hp,$opsi,$keterangan,1]);
						if($koneksipusat){
							$stmtku = $conn->prepare("INSERT INTO sim_pelanggan VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,?,DEFAULT,?,?,?)");
							$stmtku->execute([$username,password_hash($password,PASSWORD_DEFAULT),$email,"",$namadirektur,$kode,"",$namaperusahaan,$noakta,$alamat,$kota,$jk,$hp,$opsi,$keterangan,1]);
						}
					}else{
						$stmt = $dbh->prepare("UPDATE sim_pelanggan SET USERNAME=?,EMAIL=?,NAMA_DIREKTUR=?,NAMA_PERUSAHAAN=?,NO_AKTA_PENDIRIAN=?,ALAMAT=?,KOTA=?,JK=?,TELEPON=?,TGL_EDIT=DEFAULT,KETERANGAN=? WHERE KODE_PELANGGAN=?");
						$stmt->execute([$username,$email,$namadirektur,$namaperusahaan,$noakta,$alamat,$kota,$jk,$hp,$keterangan,$tempid]);
						if($koneksipusat){
							$stmtku = $conn->prepare("UPDATE sim_pelanggan SET USERNAME=?,EMAIL=?,NAMA_DIREKTUR=?,NAMA_PERUSAHAAN=?,NO_AKTA_PENDIRIAN=?,ALAMAT=?,KOTA=?,JK=?,TELEPON=?,TGL_EDIT=DEFAULT,KETERANGAN=? WHERE KODE_PELANGGAN=?");
							$stmtku->execute([$username,$email,$namadirektur,$namaperusahaan,$noakta,$alamat,$kota,$jk,$hp,$keterangan,$tempid]);
						}
					}
					echo '1';
				}
			}
			
		}elseif($metode == "hapus"){
			$arrID = $_POST['arrID'];
			for($i = 0; $i<count($arrID); $i++){
				$sthapus = $dbh->prepare("DELETE FROM sim_pelanggan WHERE KODE_PELANGGAN = ?");
				$sthapus->execute([dekripsi($arrID[$i])]);
				if($koneksipusat){
					$sthapusku = $conn->prepare("DELETE FROM sim_pelanggan WHERE KODE_PELANGGAN = ?");
					$sthapusku->execute([dekripsi($arrID[$i])]);
				}
			}
		}elseif($metode == "dapatkan"){
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_pelanggan WHERE KODE_PELANGGAN = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			
			$data = [
				'kode' => enkripsi($result['KODE_PELANGGAN']),
				'username' => $result['USERNAME'],
				'email' => $result['EMAIL'],
				'namapemilik' => $result['NAMA_PEMILIK'],
				'namadirektur' => $result['NAMA_DIREKTUR'],
				'nik' => $result['NIK_PEMILIK'],
				'namaperusahaan' => $result['NAMA_PERUSAHAAN'],
				'noakta' => $result['NO_AKTA_PENDIRIAN'],
				'alamat' => $result['ALAMAT'],
				'kota' => $result['KOTA'],
				'jk' => $result['JK'],
				'hp' => $result['TELEPON'],
				'perorangan' => $result['PERORANGAN'],
				'keterangan' => $result['KETERANGAN']
			];
			
			header('Content-type: application/json');
			echo json_encode($data);
		}elseif($metode == "getkota"){
			$id = $_POST['prov1'];
			$stmt = $dbh->prepare("SELECT * FROM sim_kota WHERE province_id = ?");
			$stmt->execute([$id]); 
			$result = $stmt->fetchAll();

			$return = [];
			foreach ($result as $row) {
				$return[] = [ 
					'id' => $row['id'],
					'nama' => ucwords(strtolower($row['name']))
				];
			}
			
			header('Content-type: application/json');
			echo json_encode($return);
		}
	}else{
		$stmt = $dbh->prepare("SELECT * FROM sim_pelanggan ORDER BY ID DESC");
		$stmt->execute();
		require 'adminpage/pages/simpelanggan.php';
	}
?>