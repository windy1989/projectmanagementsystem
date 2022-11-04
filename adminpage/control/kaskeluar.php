<?php 
	function compress_image($source_url, $destination_url, $quality) {
			$info = getimagesize($source_url);

			if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source_url);
		
			if ($info['mime'] == 'image/jpg')
			$image = imagecreatefromjpeg($source_url);

			elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source_url);

			elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source_url);

			imagejpeg($image, $destination_url, $quality);
			return $destination_url;
        }
		
	function findexts ($filename) 
     { 
     $filename = strtolower($filename) ; 
     $exts = explode(".", $filename) ; 
     $n = count($exts)-1; 
     $exts = $exts[$n]; 
     return $exts; 
    }

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$shufstring = substr(str_shuffle($string),0,5);
			$kode = substr(str_shuffle($string),0,15);
			
			if (($_FILES["image"]["type"] == "image/gif") ||
            ($_FILES["image"]["type"] == "image/jpeg") ||
            ($_FILES["image"]["type"] == "image/png") ||
            ($_FILES["image"]["type"] == "image/pjpeg") ||
			($_FILES["image"]["type"] == "image/jpg") ||
			($_FILES["image"]["type"] == "image/JPG")
			) {
				
				$ext = findexts($_FILES['image']['name']); 
				$randomNumber = rand();
				$dir = $_SERVER['DOCUMENT_ROOT']."/victoryapp/dist/images/kaskeluar/";
				
				$filename = compress_image($_FILES["image"]["tmp_name"], $dir.$randomNumber.$shufstring.".".$ext, 50);
				
			}
			
			$tempid = dekripsi($_POST["tempid"]);
			$untuk = $_POST["untuk"];
			$kaskecil = $_POST['kaskecil'];
			$tgl = $_POST['tgl'];
			$bank = $_POST['bank'];
			$banktujuan = $_POST['banktujuan'];
			$nominal = $_POST["nominal"];
			$gambar = $_FILES["image"]["name"];
			$keterangan = $_POST['keterangan'];
			$gambarold = $_POST['gambarold'];
			
			$gambarNew = "";
			if(!empty($_FILES["image"]["tmp_name"])){
				$gambarNew = $randomNumber.$shufstring.".".$ext;
				unlink("../dist/images/kaskeluar/".$gambarold);
			}else{
				$gambarNew = $gambarold;
			}
			
			date_default_timezone_set('Asia/Jakarta');
			$dateinput = date('Y-m-d H:i:s');
			
			if($tempid !== ''){
				if($kaskecil == 1){
					$stmtkaskecil = $dbh->prepare('UPDATE sim_kasmasukkecil SET UNTUK=?, ID_BANK=?,NOMINAL=?,TGL_TRANSAKSI=?,KETERANGAN=?,BUKTI=? WHERE KODE=?');
					$stmtkaskecil->execute([$untuk,$banktujuan,$nominal,$tgl,$untuk,$gambarNew,$tempid]);
				}
				$statement = $dbh->prepare('UPDATE sim_kaskeluar SET UNTUK=?, ID_BANK=?,NOMINAL=?,TGL_TRANSAKSI=?,KETERANGAN=?,BUKTI=? WHERE KODE=?');
				$statement->execute([$untuk,$bank,$nominal,$tgl,$keterangan,$gambarNew,$tempid]);
				if($koneksipusat){
					$statementku = $conn->prepare('UPDATE sim_kaskeluar SET UNTUK=?, ID_BANK=?,NOMINAL=?,TGL_TRANSAKSI=?,KETERANGAN=?,BUKTI=? WHERE KODE=?');
					$statementku->execute([$untuk,$bank,$nominal,$tgl,$keterangan,$gambarNew,$tempid]);
					
					if($kaskecil == 1){
						$stmtkaskecilku = $conn->prepare('UPDATE sim_kasmasukkecil SET UNTUK=?, ID_BANK=?,NOMINAL=?,TGL_TRANSAKSI=?,KETERANGAN=?,BUKTI=? WHERE KODE=?');
						$stmtkaskecilku->execute([$untuk,$banktujuan,$nominal,$tgl,$untuk,$gambarNew,$tempid]);
					}
				}
			}else{
				if($kaskecil == 1){
					$stmtkaskecil = $dbh->prepare('INSERT INTO sim_kasmasukkecil VALUES (DEFAULT,?,?,?,?,?,?,?,?,1)');
					$stmtkaskecil->execute([$kode,$untuk,$banktujuan,$nominal,$tgl,$untuk,$gambarNew,$dateinput]);
				}
				
				$statement = $dbh->prepare('INSERT INTO sim_kaskeluar VALUES (DEFAULT,?,?,?,?,?,?,?,?,1)');
				$statement->execute([$kode,$untuk,$bank,$nominal,$tgl,$keterangan,$gambarNew,$dateinput]);
				
				if($koneksipusat){
					if($kaskecil == 1){
						$stmtkaskecilku = $conn->prepare('INSERT INTO sim_kasmasukkecil VALUES (DEFAULT,?,?,?,?,?,?,?,?,1)');
						$stmtkaskecilku->execute([$kode,$untuk,$banktujuan,$nominal,$tgl,$untuk,$gambarNew,$dateinput]);
					}
					$statementku = $conn->prepare('INSERT INTO sim_kaskeluar VALUES (DEFAULT,?,?,?,?,?,?,?,?,1)');
					$statementku->execute([$kode,$untuk,$bank,$nominal,$tgl,$keterangan,$gambarNew,$dateinput]);
				}
			}
			
		}elseif($metode == "hapus"){
			$arrID = $_POST['arrID'];
			$arrImg = $_POST['arrImg1'];
			for($i = 0; $i<count($arrID); $i++){
				$sthapus = $dbh->prepare("DELETE FROM sim_kaskeluar WHERE KODE = ?");
				$sthapus->execute([dekripsi($arrID[$i])]);
				
				$sthapuskaskecil = $dbh->prepare("DELETE FROM sim_kasmasukkecil WHERE KODE = ?");
				$sthapuskaskecil->execute([dekripsi($arrID[$i])]);
				
				if(file_exists('../dist/images/kaskeluar/'.$arrImg[$i])){
					unlink("../dist/images/kaskeluar/".$arrImg[$i]);
				}
				
				if($koneksipusat){
					$sthapusku = $conn->prepare("DELETE FROM sim_kaskeluar WHERE KODE = ?");
					$sthapusku->execute([dekripsi($arrID[$i])]);
					$sthapuskaskecilku = $dbh->prepare("DELETE FROM sim_kasmasukkecil WHERE KODE = ?");
					$sthapuskaskecilku->execute([dekripsi($arrID[$i])]);
				}
			}
		}elseif($metode == "tampil"){
			
			$id = dekripsi($_POST['id1']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_kaskeluar WHERE KODE = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetchAll();
			
			$return = [];
			foreach ($result as $row) {
				$return[] = [
					'kode' => enkripsi($row['KODE']),
					'untuk' => $row['UNTUK'],
					'bank' => $row['ID_BANK'],
					'nominal' => number_format($row['NOMINAL'],0),
					'tgl' => $row['TGL_TRANSAKSI'],
					'keterangan' => $row['KETERANGAN'],
					'bukti' => $row['BUKTI']
				];
			}
			
			header('Content-type: application/json');
			echo json_encode($return);
		}
	}else{
		$stmt = $dbh->prepare("SELECT KODE, UNTUK, ID_BANK, (SELECT NAMA_BANK FROM sim_bank WHERE ID = ID_BANK) AS NAMABANK, NOMINAL, TGL_TRANSAKSI, KETERANGAN, BUKTI, STATUS FROM sim_kaskeluar ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simkaskeluar.php';
	}
?>