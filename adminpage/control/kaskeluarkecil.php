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
				$dir = $_SERVER['DOCUMENT_ROOT']."/victoryapp/dist/images/kaskeluarkecil/";
				
				$filename = compress_image($_FILES["image"]["tmp_name"], $dir.$randomNumber.$shufstring.".".$ext, 50);
				
			}
			
			$tempid = dekripsi($_POST["tempid"]);
			$untuk = $_POST["untuk"];
			$tgl = $_POST['tgl'];
			$bank = $_POST['bank'];
			$nominal = $_POST["nominal"];
			$gambar = $_FILES["image"]["name"];
			$keterangan = $_POST['keterangan'];
			$gambarold = $_POST['gambarold'];
			
			$gambarNew = "";
			if(!empty($_FILES["image"]["tmp_name"])){
				$gambarNew = $randomNumber.$shufstring.".".$ext;
				unlink("../dist/images/kaskeluarkecil/".$gambarold);
			}else{
				$gambarNew = $gambarold;
			}
			
			date_default_timezone_set('Asia/Jakarta');
			$dateinput = date('Y-m-d H:i:s');
			
			if($tempid !== ''){
				$statement = $dbh->prepare('UPDATE sim_kaskeluarkecil SET UNTUK=?, ID_BANK=?,NOMINAL=?,TGL_TRANSAKSI=?,KETERANGAN=?,BUKTI=? WHERE KODE=?');
				$statement->execute([$untuk,$bank,$nominal,$tgl,$keterangan,$gambarNew,$tempid]);
				if($koneksipusat){
					$statementku = $conn->prepare('UPDATE sim_kaskeluarkecil SET UNTUK=?, ID_BANK=?,NOMINAL=?,TGL_TRANSAKSI=?,KETERANGAN=?,BUKTI=? WHERE KODE=?');
					$statementku->execute([$untuk,$bank,$nominal,$tgl,$keterangan,$gambarNew,$tempid]);
				}
			}else{
				$statement = $dbh->prepare('INSERT INTO sim_kaskeluarkecil VALUES (DEFAULT,?,?,?,?,?,?,?,?,1)');
				$statement->execute([$kode,$untuk,$bank,$nominal,$tgl,$keterangan,$gambarNew,$dateinput]);
				
				if($koneksipusat){
					$statementku = $conn->prepare('INSERT INTO sim_kaskeluarkecil VALUES (DEFAULT,?,?,?,?,?,?,?,?,1)');
					$statementku->execute([$kode,$untuk,$bank,$nominal,$tgl,$keterangan,$gambarNew,$dateinput]);
				}
			}
			
		}elseif($metode == "hapus"){
			$arrID = $_POST['arrID'];
			$arrImg = $_POST['arrImg1'];
			for($i = 0; $i<count($arrID); $i++){
				$sthapus = $dbh->prepare("DELETE FROM sim_kaskeluarkecil WHERE KODE = ?");
				$sthapus->execute([dekripsi($arrID[$i])]);
				
				if(file_exists('../dist/images/kaskeluarkecil/'.$arrImg[$i])){
					unlink("../dist/images/kaskeluarkecil/".$arrImg[$i]);
				}
				
				if($koneksipusat){
					$sthapusku = $conn->prepare("DELETE FROM sim_kaskeluarkecil WHERE KODE = ?");
					$sthapusku->execute([dekripsi($arrID[$i])]);
				}
			}
		}elseif($metode == "tampil"){
			
			$id = dekripsi($_POST['id1']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_kaskeluarkecil WHERE KODE = ?");
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
		$stmt = $dbh->prepare("SELECT KODE, UNTUK, ID_BANK, (SELECT NAMA_BANK FROM sim_bank WHERE ID = ID_BANK) AS NAMABANK, NOMINAL, TGL_TRANSAKSI, KETERANGAN, BUKTI, STATUS FROM sim_kaskeluarkecil ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simkaskeluarkecil.php';
	}
?>