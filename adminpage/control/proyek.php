<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpan"){
			$tempid = dekripsi($_POST['tempid1']);
			$nama = $_POST['nama1'];
			$noproyek = $_POST['noproyek1'];
			$tglpengajuan = $_POST['tglpengajuan1'];
			$lokasi = $_POST['lokasi1'];
			$kota = $_POST['kota1'];
			$pelanggan = $_POST['pelanggan1'];
			$jenis = $_POST['jenis1'];
			$peruntukan = $_POST['peruntukan1'];
			$ketperuntukan = $_POST['ketperuntukan1'];
			$lamakerja = $_POST['lamakerja1'];
			$tglmulaikerja = $_POST['tglmulaikerja1'];
			$tglselesaikerja = $_POST['tglselesaikerja1'];
			$biaya = $_POST['biaya1'];
			$termin = $_POST['termin1'];
			$keterangan = $_POST['ket1'];
			$suratandalalin = $_POST['suratandalalin1'];
			$suratkuasa = $_POST['suratkuasa1'];
			$arrIdSyarat = $_POST['arrIdSyarat1'];
			$arrSyaratNoDokumen = $_POST['arrSyaratNoDokumen1'];
			$arrSyaratLetakFile	= $_POST['arrSyaratLetakFile1'];
			$arrSyaratKeterangan = $_POST['arrSyaratKeterangan1'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,20);
			
			if($tempid == ''){
				$stmt = $dbh->prepare("INSERT INTO sim_proyek VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,DEFAULT,0)");
				$stmt->execute([$kode,$nama,$noproyek,$tglpengajuan,$lokasi,$kota,$pelanggan,$jenis,$peruntukan,$ketperuntukan,$lamakerja,$tglmulaikerja,$tglselesaikerja,$suratandalalin,$suratkuasa,$biaya,$termin,$keterangan]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("INSERT INTO sim_proyek VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,DEFAULT,0)");
					$stmtku->execute([$kode,$nama,$noproyek,$tglpengajuan,$lokasi,$kota,$pelanggan,$jenis,$peruntukan,$ketperuntukan,$lamakerja,$tglmulaikerja,$tglselesaikerja,$suratandalalin,$suratkuasa,$biaya,$termin,$keterangan]);
				}
								
				for($i=0;$i<count($arrIdSyarat);$i++){
					$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
					$kd = substr(str_shuffle($str),0,20);
					
					$stmtsyarat = $dbh->prepare("INSERT INTO sim_proyeksyarat VALUES (DEFAULT,?,?,?,?,?,?)");
					$stmtsyarat->execute([$kd,$kode,$arrIdSyarat[$i],$arrSyaratNoDokumen[$i],$arrSyaratLetakFile[$i],$arrSyaratKeterangan[$i]]);
					
					if($koneksipusat){
						$stmtsyaratku = $conn->prepare("INSERT INTO sim_proyeksyarat VALUES (DEFAULT,?,?,?,?,?,?)");
						$stmtsyaratku->execute([$kd,$kode,$arrIdSyarat[$i],$arrSyaratNoDokumen[$i],$arrSyaratLetakFile[$i],$arrSyaratKeterangan[$i]]);
					}
				}
				
				updateLog($kode,'Kontrak Proyek telah dibuat.');
				
				echo "1";
			}else{
				$stmt = $dbh->prepare("UPDATE sim_proyek SET NAMA=?,NO_PROYEK=?,TGL_PENGAJUAN=?,LOKASI=?,KOTA=?,ID_PELANGGAN=?,ID_JENIS=?,ID_PERUNTUKAN=?,KETERANGAN_PERUNTUKAN=?,LAMA_KERJA=?,TGL_MULAI_KERJA=?,TGL_SELESAI_KERJA=?,SURAT_ANDALALIN=?,SURAT_KUASA=?,BIAYA=?,TERMIN=?,KETERANGAN=?,TGL_EDIT=DEFAULT WHERE KODE = ?");
				$stmt->execute([$nama,$noproyek,$tglpengajuan,$lokasi,$kota,$pelanggan,$jenis,$peruntukan,$ketperuntukan,$lamakerja,$tglmulaikerja,$tglselesaikerja,$suratandalalin,$suratkuasa,$biaya,$termin,$keterangan,$tempid]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("UPDATE sim_proyek SET NAMA=?,NO_PROYEK=?,TGL_PENGAJUAN=?,LOKASI=?,KOTA=?,ID_PELANGGAN=?,ID_JENIS=?,ID_PERUNTUKAN=?,KETERANGAN_PERUNTUKAN=?,LAMA_KERJA=?,TGL_MULAI_KERJA=?,TGL_SELESAI_KERJA=?,SURAT_ANDALALIN=?,SURAT_KUASA=?,BIAYA=?,TERMIN=?,KETERANGAN=?,TGL_EDIT=DEFAULT WHERE KODE = ?");
					$stmtku->execute([$nama,$noproyek,$tglpengajuan,$lokasi,$kota,$pelanggan,$jenis,$peruntukan,$ketperuntukan,$lamakerja,$tglmulaikerja,$tglselesaikerja,$suratandalalin,$suratkuasa,$biaya,$termin,$keterangan,$tempid]);
				}
				
				for($i=0;$i<count($arrIdSyarat);$i++){
					$stmtsyarat = $dbh->prepare("UPDATE sim_proyeksyarat SET NO_DOKUMEN=?,LETAK_FILE=?,KETERANGAN=? WHERE KODE_PROYEK=? AND ID_SYARAT=?");
					$stmtsyarat->execute([$arrSyaratNoDokumen[$i],$arrSyaratLetakFile[$i],$arrSyaratKeterangan[$i],$tempid,$arrIdSyarat[$i]]);
					
					if($koneksipusat){
						$stmtsyaratku = $conn->prepare("UPDATE sim_proyeksyarat SET NO_DOKUMEN=?,LETAK_FILE=?,KETERANGAN=? WHERE KODE_PROYEK=? AND ID_SYARAT=?");
						$stmtsyaratku->execute([$arrSyaratNoDokumen[$i],$arrSyaratLetakFile[$i],$arrSyaratKeterangan[$i],$tempid,$arrIdSyarat[$i]]);
					}
				}
				
				updateLog($tempid,'Kontrak Proyek telah diubah.');
				
				echo "1";
			}
		
		}elseif($metode == "hapus"){
			$arrID = $_POST['arrID'];
			for($i = 0; $i<count($arrID); $i++){
				$sthapus = $dbh->prepare("DELETE FROM sim_proyeksyarat WHERE KODE_PROYEK = ?;DELETE FROM sim_proyek WHERE KODE = ?");
				$sthapus->execute([dekripsi($arrID[$i]),dekripsi($arrID[$i])]);
				
				if($koneksipusat){
					$sthapusku = $conn->prepare("DELETE FROM sim_proyeksyarat WHERE KODE_PROYEK = ?;DELETE FROM sim_proyek WHERE KODE = ?");
					$sthapusku->execute([dekripsi($arrID[$i]),dekripsi($arrID[$i])]);
				}
				
				updateLog(dekripsi($arrID[$i]),'Kontrak Proyek telah hapus.');
			}
		}elseif($metode == "dapatkan"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_proyek WHERE KODE = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			$stmtsyarat = $dbh->prepare("SELECT * FROM sim_proyeksyarat WHERE KODE_PROYEK = ?");
			$stmtsyarat->execute([$result['KODE']]);
			$resultsyarat = $stmtsyarat->fetchAll();
			
			$data = [
				'kode' => enkripsi($result['KODE']),
				'nama' => $result['NAMA'],
				'noproyek' => $result['NO_PROYEK'],
				'tglpengajuan' => $result['TGL_PENGAJUAN'],
				'lokasi' => $result['LOKASI'],
				'kota' => $result['KOTA'],
				'pelanggan' => $result['ID_PELANGGAN'],
				'jenis' => $result['ID_JENIS'],
				'peruntukan' => $result['ID_PERUNTUKAN'],
				'keteranganperuntukan' => $result['KETERANGAN_PERUNTUKAN'],
				'lamakerja' => $result['LAMA_KERJA'],
				'tglmulaikerja' => $result['TGL_MULAI_KERJA'],
				'tglselesaikerja' => $result['TGL_SELESAI_KERJA'],
				'biaya' => number_format($result['BIAYA'],0,'.',','),
				'termin' => $result['TERMIN'],
				'keterangan' => $result['KETERANGAN'],
				'arrSyarat' => $resultsyarat
			];
			
			header('Content-type: application/json');
			echo json_encode($data);
		}elseif($metode == "ubahstatus"){
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_proyek WHERE KODE = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetch();
			
			$stmtsyarat = $dbh->prepare("SELECT *,(SELECT NAMA FROM sim_syarat WHERE ID = ID_SYARAT) AS NAMASYARAT FROM sim_proyeksyarat WHERE KODE_PROYEK = ?");
			$stmtsyarat->execute([$result['KODE']]);
			
			$syarat = '<table class="table table-bordered">
						<thead>
							<tr>
								<th>Dokumen</th>
								<th>No.Dokumen</th>
								<th>Letak File</th>
								<th>Keterangan</th>
							</tr>
						</thead>';
			while($row = $stmtsyarat->fetch(PDO::FETCH_ASSOC)) {
				$syarat .= '<tr><td>'.$row['NAMASYARAT'].'</td><td>'.$row['NO_DOKUMEN'].'</td><td>'.$row['LETAK_FILE'].'</td><td>'.$row['KETERANGAN'].'</td></tr>';
			}
			$syarat .= '</table>';
			
			$stmtbayar = $dbh->prepare("SELECT * FROM sim_proyekpembayaran WHERE KODE_PROYEK = ?");
			$stmtbayar->execute([$result['KODE']]);
			
			$bayar = '<table class="table table-bordered">
						<thead>
							<tr>
								<th>No.Invoice</th>
								<th>No.Kwitansi</th>
								<th>Nominal</th>
								<th>Pemb. Ke-</th>
								<th>Terima Dari</th>
							</tr>
						</thead>';
			while($row = $stmtbayar->fetch(PDO::FETCH_ASSOC)) {
				$bayar .= '<tr><td>'.$row['NO_INVOICE'].'</td><td>'.$row['NO_KWITANSI'].'</td><td class="text-right">Rp '.number_format($row['NOMINAL'],0).',-</td><td>'.$row['PEMBAYARAN_KE'].'</td><td>'.$row['TERIMA_DARI'].'</td></tr>';
			}
			$bayar .= '</table>';
			
			$stmtsurvei = $dbh->prepare("SELECT * FROM sim_proyeksurvei WHERE KODE_PROYEK = ?");
			$stmtsurvei->execute([$result['KODE']]);
			
			$survei = '<table class="table table-bordered">
						<thead>
							<tr>
								<th>Surveyor</th>
								<th>Tgl.Mulai</th>
								<th>Tgl.Selesai</th>
								<th>Letak File</th>
								<th>Item Survei</th>
								<th>Keterangan</th>
							</tr>
						</thead>';
			while($row = $stmtsurvei->fetch(PDO::FETCH_ASSOC)) {
				$survei .= '<tr><td>'.$row['SURVEYOR'].'</td><td>'.tgl_indo($row['TGL_MULAI']).'</td><td>'.tgl_indo($row['TGL_SELESAI']).'</td><td>'.$row['LETAK_FILE'].'</td><td>'.$row['ITEM_SURVEI'].'</td><td>'.$row['KETERANGAN'].'</td></tr>';
			}
			$survei .= '</table>';
			
			$stmtsidang = $dbh->prepare("SELECT * FROM sim_proyeksidang WHERE KODE_PROYEK = ?");
			$stmtsidang->execute([$result['KODE']]);
			
			$sidang = '<table class="table table-bordered">
						<thead>
							<tr>
								<th>No.Pendaftaran</th>
								<th>No.Surat Rekom.</th>
								<th>Tgl.Mulai</th>
								<th>Tgl.Selesai</th>
								<th>Letak File</th>
								<th>Keterangan</th>
							</tr>
						</thead>';
			while($row = $stmtsidang->fetch(PDO::FETCH_ASSOC)) {
				$sidang .= '<tr><td>'.$row['NO_PENDAFTARAN_SIDANG'].'</td><td>'.$row['NO_SURAT_REKOMENDASI'].'</td><td>'.tgl_indo($row['TGL_MULAI']).'</td><td>'.tgl_indo($row['TGL_SELESAI']).'</td><td>'.$row['LETAK_FILE'].'</td><td>'.$row['KETERANGAN'].'</td></tr>';
			}
			$sidang .= '</table>';
			
			$data = [
				'noproyek' => $result['NO_PROYEK'],
				'status' => $result['STATUS'],
				'syarat' => $syarat,
				'bayar' => $bayar,
				'survei' => $survei,
				'sidang' => $sidang
			];
			
			header('Content-type: application/json');
			echo json_encode($data);
		}elseif($metode == "ubahstatusproyek"){
			$kode = dekripsi($_POST['kode1']);
			$nilai = $_POST['nilai1'];
			
			$stmt = $dbh->prepare("UPDATE sim_proyek SET STATUS = ? WHERE KODE = ?");
			$stmt->execute([$nilai,$kode]);
			
			if($koneksipusat){
				$stmtku = $conn->prepare("UPDATE sim_proyek SET STATUS = ? WHERE KODE = ?");
				$stmtku->execute([$nilai,$kode]);
			}
			
			updateLog($kode,'Status kontrak proyek telah diubah menjadi '.$nilai);
		}
	}else{
		
		if($koneksipusat){
			$cekpusat = $conn->prepare("SELECT KODE,STATUS FROM sim_proyek");
			$cekpusat->execute();
			$rowpusat = $cekpusat->fetchAll();
			$ceklokal = $dbh->prepare("SELECT KODE,STATUS FROM sim_proyek");
			$ceklokal->execute();
			$rowlokal = $ceklokal->fetchAll();
			
			for($i=0;$i<count($rowlokal);$i++){
				if($rowpusat[$i]['STATUS'] != $rowlokal[$i]['STATUS']){
					$updatestmt = $dbh->prepare("UPDATE sim_proyek SET STATUS = ? WHERE KODE = ?");
					$updatestmt->execute([$rowpusat[$i]['STATUS'],$rowpusat[$i]['KODE']]);
					
					updateLog($rowpusat[$i]['KODE'],'Status kontrak proyek telah diubah menjadi '.$rowpusat[$i]['STATUS']);
				}
			}
		}
		
		$arrColor = array("#ff1a1a","#ff4d4d","#ff9999","#ff4d94","#ffbf80","#66ff66","#1aff1a","#00e600","#4db8ff","#0099ff");
		$stmt = $dbh->prepare("SELECT KODE,NO_PROYEK,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,KETERANGAN_PERUNTUKAN,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS FROM sim_proyek ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simproyek.php';
	}
?>