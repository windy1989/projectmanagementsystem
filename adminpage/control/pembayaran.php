<?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		session_start();
		require '../conn/conn.php';
		$metode = $_POST['metode'];
		if($metode == "simpaninvoice"){
			$kd = dekripsi($_POST['kd1']);
			$idpegawai = $_SESSION['userInfo']['ID'];
			$noinvoice = $_POST['noinvoice1'];
			$bank = $_POST['bank1'];
			$tglinvoice = $_POST['tglinvoice1'];
			$nominal = $_POST['nominal1'];
			$bayarke = $_POST['bayarke1'];
			$keterangan = $_POST['keterangan1'];
			
			$string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
			$kode = substr(str_shuffle($string),0,15);
			
			$ceking = $dbh->prepare("SELECT * FROM sim_proyekpembayaran WHERE KODE_PROYEK = ? AND PEMBAYARAN_KE = ?");
			$ceking->execute([$kd,$bayarke]);
			$arrceking = $ceking->fetch();
			$jumceking = $ceking->rowCount();
			
			if($jumceking > 0){
				$stmt = $dbh->prepare("UPDATE sim_proyekpembayaran SET NO_INVOICE=?,ID_PEGAWAI=?,ID_BANK=?,TGL_INVOICE=?,NOMINAL=?,KETERANGAN=?,TGL_EDIT=DEFAULT WHERE KODE_PROYEK = ? AND PEMBAYARAN_KE = ?");
				$stmt->execute([$noinvoice,$idpegawai,$bank,$tglinvoice,$nominal,$keterangan,$kd,$bayarke]);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("UPDATE sim_proyekpembayaran SET NO_INVOICE=?,ID_PEGAWAI=?,ID_BANK=?,TGL_INVOICE=?,NOMINAL=?,KETERANGAN=?,TGL_EDIT=DEFAULT WHERE KODE_PROYEK = ? AND PEMBAYARAN_KE = ?");
					$stmtku->execute([$noinvoice,$idpegawai,$bank,$tglinvoice,$nominal,$keterangan,$kd,$bayarke]);
				}
				echo $arrceking['KODE'];
			}else{
				$stmt = $dbh->prepare("INSERT INTO sim_proyekpembayaran VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,DEFAULT,?)");
				$stmt->execute([$kode,$noinvoice,'',$idpegawai,'',$kd,$bank,$tglinvoice,'',$nominal,$bayarke,$keterangan,'BELUM DIBAYAR']);
				
				if($koneksipusat){
					$stmtku = $conn->prepare("INSERT INTO sim_proyekpembayaran VALUES (DEFAULT,?,?,?,?,?,?,?,?,?,?,?,?,DEFAULT,?)");
					$stmtku->execute([$kode,$noinvoice,'',$idpegawai,'',$kd,$bank,$tglinvoice,'',$nominal,$bayarke,$keterangan,'BELUM DIBAYAR']);
				}
				
				updateLog($kd,'Invoice tagihan ke-'.$bayarke.' telah dibuat.');
				
				echo $kode;
				
			}
		}elseif($metode == "simpankwitansi"){
			$kode = $_POST['kd1'];
			$nokwitansi = $_POST['nokwitansi1'];
			$terimadari = $_POST['terimadari1'];
			$tglbayar = $_POST['tglbayar1'];
			
			$stmt = $dbh->prepare("UPDATE sim_proyekpembayaran SET NO_KWITANSI=?,TERIMA_DARI=?,TGL_BAYAR=? WHERE KODE = ?");
			$stmt->execute([$nokwitansi,$terimadari,$tglbayar,$kode]);
			
			if($koneksipusat){
				$stmtku = $conn->prepare("UPDATE sim_proyekpembayaran SET NO_KWITANSI=?,TERIMA_DARI=?,TGL_BAYAR=? WHERE KODE = ?");
				$stmtku->execute([$nokwitansi,$terimadari,$tglbayar,$kode]);
			}
			
			$ceking = $dbh->prepare("SELECT KODE_PROYEK,PEMBAYARAN_KE,(SELECT TERMIN FROM sim_proyek WHERE KODE = KODE_PROYEK) AS TERMINPROYEK FROM sim_proyekpembayaran WHERE KODE = ?");
			$ceking->execute([$kode]);
			$arrceking = $ceking->fetch();
			
			if($arrceking['PEMBAYARAN_KE'] == 1){
				$stmtupdate = $dbh->prepare("UPDATE sim_proyekpembayaran SET SUDAH_DIBAYAR = 'SUDAH DIBAYAR' WHERE KODE = ?");
				$stmtupdate->execute([$kode]);
				
				if($koneksipusat){
					$stmtupdateku = $conn->prepare("UPDATE sim_proyekpembayaran SET SUDAH_DIBAYAR = 'SUDAH DIBAYAR' WHERE KODE = ?");
					$stmtupdateku->execute([$kode]);
				}
				
				$stmtupdate1 = $dbh->prepare("UPDATE sim_proyek SET STATUS = 1 WHERE KODE = ?");
				$stmtupdate1->execute([$arrceking['KODE_PROYEK']]);
				
				if($koneksipusat){
					$stmtupdate1ku = $conn->prepare("UPDATE sim_proyek SET STATUS = 1 WHERE KODE = ?");
					$stmtupdate1ku->execute([$arrceking['KODE_PROYEK']]);
				}
			}else{
				$stmtupdate = $dbh->prepare("UPDATE sim_proyekpembayaran SET SUDAH_DIBAYAR = 'SUDAH DIBAYAR' WHERE KODE = ?");
				$stmtupdate->execute([$kode]);
				
				if($koneksipusat){
					$stmtupdateku = $conn->prepare("UPDATE sim_proyekpembayaran SET SUDAH_DIBAYAR = 'SUDAH DIBAYAR' WHERE KODE = ?");
					$stmtupdateku->execute([$kode]);
				}
				
				if($arrceking['PEMBAYARAN_KE'] == $arrceking['TERMINPROYEK']){
					$stmtupdate1 = $dbh->prepare("UPDATE sim_proyek SET STATUS = 10 WHERE KODE = ?");
					$stmtupdate1->execute([$arrceking['KODE_PROYEK']]);
					
					if($koneksipusat){
						$stmtupdate1ku = $conn->prepare("UPDATE sim_proyek SET STATUS = 10 WHERE KODE = ?");
						$stmtupdate1ku->execute([$arrceking['KODE_PROYEK']]);
					}
				}
			}
			
			updateLog($arrceking['KODE_PROYEK'],'Pembayaran ke-'.$arrceking['PEMBAYARAN_KE'].' telah dibayarkan.');
		}elseif($metode == "lihatproyek"){
			$kode = dekripsi($_POST['id']);
			$stmt = $dbh->prepare("SELECT KODE,NO_PROYEK,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,IFNULL((SELECT CONCAT(SURVEYOR,'=',TGL_MULAI,'=',TGL_SELESAI) FROM sim_proyeksurvei WHERE KODE_PROYEK = sim_proyek.KODE),'-=-') AS INFOSURVEI,KETERANGAN_PERUNTUKAN,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS FROM sim_proyek WHERE KODE = ?");
			$stmt->execute([$kode]);
			
			$stmtsyarat = $dbh->prepare("SELECT ss.NAMA, sp.NO_DOKUMEN, sp.LETAK_FILE, sp.KETERANGAN FROM sim_proyeksyarat sp, sim_syarat ss WHERE ss.ID = sp.ID_SYARAT AND sp.KODE_PROYEK = ?");
			$stmtsyarat->execute([$kode]);
			
			$row = $stmt->fetch();
			?>
			<div class="row">
				<div class="col-sm-6">
					<h4 style="color:blue;">Info Proyek</h4>
					<hr>
					<dl>
						<dt>No.Kontrak/Proyek</dt>
						<dd><?=$row['NO_PROYEK']?></dd>
						<dt>Nama Proyek</dt>
						<dd><?=$row['JENISPROYEK'].' '.$row['NAMA'].' '.$row['LOKASI'].' '.$row['KOTA']?></dd>
						<dt>Tgl.Pengajuan</dt>
						<dd><?=tgl_indo($row['TGL_PENGAJUAN'])?></dd>
						<dt>Pelanggan</dt>
						<dd><?=$row['NAMAPELANGGAN']?></dd>
						<dt>Peruntukan</dt>
						<dd><?=$row['PERUNTUKANPROYEK']?></dd>
						<dt>Keterangan Peruntukan</dt>
						<dd><?=$row['KETERANGAN_PERUNTUKAN']?></dd>
					</dl>
				</div>
				<div class="col-sm-6">
					<h4 style="color:blue;">Progres Kerja</h4>
					<hr>
					<dl>
						<dt>Lama Pengerjaan</dt>
						<dd><?=$row['LAMA_KERJA']?> hari</dd>
						<dt>Tgl.Mulai</dt>
						<dd><?=tgl_indo($row['TGL_MULAI_KERJA'])?></dd>
						<dt>Tgl.Selesai</dt>
						<dd><?=tgl_indo($row['TGL_SELESAI_KERJA'])?></dd>
					</dl>
					<h4 style="color:blue;">Survei</h4>
					<hr>
					<dl>
						<dt>Surveyor</dt>
						<dd><?=explode('=',$row['INFOSURVEI'])[0] == '-' ? '-' : tgl_indo(explode('=',$row['INFOSURVEI'])[0])?></dd>
						<dt>Tgl.Mulai Survei</dt>
						<dd><?=explode('=',$row['INFOSURVEI'])[1] == '-' ? '-' : tgl_indo(explode('=',$row['INFOSURVEI'])[1])?></dd>
						<dt>Tgl.Selesai Survei</dt>
						<dd><?=explode('=',$row['INFOSURVEI'])[2] == '-' ? '-' : tgl_indo(explode('=',$row['INFOSURVEI'])[2])?></dd>
					</dl>
				</div>
				<div class="col-sm-12">
					<h4 style="color:blue;">File Syarat</h4>
					<hr>
					<table id="tabelinvoice" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr class="text-center">
							  <th>Nama</th>
							  <th>No.Dok</th>
							  <th>Letak</th>
							  <th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php
							while($rowsyarat = $stmtsyarat->fetch(PDO::FETCH_ASSOC)) {
							?>
							<tr>
								<td><?=$rowsyarat['NAMA']?></td>
								<td><?=$rowsyarat['NO_DOKUMEN']?></td>
								<td><?=$rowsyarat['LETAK_FILE']?></td>
								<td><?=$rowsyarat['KETERANGAN']?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
<?php
		}elseif($metode == "dapatkan-invoice"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT *,(SELECT BIAYA FROM sim_proyek WHERE KODE = KODE_PROYEK) AS TOTAL FROM sim_proyekpembayaran WHERE KODE_PROYEK = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetchAll();
						
			header('Content-type: application/json');
			echo json_encode($result);
		}elseif($metode == "dapatkan-kwitansi"){
			
			$id = dekripsi($_POST['id']);
			
			$stmt = $dbh->prepare("SELECT * FROM sim_proyekpembayaran WHERE KODE_PROYEK = ?");
			$stmt->execute([$id]);
			$result = $stmt->fetchAll();
						
			header('Content-type: application/json');
			echo json_encode($result);
		}
	}else{
		//$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,KETERANGAN_PERUNTUKAN,LAMA_SURVEI,TANGGAL_SURVEI,ITEM_SURVEI,KETERANGAN_SURVEI,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS FROM sim_proyek WHERE STATUS = 0 OR STATUS = 6 OR STATUS = 8 ORDER BY ID ASC");
		$stmt = $dbh->prepare("SELECT KODE,NAMA,TGL_PENGAJUAN,LOKASI,KOTA,ID_PELANGGAN,(SELECT CONCAT(NAMA_PEMILIK,NAMA_DIREKTUR) FROM sim_pelanggan WHERE ID = ID_PELANGGAN) AS NAMAPELANGGAN,ID_JENIS,(SELECT NAMA FROM sim_jenis WHERE ID = ID_JENIS) AS JENISPROYEK,ID_PERUNTUKAN,(SELECT NAMA FROM sim_peruntukan WHERE ID = ID_PERUNTUKAN) AS PERUNTUKANPROYEK,KETERANGAN_PERUNTUKAN,LAMA_KERJA,TGL_MULAI_KERJA,TGL_SELESAI_KERJA,SURAT_ANDALALIN,SURAT_KUASA,BIAYA,TERMIN,KETERANGAN,TGL_EDIT,STATUS FROM sim_proyek ORDER BY ID ASC");
		$stmt->execute();
		require 'adminpage/pages/simpembayaran.php';
	}
?>